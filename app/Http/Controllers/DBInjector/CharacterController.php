<?php

namespace App\Http\Controllers\DBInjector;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Realm;
use App\Models\RemoteDB\Character;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
class CharacterController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     public function SelfCharacters(Request $request)
     {

      $realmsId = $request->post("realm_id");
      $account_id = $request->session()->get('account_id');

      $realmDetails = Realm::find($realmsId);

      DB::purge('mysql1');
     \Config::set("database.connections.mysql1",[
              "driver"    => 'mysql',
              "host"      => $realmDetails->char_db_host_name,
              'port'      => $realmDetails->char_db_port,
              "database"  => $realmDetails->char_db_name,
              "username"  => $realmDetails->char_db_user_name,
              "password"  => $realmDetails->char_db_password
          ]);

       $someModel = new Character();
       $characters = $someModel->select('name','level')->where('account',$account_id)->get();

       $selfCharacters = array();
       $i =0;
       $selfCharacters['realm'] = $realmsId;
       if(!empty($characters)){
         foreach ($characters as $character) {
            $selfCharacters['characters'][$i] = $character->name.'(Lv'.$character->level.')';
            $i++;
         }
       }
       echo(json_encode($selfCharacters));

    }
     public function OthersCharacter(Request $request)
     {
       $realmsId      = $request->post("realm_id");
       $RequestedChar = $request->post("character");
       $account_id    = $request->session()->get('account_id');

       $realmDetails = Realm::find($realmsId);

       DB::purge('mysql1');
      \Config::set("database.connections.mysql1",[
               "driver"    => 'mysql',
               "host"      => $realmDetails->char_db_host_name,
               'port'      => $realmDetails->char_db_port,
               "database"  => $realmDetails->char_db_name,
               "username"  => $realmDetails->char_db_user_name,
               "password"  => $realmDetails->char_db_password
           ]);

       $someModel = new Character();
       // $characters = $someModel->select('name','level')->where('name',$RequestedChar)->first();
       $characters = $someModel->select('name','level')->where([['name',$RequestedChar],['account','!=',$account_id]])->first();


       $GiftCharacter = array();
       $GiftCharacter['realm'] = $realmsId;
       if(!empty($characters))  {
         $GiftCharacter['characters'][0] = $characters->name.'(Lv'.$characters->level.')';
       }
        echo(json_encode($GiftCharacter));

     }
}
