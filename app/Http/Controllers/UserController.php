<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Models\User;
use App\Models\User_recent_connection;
use Illuminate\Http\Request;
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        return view('ucp.pages.users.index', [
            'recent_connections'  => User_recent_connection::where('user_id', $request->user()->id)->orderBy('id', 'desc')->take(10)->get(),
        ]);
    }
    public function Users()
    {
      return view('ucp.pages.users.user_list');
    }
    public function userReport(Request $request)
    {
      if(!Auth::user()->canModerateUsers())
          return redirect()->back();

      $users        = User::all()->sortByDesc("id");
      $totalData     = $users->count();
      $totalFiltered = $totalData;
      $data = array();
      $no =0;
      if(!empty($users))
        {
          $userRoles = User::getPossibleRoles();
          foreach ($users as $user)
           {
              $role = "<select onchange='changeUserAccessLevel(this,{$user->id});'>";

              if($user->id == Auth::user()->id)
                  continue;

              foreach ($userRoles as $roleKey => $rolevalue)
              {
                if($user->getAccessLevelString() == $rolevalue)
                    $role .= "<option value='{$roleKey}' selected>{$rolevalue}</option>";
                else
                  $role .= "<option value='{$roleKey}'>{$rolevalue}</option>";
              }
              $role .= "</select>";

              $show =  route('display',$user->id);
              $nestedData['no']           = ++$no;
              $nestedData['user_name']    = $user->username;
              $nestedData['email']        = $user->email;
              $nestedData['position']     = $role;
              $nestedData['status']       = ($user->activated == 1 ? "Verified" : "Unverified");
              $nestedData['created']      = (new \Carbon\Carbon($user->created_at))->diffForHumans();
              $nestedData['action']       = "&emsp;<a href='{$show}' title='view' ><i class='material-icons'>visibility</i></a>
                                            &emsp;";

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
                   "data"            => []
                   );
          echo json_encode($json_data);
      }

    }
    public function displayUserView($id)
    {
      $user = User::find($id);
      if($user == null || !Auth::user()->canModerateUsers())
          return redirect()->back();

      return view('ucp.pages.users.manage_user', [
            'user_details'             => $user,
            'last_ip'  => User_recent_connection::where('user_id', $user->id)->orderBy('id', 'desc')->take(1)->first()
        ]);

    }

    public function setAccessLevel(Request $request)
    {
      $validator = Validator::make($request->all(),[
           'user_id'            => 'required',
           'requested_role'     => 'required',
       ]);

       if ($validator->fails())
            return "Error";

      if(!Auth::user()->canModerateUsers() || ($request->post('user_id') ==Auth::user()->id))
          return "Error";

      $user = User::find($request->post('user_id'));

       if ($user == null || !User::getAccessLevelDisplayString($request->post('requested_role')))
           return "Error";

      $old_access_level     = User::getAccessLevelDisplayString($user->access_level);
      $current_access_level = User::getAccessLevelDisplayString($request->post('requested_role'));

      $user->access_level = $request->post('requested_role');
      $user->save();

      return "Access Level successfully change from ".$old_access_level." to ".$current_access_level." for ".$user->username;
    }
}
