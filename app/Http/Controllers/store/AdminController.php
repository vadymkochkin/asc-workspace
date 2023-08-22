<?php

namespace App\Http\Controllers\store;

use Auth;
use Validator;
use App\Models\StoreItem;
use App\Models\StoreGroup;
use App\Models\Realm;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function editItem(Request $request)
  {
    $validator = Validator::make($request->all(),[
          'id'      => 'required|exists:store_items,id',
     ]);

     if ($validator->fails() || !Auth::user()->canModerateItems())
          return "error";

      $itemInfo  = StoreItem::find($request->post('id'));

      $itemsInformations['u_id']                = $itemInfo->id;
      $itemsInformations['item_id']             = $itemInfo->itemid;
      $itemsInformations['threeD_asset']        = $itemInfo->three_d_asset;
      $itemsInformations['name']                = $itemInfo->name;
      $itemsInformations['dp_price']            = $itemInfo->dp_price;
      $itemsInformations['realm']               = $itemInfo->realm;
      $itemsInformations['description']         = $itemInfo->description;
      $itemsInformations['group']               = $itemInfo->group;
      $itemsInformations['featured_image']      = $itemInfo->featured_image;
      $itemsInformations['additional_images']   = preg_split('/;/', $itemInfo->additional_images, -1, PREG_SPLIT_NO_EMPTY);
      $itemsInformations['additional_text']     = preg_split('/;/', $itemInfo->additional_text, -1, PREG_SPLIT_NO_EMPTY);


      $realms = Realm::all();
      $groups  = StoreGroup::all();

      $i = 0;
      $realm_information = array();
      foreach ($realms as $realm ) {

        $realm_information[$i]['id']   = $realm->id;
        $realm_information[$i]['name'] = $realm->realm_name;
        $i++;
      }

      $i = 0;
      $group_information = array();
      foreach ($groups as $group ) {

        $group_information[$i]['id']   = $group->id;
        $group_information[$i]['name'] = $group->title;
        $i++;
      }
      $data = [
          'item_information'   => $itemsInformations,
          'realm_information'  => $realm_information,
          'group_information'  => $group_information
      ];

    return json_encode($data);

  }

  public function updateItem(Request $request)
  {
    $validator = Validator::make($request->all(),[
         'u_id'         => 'required|exists:store_items,id',
         'item-id'       =>  [
                             'required',
                             'integer',
                               Rule::unique('store_items','itemid')->where(function ($query) {
                               return $query->where([
                                                      ['realm', '=', Input::post('realm_id')],
                                                      ['id', '!=', Input::post('u_id')],
                                                      ['is_active','=',1]
                                                    ]);
                                 })
                             ],
         'item-name'    => 'required|min:3',
         'group_id'     => 'required|exists:store_groups,id',
         'realm_id'     => 'required|exists:realms,id',
         'dp-price'     => 'required|integer',
         'item-detail'  => 'required|min:6',
         'image-url'    => 'required|url',
         'threeD-asset' => 'required|url',
    ]);

    if ($validator->fails() || !Auth::user()->canModerateItems())
          return json_encode($validator->errors());

      $item_update = StoreItem::find($request->post('u_id'));

      $item_update->itemid            = $request->post('item-id');
      $item_update->name              = $request->post('item-name');
      $item_update->dp_price          = $request->post('dp-price');
      $item_update->description       = $request->post('item-detail');
      $item_update->featured_image    = $request->post('image-url');
      $item_update->three_d_asset     = $request->post('threeD-asset');
      $item_update->realm             = $request->post('realm_id');
      $item_update->group             = $request->post('group_id');
      $item_update->additional_images = $request->post('additional_images') ? implode(";",json_decode($request->post('additional_images'),true)) : "";
      $item_update->additional_text   = $request->post('additional_text')   ? implode(";",json_decode($request->post('additional_text'),true)) : "";
      $item_update->save();
    return json_encode("Successfully Saved");
  }

  public function addItem(Request $request)
  {
    $validator = Validator::make($request->all(),[
        'item-id'       =>  [
                            'required',
                            'integer',
                              Rule::unique('store_items','itemid')->where(function ($query) {
                              return $query->where([
                                                     ['realm', '=', Input::post('realm_id')],
                                                     ['is_active','=',1]
                                                   ]);
                                })
                            ],
         'item-name'    => 'required|min:3',
         'group_id'     => 'required|exists:store_groups,id',
         'realm_id'     => 'required|exists:realms,id',
         'dp-price'     => 'required|integer',
         'item-detail'  => 'required|min:6',
         'image-url'    => 'required|url',
         'threeD-asset' => 'required|url',
    ]);

    if ($validator->fails() || !Auth::user()->canModerateItems())
          return json_encode($validator->errors());

        $new_item = new StoreItem();

        $new_item->itemid            = $request->post('item-id');
        $new_item->name              = $request->post('item-name');
        $new_item->dp_price          = $request->post('dp-price');
        $new_item->description       = $request->post('item-detail');
        $new_item->featured_image    = $request->post('image-url');
        $new_item->three_d_asset     = $request->post('threeD-asset');
        $new_item->realm             = $request->post('realm_id');
        $new_item->group             = $request->post('group_id');
        $new_item->video             = "";
        $new_item->additional_images = $request->post('additional_images') ? implode(";",json_decode($request->post('additional_images'),true)) : "";
        $new_item->additional_text   = $request->post('additional_text')   ? implode(";",json_decode($request->post('additional_text'),true)) : "";
        $new_item->save();

    return json_encode("Successfully Saved");
  }

  public function deleteItem(Request $request)
  {
    $validator = Validator::make($request->all(),[
         'id'            => 'required|exists:store_items,id'
     ]);

     if ($validator->fails() || !Auth::user()->canModerateItems())
          return json_encode("Something went wrong");

      $item = StoreItem::find($request->post('id'));
      $item->is_active = 0;
      $item->save();
      return json_encode("Successfuly deleted");

  }

  public function realmInfo(Request $request)
  {
    $validator = Validator::make($request->all(),[
         'id'            => 'required',
     ]);

     if ($validator->fails() || !Auth::user()->canModerateRealms())
          return "error";

    $realmDetails = Realm::find($request->post('id'));

    if ($realmDetails == NULL)
          return "error";

    $realmInformations['u_id']                   = $realmDetails->id;
    $realmInformations['realm_name']             = $realmDetails->realm_name;
    $realmInformations['realm_host_name']        = $realmDetails->realm_host_name;
    $realmInformations['realm_port']             = $realmDetails->realm_port;
    $realmInformations['char_db_name']           = $realmDetails->char_db_name;
    $realmInformations['char_db_host_name']      = $realmDetails->char_db_host_name;
    $realmInformations['char_db_user_name']      = $realmDetails->char_db_user_name;
    $realmInformations['char_db_password']       = $realmDetails->char_db_password;
    $realmInformations['char_db_port']           = $realmDetails->char_db_port;
    $realmInformations['world_console_host']     = $realmDetails->world_console_host;
    $realmInformations['world_console_username'] = $realmDetails->world_console_username;
    $realmInformations['world_console_password'] = $realmDetails->world_console_password;
    $realmInformations['world_console_port']     = $realmDetails->world_console_port;
    $realmInformations['image']                  = $realmDetails->image;
    $realmInformations['slug']                   = $realmDetails->slug;


    return json_encode($realmInformations);

  }

  public function addRealm(Request $request)
  {
    $validator = Validator::make($request->all(), [
            'realm_name'         => 'required|min:3|unique:realms,realm_name',
            'realm_host_name'    => 'required|ip',
            'realm_host_port'    => 'required|integer',
            'image'              => 'required',
            'char_db_name'       => 'required',
            'char_host_name'     => 'required|ip',
            'char_db_port'       => 'required|integer',
            'char_db_username'   => 'required|min:3|max:255',
            'char_db_password'   => 'required|min:3',
            'console_host'       => 'required|ip',
            'console_port'       => 'required|integer',
            'console_username'   => 'required|min:3',
            'console_password'   => 'required|min:3'
        ]);
    if ($validator->fails())
        return json_encode($validator->errors());

    $realm = new Realm();


    $realm->realm_name              = $request->post('realm_name');
    $realm->realm_host_name         = $request->post('realm_host_name');
    $realm->realm_port              = $request->post('realm_host_port');
    $realm->char_db_name            = $request->post('char_db_name');
    $realm->char_db_host_name       = $request->post('char_host_name');
    $realm->char_db_user_name       = $request->post('char_db_username');
    $realm->char_db_password        = $request->post('char_db_password');
    $realm->char_db_port            = $request->post('char_db_port');
    $realm->world_console_host      = $request->post('console_host');
    $realm->world_console_username  = $request->post('console_username');
    $realm->world_console_password  = $request->post('console_password');
    $realm->world_console_port      = $request->post('console_port');
    $realm->image                   = $request->post('image');
    $realm->slug                    = str_slug($request->post('realm_name'), "-");
    $realm->is_active               = 1;
    $realm->save();

    return json_encode("Successfully Saved");
  }

  public function editRealm(Request $request)
  {
    $validator = Validator::make($request->all(), [
            'realm_id'           => 'required|exists:realms,id',
            'realm_name'         => 'required|min:3',
            'realm_host_name'    => 'required|ip',
            'realm_host_port'    => 'required|integer',
            'image'              => 'required',
            'char_db_name'       => 'required',
            'char_host_name'     => 'required|ip',
            'char_db_port'       => 'required|integer',
            'char_db_username'   => 'required|min:3|max:255',
            'char_db_password'   => 'required|min:3',
            'console_host'       => 'required|ip',
            'console_port'       => 'required|integer',
            'console_username'   => 'required|min:3',
            'console_password'   => 'required|min:3'
        ]);
    if ($validator->fails())
        return json_encode($validator->errors());

    $realm = Realm::find($request->post('realm_id'));


    $realm->realm_name              = $request->post('realm_name');
    $realm->realm_host_name         = $request->post('realm_host_name');
    $realm->realm_port              = $request->post('realm_host_port');
    $realm->char_db_name            = $request->post('char_db_name');
    $realm->char_db_host_name       = $request->post('char_host_name');
    $realm->char_db_user_name       = $request->post('char_db_username');
    $realm->char_db_password        = $request->post('char_db_password');
    $realm->char_db_port            = $request->post('char_db_port');
    $realm->world_console_host      = $request->post('console_host');
    $realm->world_console_username  = $request->post('console_username');
    $realm->world_console_password  = $request->post('console_password');
    $realm->world_console_port      = $request->post('console_port');
    $realm->image                   = $request->post('image');
    $realm->save();

    return json_encode("Successfully Saved");
  }

  public function deleteRealm(Request $request)
  {
    $validator = Validator::make($request->all(),[
         'id'     => 'required',
     ]);

     if ($validator->fails() || !Auth::user()->canModerateRealms())
          return "error";

    $realm = Realm::find($request->post('id'));

    if ($realm == NULL)
          return "error";

    $realm->is_active = Realm::REALM_STATUS_INACTIVE;
    $realm->save();

    return json_encode("Successfully Deleted");

  }

  public function addFeatureItem(Request $request)
  {
    $validator = Validator::make($request->all(),[
         'id'     => 'required|exists:store_items,id|unique:feature_items,store_item_id',
         'realm'     => 'required|exists:realms,id'
     ]);

     if ($validator->fails() || !Auth::user()->canModerateItems())
           return json_encode($validator->errors()->all() ? $validator->errors()->all()[0] : "something went wrong");

        $add_feature_items = new \App\Models\Feature_item();
        $add_feature_items->realm_id = $request->post('realm');
        $add_feature_items->store_item_id = $request->post('id');
        $add_feature_items->save();

      return json_encode("Added to feature Successfuly");
  }

  public function edit_feature(Request $request)
  {
    $validator = Validator::make($request->all(),[
         'realm'     => 'required|exists:realms,id'
     ]);

   if ($validator->fails() || !Auth::user()->canModerateItems())
         return json_encode("Error");

    $feature_items = \App\Models\Feature_item::where('realm_id', '=', $request->post('realm'))->orderBy('sequence','DESC')->orderBy('id','DESC')->get();
    $i = 0;
    $item = array();
    foreach ($feature_items as $feature_item) {
      $item[$i]['id'] =  $feature_item->id;
      $item[$i]['name'] = $feature_item->StoreItem->name;
      $item[$i]['image']  = $feature_item->StoreItem->featured_image;
      $item[$i]['dp']     = $feature_item->StoreItem->dp_price;
      $i++;
    }
    return json_encode($item);
  }
  public function feature_save(Request $request)
  {
    $validator = Validator::make($request->all(),[
         'realm'     => 'required|exists:realms,id',
         'item_removed' => 'required',
         'item_ordered' => 'required'

     ]);
     if ($validator->fails() || !Auth::user()->canModerateItems())
           return json_encode("Error");

      $ordered_items = json_decode($request->post('item_ordered'),true);
      $max_length    = count($ordered_items);
      $remove_items  =  json_decode($request->post('item_removed'),true);
      if($max_length){
          foreach ($ordered_items as $item) {
              $featured_item = \App\Models\Feature_item::find($item);
              $featured_item->sequence = $max_length--;
              $featured_item->save();
          }
      }
    if(count($remove_items)){
          foreach ($remove_items as $remove_item) {
              $removed_item = \App\Models\Feature_item::find($remove_item);
              $removed_item->delete();
          }
    }
    return "Featured page updated Successfully";
  }


}
