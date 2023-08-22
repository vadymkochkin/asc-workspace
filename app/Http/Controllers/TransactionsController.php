<?php

namespace App\Http\Controllers;
use App\Models\Cart_item;
use App\Models\Cart;
use Auth;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
      return view('ucp.pages.transactions.index');
    }

    public function requestReports(Request $request)
    {
      $query = Cart_item::query();
      $query = $query->orderBy('cart_items.id', 'DESC');
      $query = $query->leftJoin('carts', function($leftJoin)
              {
                $leftJoin->on('cart_items.cart_id', '=', 'carts.id');
              });
      $query = $query->leftJoin('store_items', function($leftJoin)
              {
                $leftJoin->on('cart_items.store_item_id', '=', 'store_items.id');
              });

      $query = $query->leftJoin('realms', function($leftJoin)
              {
                $leftJoin->on('cart_items.realm_id', '=', 'realms.id');
              });
      $query = $query->leftJoin('store_groups', function($leftJoin)
              {
                $leftJoin->on('store_items.group', '=', 'store_groups.id');
              });

      $query = $query->where('carts.user_id',Auth::user()->id);

      $query = $query->select('store_items.id','store_items.featured_image','store_items.name','realms.realm_name','cart_items.item_quantity','cart_items.status','cart_items.item_dp_cost','cart_items.character_name','cart_items.created_at','realms.slug AS realm_slug','store_groups.slug AS group_slug');

      $totalData    = $query->count();
      $totalFiltered = $totalData;

       if($request->post("length") != -1)
           {
              $query  = $query->limit($request->post("length"), $request->post("start"));
           }
      $cart_item  = $query->get();

      $data = array();
      if(!empty($cart_item))
        {
          foreach ($cart_item as $item)
           {
             $url =  url('store/'.$item->realm_slug.'/'.$item->group_slug.'/'.$item->id);
             if($item->status == 1)
                $status = '<span style="background-color:green;border-radius:3px; padding:3px 8px; color:#EEEEEE">Sent</span>';
            else
                $status = '<span style="background-color:red;border-radius:3px; padding:3px; color:#EEEEEE">Pending</span>';


                $nestedData['image']      = "<a href='{$url}' target='_blank'><img  style ='width: 50px; height: 30px;' src=".$item->featured_image."></a>";
                $nestedData['item_name']  = $item->name;
                $nestedData['realm_name'] = $item->realm_name;
                $nestedData['character']  = $item->character_name;
                $nestedData['quantity']   = $item->item_quantity;
                $nestedData['status']     = $status;
                $nestedData['total']      = $item->item_dp_cost*$item->item_quantity;
                $nestedData['created']    = (new \Carbon\Carbon($item->created_at))->diffForHumans();

                $data[] = $nestedData;
           }
           $json_data = array(
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                    );

         echo json_encode($json_data);
        }
        else {
          $json_data = array(
                   "draw"            => 0,
                   "recordsTotal"    => 0,
                   "recordsFiltered" => 0,
                   "data"            => ''
                   );
          echo json_encode($json_data);
      }

    }


    public function cartHistory()
    {
      return view('ucp.pages.transactions.cart_history');

    }

    public function cartReport(Request $request)
    {
      $cartInfo      = Cart::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
      $totalData     = $cartInfo->count();
      $totalFiltered = $totalData;
      $data = array();
      $no =0;
      if(!empty($cartInfo))
        {
          foreach ($cartInfo as $item)
           {
              $show                       =  route('store.display_cart',$item->id);
              $nestedData['no']           = ++$no;
              $nestedData['total_items']  = count($item->items);
              $nestedData['total_dp']     = $item->total;
              $nestedData['created']      = (new \Carbon\Carbon($item->created_at))->diffForHumans();
              $nestedData['action']       = "&emsp;<a cart-id='{$item->id}' class='cart-trigger' title='view' ><i class='material-icons'>visibility</i></a>";
              $data[] = $nestedData;
           }
           $json_data = array(
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                    );
         echo json_encode($json_data);
        }
        else {
          $json_data = array(
                   "draw"            => 0,
                   "recordsTotal"    => 0,
                   "recordsFiltered" => 0,
                   "data"            => ''
                   );
          echo json_encode($json_data);
      }

    }

    public function display_cart(Request $request)
    {
      $cartItems    = Cart_item::where('cart_id',$request->post("cart_id"))->get();
      $i            = 0;
      $itemsInformations = array();
        $itemsInformations['cart_id'] = $request->post("cart_id");
        $itemsInformations['total_dp'] = $cartItems[0]->cart->total;
        foreach ($cartItems as $items) {
          $itemsInformations['details'][$i]['url'] = 'store/'.$items->store_items->Realm->slug.'/'.$items->store_items->Group->slug.'/'.$items->store_items->id;
          $itemsInformations['details'][$i]['image'] = $items->store_items->featured_image;
          $itemsInformations['details'][$i]['item_u_id'] = $items->store_items->id;
          $itemsInformations['details'][$i]['item_name'] = $items->store_items->name;
          $itemsInformations['details'][$i]['group'] = $items->store_items->Group->title;
          $itemsInformations['details'][$i]['realm'] = $items->store_items->Realm->realm_name;
          $itemsInformations['details'][$i]['character'] = $items->character_name;
          $itemsInformations['details'][$i]['character_type'] =($items->character_type == 1? 'self' : 'other');
          $itemsInformations['details'][$i]['product_price'] = $items->item_dp_cost;
          $itemsInformations['details'][$i]['quantity'] = $items->item_quantity;

          if(!$items->store_items->Realm->is_active || !$items->store_items->is_active)
            $itemsInformations['details'][$i]['is_active'] = 0;
          else
            $itemsInformations['details'][$i]['is_active'] = 1;
          $i++;
        }
        return json_encode($itemsInformations);

    }

}
