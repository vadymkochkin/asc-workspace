<?php
namespace App\Http\Controllers\store;
use Ascension\Emulator\Client;
use App\Http\Controllers\Controller;
use App\Models\StoreItem;
use App\Models\Realm;
use App\Models\Cart;
use App\Models\User;
use App\Models\Cart_item;
use App\Models\Donation_point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use GrahamCampbell\GitHub\Facades\GitHub;
use Auth;
use Validator;
class CartController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function openCart(Request $request)
    {
      $data = [
          'selectedItems'   => $request->session()->get('selectedItems'),
          'realmAvailable'  => $request->session()->get('realmAvailable')
      ];
     return view('shop.cart')->with($data);

    }

    public function saveCart(Request $request)
    {
      //$request->session()->put('realmAvailable',$request->post("product_info"));
      $request->session()->put('selectedItems',$request->post("cart_data"));

      echo (!empty($request->post("cart_data"))? "Cart successfully saved!" : "Cart successfully reset!");
    }

    public function addToCart(Request $request)
    {
       $itemId            = (int)$request->post("itemId");
       $item_u_id         = (int)$request->post("item_u_id");
       $realmID           = (int)$request->post("realmID");
       $productInfo       = json_decode($request->session()->get('realmAvailable'), true);
       $cartData          = json_decode($request->session()->get('selectedItems'), true);

      if(!$this->in_array_field($itemId,'item_id',$productInfo,FALSE,TRUE))
      {
        $productInfo = $this->getRealmItems($itemId,$productInfo);
        $request->session()->put('realmAvailable',json_encode($productInfo));
      }

      $isItemAdded = $this->setCartData($realmID,$cartData,$itemId);
      $cartData = ($isItemAdded ? $isItemAdded : $cartData);
      $result = ($isItemAdded ? "has been added to cart." : "already exists in your cart.");

      $request->session()->put('selectedItems',json_encode($cartData));
      echo json_encode($result);
    }

    private function getRealmItems($itemId,$productInfo)
    {
      $itemsInfo                 = StoreItem::where('itemid', '=',$itemId)->get();
      $realmAvailable['item_id'] = $itemId;

      $i = 0;
      foreach ($itemsInfo as $itemInfo)
      {
        if($itemInfo->Realm->is_active == 0)
            continue;

         $realmAvailable['realm_available'][$i]['item_realm_id']   = $itemInfo->Realm->id;
         $realmAvailable['realm_available'][$i]['item_realm_name'] = $itemInfo->Realm->realm_name;
         $realmAvailable['realm_available'][$i]['item_title']      = $itemInfo->name;
         $realmAvailable['realm_available'][$i]['item_u_id']       = $itemInfo->id;
         $realmAvailable['realm_available'][$i]['item_dp']         = $itemInfo->dp_price;
         $realmAvailable['realm_available'][$i]['item_group']      = $itemInfo->Group->title;
         $realmAvailable['realm_available'][$i]['item_image']      = $itemInfo->featured_image;
         $realmAvailable['realm_available'][$i]['item_url']        =  \App::make('url')->to('/').'/'.'store/'.$itemInfo->Realm->slug.'/'.$itemInfo->Group->slug.'/'.$itemInfo->id;
         $i++;
      }
      array_push($productInfo,$realmAvailable);

      return $productInfo;
    }

    private function setCartData($realmID,$cartData,$itemId,$character="",$quantity=1,$character_type="")
    {
      $index = $this->in_array_field($realmID,'realm',$cartData,$itemId,FALSE);

      if($index == -1)
          return null;

       else if($index)
       {
         $availableIndex = count($cartData[$index-1]['purchase_details']);
         $cartData[$index-1]['purchase_details'][$availableIndex]['item_id'] = $itemId;
         $cartData[$index-1]['purchase_details'][$availableIndex]['quantity'] = 1;
         return $cartData;
       }

       else
       {
         $selectedItems['character'] = $character;
         $selectedItems['realm'] = $realmID;
         $selectedItems['character_type'] = $character_type;
         $selectedItems['purchase_details'][0]['item_id'] = $itemId;
         $selectedItems['purchase_details'][0]['quantity'] = $quantity;
         array_push($cartData,$selectedItems);
         return $cartData;
       }
    }


    private function in_array_field($needle, $needle_field, $haystack,$itemId, $flag)
    {
      if($flag){
          foreach ($haystack as $item){
              if (isset($item[$needle_field]) && $item[$needle_field] == $needle)
              {
                  return true;
                }
          }
          return false;
      }
      else{
          $i=0;
          foreach ($haystack as $item){
              if (isset($item[$needle_field]) && $item[$needle_field] == $needle&& $item['character'] == "")
              {
                foreach($item['purchase_details'] as $selected_items)
                {
                  if (isset($selected_items['item_id']) && $selected_items['item_id'] == $itemId)
                  {
                    return -1;
                  }
                }
                return $i+1;
              }
              $i++;
          }
          return false;
        }
    }

    public function checkOut(Request $request)
    {
      $cartData    = json_decode($request->post("cart_data"), true);

      if(empty($cartData)){
          return redirect()->back();
        }

      $itemsArray =   $cartData;
      $soapPackets =array();
      $itemMaxLimit = 7;
      $totalDp = 0;
      $subject ="sending items for user";
      $body   ="Thanks for purchasing items";
      foreach ($itemsArray as $items) {

        if(empty($items['character'])){
            return redirect()->back();
            // echo "Problem Detected for character";
            // die();
          }

      // making packet for soap command
        $packet['realm_id']    = $items['realm'];
        $char = explode("(Lv", $items['character'],2);
        $packet['character']   = $char[0];
        $packet['packet_total_dp']   = 0;
        $packet['command_string'] = $packet['character']." \"".$subject."\" \"".$body."\"";
        $commandString = $packet['character']." \"".$subject."\" \"".$body."\"";

        $i =0;
        foreach ($items['purchase_details'] as $purchase_items)
        {
          $item = $this->getItemInfo($purchase_items['item_id'],$items['realm']);

          if($item == FALSE || $item->Realm->is_active == 0){
              return redirect()->back();
          }
          $packet['item_list'][$i]['url'] = \App::make('url')->to('/').'/'.'store/'.$item->Realm->slug.'/'.$item->Group->slug.'/'.$item->id;
          $packet['item_list'][$i]['image'] = $item->featured_image;
          $packet['item_list'][$i]['item_u_id'] = $item->id;
          $packet['item_list'][$i]['item_id'] = $purchase_items['item_id'];
          $packet['item_list'][$i]['quantity'] = $purchase_items['quantity'];
          $packet['item_list'][$i]['unit_dp_price'] = $item->dp_price;
          $packet['item_list'][$i]['item_name'] = $item->name;
          $packet['item_list'][$i]['realm_name'] = $item->Realm->realm_name;
          $packet['item_list'][$i]['character'] = $items['character'];
          $packet['item_list'][$i]['character_type'] = $items['character_type'];
          $packet['item_list'][$i]['group'] = $item->Group->title;
          $totalDp += $purchase_items['quantity']*$item->dp_price;
          $packet['command_string'] .=" ".$purchase_items['item_id'].":".$purchase_items['quantity'];
          $packet['packet_total_dp'] += $purchase_items['quantity']*$item->dp_price;

          if($i >= $itemMaxLimit)
          {
            array_push($soapPackets,$packet);
            $packet['command_string'] = $commandString;
            $packet['item_list'] = array();
            $i = -1;
          }
          $i++;
        }
        if (count($packet['item_list']))
          {
            array_push($soapPackets,$packet);
            $packet = array();
          }
      }

      if(Donation_point::UserCurrentDp(Auth::user()->id) < $totalDp)
          return redirect()->back();


      $cart = new Cart();
      $cart->user_id = Auth::user()->id;
      $cart->total   = $totalDp;
      $cart->save();

      $cart_id = $cart->id;
      $soapResult['success']          = NULL;
      $soapResult['failed']           = NULL;
      $soapResult['failed_total_dp']  = 0;
      $soapResult['success_total_dp'] = 0;
      $responds                       = NULL;


      foreach ($soapPackets as $packet) {

        $realmDetails = Realm::find($packet['realm_id']);

        $user_dp = Donation_point::where([
                                          ['user_id',   '=',Auth::user()->id],
                                          ['isactive',  '=', 1],
                                        ])->first();

        $client = new Client($realmDetails->world_console_username,
                                $realmDetails->world_console_password,
                                $realmDetails->world_console_host,
                                $realmDetails->world_console_port);
        $responds = $client->send()->items($packet['command_string']);


        if(isset($responds['status'])? FALSE : TRUE)
        {
          $user_dp->total_dp = ($user_dp->total_dp - $packet['packet_total_dp']);
          $user_dp->used_dp = $user_dp->used_dp + $packet['packet_total_dp'];
          $user_dp->save();

          $soapResult['success_total_dp'] += $packet['packet_total_dp'];
          $soapResult['success'][]= $packet['item_list'][0];
        }
        else
        {
          $soapResult['failed_total_dp'] += $packet['packet_total_dp'];
          $soapResult['failed'][]= $packet['item_list'][0];
        }

        $this->insertCart($packet,$responds,$cart_id);

    }
        $request->session()->put('realmAvailable',"[]");

        $request->session()->put('selectedItems',"[]");

      $data = [
          'checkout_data'         => $soapResult,
      ];
      return view('shop.checkout')->with($data);

    }

    private function insertCart($packet,$responds,$cart_id)
    {

      foreach ($packet['item_list'] as $item)
      {
        $cart_item = new Cart_item();
        $cart_item->cart_id        = $cart_id;
        $cart_item->store_item_id  = $item['item_u_id'];
        $cart_item->realm_id       = $packet['realm_id'];
        $cart_item->item_quantity  = $item['quantity'];
        $cart_item->item_dp_cost   = $item['unit_dp_price'];
        $cart_item->character_name = $packet['character'];
        $cart_item->character_type = ($item['character_type'] == 'self'? Cart_item::CHARACTER_TYPE_SELF : Cart_item::CHARACTER_TYPE_OTHER);
        $cart_item->soap_reply     = (isset($responds['status'])? $responds['message'] : $responds[0]);
        $cart_item->status         = (isset($responds['status'])? 0 : 1);
        $cart_item->save();
      }

    }

    private function getItemInfo($itemId,$realmId)
    {
      $item = StoreItem::where([['itemid', '=', $itemId],['realm', '=', $realmId]])->first();
      return (!empty($item) ? $item : FALSE);
    }

    public function PurchaseAgain(Request $request)
    {
      $validator = Validator::make($request->all(),[
           'cart_info'            => 'required',
       ]);

       if ($validator->fails())
            return "error";

      $cart_info = json_decode($request->post('cart_info'), true);

      foreach ($cart_info as $item) {
         $id =$item['u_id'] ;
         $productInfo       = json_decode($request->session()->get('realmAvailable'), true);
         $cartData          = json_decode($request->session()->get('selectedItems'), true);

         $itemDetails = StoreItem::find($id);
         if ($itemDetails == NULL)
               return "error";

        if(!$this->in_array_field($itemDetails->itemid,'item_id',$productInfo,FALSE,TRUE))
        {
          $productInfo = $this->getRealmItems($itemDetails->itemid,$productInfo);
          $request->session()->put('realmAvailable',json_encode($productInfo));
        }

        $isItemAdded = $this->setCartData($itemDetails->Realm->id,$cartData,$itemDetails->itemid,$item['character'],$item['quantity'],$item['character_type']);
        $cartData = ($isItemAdded ? $isItemAdded : $cartData);
        $result = ($isItemAdded ? "has been added to cart" : "already exists into cart");

        $request->session()->put('selectedItems',json_encode($cartData));
      }
      return "success";
    }

    public function show(Request $request)
    {
      echo "<pre>";
      // $realmItemBuffer = $request->session()->get('realmAvailable');
      // echo "available realms";
      // print_r($realmItemBuffer);
      // echo "<hr>";
      // $data = $request->session()->get('selectedItems');
      // echo "Selected Items";
      // print_r(json_encode($data));
      //echo(\App::make('url')->to('/'));
      // $account_id    = $request->session()->get('account_id');
      // echo $account_id;
      // $productInfo       = json_decode($request->session()->get('selectedItems'), true);
      // print_r($productInfo);

        // $labels = [ 'public','bug' ];
        //
        // $create_issue = GitHub::issues()->create('cs-shovon','tesing-hooks', [
        //     'title' => "test",
        //     'body'  => $this->arrayToIssueBody([
        //         'user_id'       => 1,
        //         'description'   => "testing title for ascension",
        //         'votes' => [
        //             'positive' => [],
        //             'negative' => []
        //         ]
        //     ]),
        //     'labels' => $labels
        // ]);
        //
        // print_r($create_issue);
    }

    public  function arrayToIssueBody(array $issue) {
        $body = "```json\n";
        $body.= json_encode($issue, JSON_PRETTY_PRINT);
        $body.= "\n```";
        return $body;

    }


}
