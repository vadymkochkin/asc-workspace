<?php

namespace App\Http\Controllers\store;

use Auth;
use Validator;
use App\Models\StoreItem;
use App\Models\StoreGroup;
use App\Models\Realm;
use App\Models\Feature_item;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $realms = Realm::where('is_active', Realm::REALM_STATUS_ACTIVE)->get();
        $data = [
            'realms' => $realms,
        ];

        return view('shop.realm')->with($data);
    }


    public function getStoreMenu($realm)
    {
        if (Auth::user()->canModerateRealms())
            $SelectedRealmMenus = StoreGroup::where('is_active', '=', 1)->get();

        else {
            $SelectedRealmMenus = DB::table('store_items')
                ->leftJoin('store_groups', 'store_items.group', '=', 'store_groups.id')
                ->leftJoin('realms', 'realms.id', '=', 'store_items.realm')
                ->where('realms.slug', $realm)
                ->where('store_items.is_active',1)
                ->select('store_groups.slug', 'store_groups.title')
                ->distinct()
                ->get();
        }

        $data = [
            'menus' => $SelectedRealmMenus,
            'realm_slug' => $realm,
        ];
        return $data;
    }

    public function ItemMenu($realm)
    {
        $realmInfo = realm::where('slug', '=', $realm)->firstOrFail();

        $realmId = $realmInfo['id'];
        $featured_top = Feature_item::where('realm_id', '=', $realmId)->orderBy('sequence','DESC')->orderBy('id','DESC')->take(5)->get();
        $count  = Feature_item::where('realm_id', '=', $realmId)->count();
        $more_featured = Feature_item::where('realm_id', '=', $realmId)->orderBy('sequence','DESC')->orderBy('id','DESC')->skip(5)->take($count)->get();
        $best_sellers = \App\Models\Cart_item::where('realm_id', '=', $realmId)->groupBy('store_item_id')->select('store_item_id', DB::raw('count(item_quantity) as total'))->orderBy('total','DESC')->take(4)->get();
        $menus = $this->getStoreMenu($realm);

        if (!Auth::user()->canModerateRealms() && count($featured) < 4)
            return redirect()->back();

        $data =
            [
                'menus' => $menus['menus'],
                'realm_slug' => $menus['realm_slug'],
                'realm_id' => $realmId,
                'featured_items' => $featured_top,
                'more_featured' => $more_featured,
                'best_sellers'   => $best_sellers
            ];
        return view('shop.shop')->with($data);
    }

    public function GetAllItem($realm, $menu)
    {
        $menuInfo = StoreGroup::where('slug', '=', $menu)->firstOrFail();
        $menuId = $menuInfo['id'];

        $realmInfo = realm::where('slug', '=', $realm)->firstOrFail();
        $realmId = $realmInfo['id'];


        $items = StoreItem::where([
            ['group', '=', $menuId],
            ['realm', '=', $realmId],
            ['is_active', '=', 1]
        ])->paginate(12);

        $itemFound = count($items);
        $itemNameList = array();
        foreach ($items as $item) {
            $cmenuInfo = StoreGroup::where('id', '=', $item->group)->firstOrFail();
            $cmenuId = $cmenuInfo['slug'];

            $crealmInfo = realm::where('id', '=', $item->realm)->firstOrFail();
            $crealmId = $crealmInfo['slug'];
            $itemNameList[] = '<a href="/store/' . $crealmId . '/' . $cmenuId . '/' . $item->id . '"><img src="' . $item->featured_image . '" width="80">' . $item->name . '</a>';
        }
        $menus = $this->getStoreMenu($realm);
        $data = [
            'menus' => $menus['menus'],
            'current_group' => $menuInfo,
            'current_realm' => $realmInfo,
            'realm_slug' => $menus['realm_slug'],
            'menus_slug' => $menu,
            'targetedMenu' => $menuInfo['title'],
            'items' => $items,
            'item_name_list' => json_encode($itemNameList),
        ];
        return view('shop.shop_list')->with($data);
    }


    public function GetSingleItem(Request $request, $realm, $menu, $item_id)
    {
        $menus = $this->getStoreMenu($realm);

        $realmInfo = realm::where('slug', '=', $realm)->firstOrFail();
        $realmId = $realmInfo['id'];

        $menuInfo = StoreGroup::where('slug', '=', $menu)->firstOrFail();
        $menuId = $menuInfo['id'];


        $itemDetails = StoreItem::where([
            ['id', '=', $item_id],
            ['realm', '=', $realmId],
            ['group', '=', $menuId],
            ['is_active', '=', 1]
        ])->firstOrFail();

        $additionalHeadlines = preg_split('/;/', $itemDetails->additional_headline, -1, PREG_SPLIT_NO_EMPTY);
        $additionalTexts = preg_split('/;/', $itemDetails->additional_text, -1, PREG_SPLIT_NO_EMPTY);
        $additionalImages = preg_split('/;/', $itemDetails->additional_images, -1, PREG_SPLIT_NO_EMPTY);


        $additionalContents = array();
        if (isset($additionalImages) && !empty($additionalImages)) {
            for ($i = 0; $i < sizeof($additionalImages); $i++) {
                $additionalContents[$i]['additional_headline'] = (isset($additionalHeadlines[$i]) ? $additionalHeadlines[$i] : '');
                $additionalContents[$i]['additional_text'] = (isset($additionalTexts[$i]) ? $additionalTexts[$i] : '');
                $additionalContents[$i]['additional_images'] = (isset($additionalImages[$i]) ? $additionalImages[$i] : '');
            }
        }

        $cartData = json_decode($request->session()->get('selectedItems'), true);

        if($cartData) {
            $index = $this->in_array_field($realmId, 'realm', $cartData, $itemDetails->itemid, FALSE);
            $isExist = ($index == -1 ? TRUE : FALSE);
        } else {
            $isExist = FALSE;
        }

        $data = [
            'menus' => $menus['menus'],
            'realm_slug' => $menus['realm_slug'],
            'menus_slug' => $menu,
            'item_id' => $item_id,
            'item_info' => $itemDetails,
            'additionalContents' => $additionalContents,
            'isAdded' => $isExist
        ];
        return view('shop.shop_item')->with($data);
    }


    private function in_array_field($needle, $needle_field, $haystack, $itemId, $flag)
    {
        if ($flag) {
            foreach ($haystack as $item) {
                if (isset($item[$needle_field]) && $item[$needle_field] == $needle) {
                    return true;
                }
            }
            return false;
        } else {
            $i = 0;
            foreach ($haystack as $item) {
                if (isset($item[$needle_field]) && $item[$needle_field] == $needle && $item['character'] == "") {
                    foreach ($item['purchase_details'] as $selected_items) {
                        if (isset($selected_items['item_id']) && $selected_items['item_id'] == $itemId) {
                            return -1;
                        }
                    }
                    return $i + 1;
                }
                $i++;
            }
            return false;
        }
    }

    public function realmItemSearch(Request $request)
    {
        $items = StoreItem::where([
            ['name', 'like', '%' . $request->post('realm_txt') . '%'],
            ['realm', '=', $request->post('realm_id')],
            ['is_active', '=', 1]
        ])->get();

        $itemFound = count($items);
        $itemNameList = [];
        if ($itemFound) {
            foreach ($items as $item) {
                $cmenuInfo = StoreGroup::where('id', '=', $item->group)->firstOrFail();
                $cmenuId = $cmenuInfo['slug'];

                $crealmInfo = realm::where('id', '=', $item->realm)->firstOrFail();
                $crealmId = $crealmInfo['slug'];
                $itemNameList[] = '<a href="/store/' . $crealmId . '/' . $cmenuId . '/' . $item->id . '" class="searched_item"><img src="' . $item->featured_image . '" width="80">' . $item->name . '</a>';
            }
            return json_encode($itemNameList);
        } else {
            return json_encode($itemNameList);
        }
    }

    public function itemPreview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group'     => 'required|exists:store_groups,id',
            'realm'     => 'required|exists:realms,id',
        ]);

        if ($validator->fails() || !Auth::user()->canModerateItems())
            return "error";

        $realmInfo = realm::where('id', '=', $request->post('realm'))->firstOrFail();
        $groupInfo = StoreGroup::where('id', '=', $request->post('group'))->firstOrFail();
        $menus = $this->getStoreMenu($realmInfo->slug);

        $itemDetails['name'] = $request->post('item-name');
        $itemDetails['dp_price'] = $request->post('dp-price');
        $itemDetails['description'] = $request->post('item-detail');
        $itemDetails['featured_image'] = $request->post('image-url');
        $itemDetails['threeD_asset'] = $request->post('threeD-asset');

        $additionalContents = array();
        $additionalImages = $request->post('additional_images') ? json_decode($request->post('additional_images'),true) : array();
        $additionalTexts = $request->post('additional_text') ? json_decode($request->post('additional_text'),true) : array();
        if (isset($additionalImages) && !empty($additionalImages)) {
            for ($i = 0; $i < count($additionalImages); $i++) {
                $additionalContents[$i]['additional_text'] = (isset($additionalTexts[$i]) ? $additionalTexts[$i] : '');
                $additionalContents[$i]['additional_images'] = (isset($additionalImages[$i]) ? $additionalImages[$i] : '');
              }
        }

        $data = [
            'menus' => $menus['menus'],
            'realm_slug' => $menus['realm_slug'],
            'menus_slug' => $groupInfo->slug,
            'item_info' => $itemDetails,
            'realm_id'  => $realmInfo->id,
            'additionalContents' => $additionalContents
        ];
        return view('shop.item_preview')->with($data);


    }

}
