<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\RemoteDB\Account;
use App\Models\User_recent_connection;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user';
    protected $redirectAfterLogout = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Logout, Clear Session, and Return.
     *
     * @return void
     */
     public function login(Request $request)
     {
      $this->validate($request, [
          'email'    => 'required',
          'password' => 'required',
      ]);

      $login_type = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL )
          ? 'email'
          : 'username';

      $request->merge([
          $login_type => $request->input('email')
      ]);
      if (Auth::attempt($request->only($login_type, 'password'))) {
          //$accountInfo = $this->getUserInfo($login_type,$request->input('email'));

          $request->session()->put('account_id',isset($accountInfo->id) ? $accountInfo->id:NULL);
          $request->session()->put('realmAvailable', json_encode(array()));
          $request->session()->put('selectedItems', json_encode(array()));

          $recent_connection = new User_recent_connection();
          $recent_connection->user_id = Auth::user()->id;
          $recent_connection->action_type = User_recent_connection::CONNECTION_TYPE_USER_PANEL;
          $recent_connection->connection_address = $request->ip();
          $recent_connection->connection_country = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? $_SERVER['HTTP_CF_IPCOUNTRY'] : 'NON-CLOUD-FLARE';
          $recent_connection->connected_at = time();
          $recent_connection->save();

          return redirect()->intended($this->redirectPath());
      }

      return redirect()->back()
          ->withInput()
          ->withErrors([
              'login' => 'These credentials do not match our records.',
          ]);
      }



    public function logout()
    {
        $user = Auth::user();
        Log::info('User Logged Out. ', [$user]);
        Auth::logout();
        Session::flush();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }
    private function getUserInfo($niddle,$email) {
      $username = ($niddle =='email'? User::select('username')->where('email',$email)->first()->username : $email);
      $accountInfo = Account::select('id','username')->where('username',$username)->first();
      return $accountInfo;
   }

}
