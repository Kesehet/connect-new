<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Leave;
use App\Timesheet;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller {

    public $successStatus = 200;
    public $cfy = "";
    
    public function __construct()
    {
        $this->cfy = date('n') > 3 ? date('Y').'-'.(date('y') + 1) : (date('Y') - 1).'-'.date('y');
    }
            
    public function login() {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            //$success['token'] = $user->createToken('MyApp')->accessToken;
            $success['token'] = "thinknyx@123";
            
            return response()->json(['status' => 1, 'user_id'=> $user->id, 'user_name'=> $user->username, 'success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|email',
                    'password' => 'required',
                    'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        return response()->json(['success' => $success], $this->successStatus);
    }

    public function details() {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
    
    public function leaves() {
        $uid = request('uid');
        $leaves = Leave::where('fy', $this->cfy)->whereIn('employee_id', array($uid))->orderBy('created_at', 'DESC')->get();
        //return response()->json(['success' => $leaves], $this->successStatus);
        return response()->json($leaves, $this->successStatus);
    }
    
    public function timesheets() {
        $uid = request('uid');
        $timesheets = Timesheet::where('fy', $this->cfy)->whereIn('user_id', array($uid))->orderBy('created_at', 'DESC')->get();
        //return response()->json(['success' => $leaves], $this->successStatus);
        return response()->json($timesheets, $this->successStatus);
    }

}
