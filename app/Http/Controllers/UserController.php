<?php

namespace App\Http\Controllers;

use Mail;
use Brian2694\Toastr\Facades\Toastr;
use App\User;
use App\Leave;
use App\Userdetail;
use App\Totalleave;
use App\Userassign;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Excel;
use App\Exports\UsersExport;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
                
        //dd(session()->all()); 
        //echo Auth::user()->role;
        if (!Gate::allows('isAdmin') && !Gate::allows('isManager')) {
            abort(401);
        }
           
        if (Gate::allows('isAdmin')){
           $users = User::withCount(['leave', 'leave as approve_leave_count' => function($query) {
                        $query->where('is_approved', true);
                    }])->paginate(15); 
        }else{
           $users = User::withCount(['leave', 'leave as approve_leave_count' => function($query) {
                        $query->where('is_approved', true);
                    }])->whereIn('id', Request()->session()->get('AssIdsArr'))->paginate(15);  
        }
         
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if (!Gate::allows('isAdmin') && !Gate::allows('isManager')) {
            abort(401);
        }

        //$lastid =  User::orderBy('id','DESC')->first()->id;
        //$newid = $lastid+1;

        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if (!Gate::allows('isAdmin') && !Gate::allows('isManager')) {
            abort(401);
        }
        $request->validate([
            'username' => 'required',
            //'image' => 'required',
            'fname' => 'required',
            //'lname' => 'required',
            'email' => 'required',
            'email' => 'unique:users,email',
            'password' => 'required',
            'status' => 'required',
        ]);

        $cfy = Request()->session()->get('CFY');

        $user = new User();
        $user->username = $request->username;
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/gallery/', $filename);
            $user->image = $filename;
        } else {
            $user->image = '';
        }
        $user->emp_id = $request->emp_id;
        $user->first_name = $request->fname;
        $user->last_name = $request->lname;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->join_date = $request->join_date;
        $user->job_type = $request->job_type;
        $user->city = $request->city;
        $user->age = $request->age;
        $user->password = bcrypt($request->password);
        $user->status = $request->status;
        $user->designation = $request->designation;
        $user->manager = $request->manager;
        $user->department = $request->department;

        $user->save();

        Userdetail::create(['user_id' => $user->id]);
        Totalleave::create(['employee_id' => $user->id, 'leaveyear' => $cfy, 'totalleaves' => 18]);
        if (!Gate::allows('isAdmin')){
         Userassign::create(['user_id' => Auth::id(), 'assign_id' => $user->id]);
         $AssIdsArr = Userassign::Where('user_id', Auth::id())->pluck('assign_id')->toArray();
         Request()->session()->put('AssIdsArr', $AssIdsArr); 
        }
        
        $data['title'] = $request->fname . ' ' . $request->lname;
        $data['email'] = $request->email;
        $data['msg'] = 'Your account has been created on Thinknyx Connect. You will be receiving the login details Shortly. As soon as you receive the details you may change your password';

        Mail::send('admin.emails.newuser', $data, function($message) use ($data) {
            $message->to($data['email'], $data['title']);
            $message->subject('Thinknyx New Account ' . $data['title']);
            //$message->from('connect@thinknyx.com', 'From User');
        });

        $data['msg'] = 'Your login details on Thinknyx Connect';
        $data['pass'] = $request->password;
        Mail::send('admin.emails.newuserlogin', $data, function($message) use ($data) {
            $message->to($data['email'], $data['title']);
            $message->subject('Thinknyx Login Details ' . $data['title']);
            //$message->from('connect@thinknyx.com', 'From User');
        });

        if (Mail::failures()) {
            Toastr::Fail('Sorry! Please try again latter');
        } else {
            Toastr::success('Great! Email sent successfully');
        }

        Toastr::success('User successfully added!', 'Success');
        return redirect()->route('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id) {
        if (!Gate::allows('isAdmin') && !Gate::allows('isManager')) {
            abort(401);
        }
        $user = User::find($id);
        $userdetail = Userdetail::Where('user_id', $id)->first();
        //dd($users->username);
        return view('admin.user.view', compact('user', 'userdetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        if (!Gate::allows('isAdmin') && !Gate::allows('isManager')) {
            abort(401);
        }
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        if (!Gate::allows('isAdmin') && !Gate::allows('isManager')) {
            abort(401);
        }
        $request->validate([
            'username' => 'required',
            'fname' => 'required',
            //'lname' => 'required',
            'email' => 'required',
            'email' => 'unique:users,email,' . $id,
                //'image' => 'required',
                //'password' => 'required',
                //'status' => 'required',
        ]);
        $user = User::find($id);
        $user->username = $request->username;

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/gallery/', $filename);
            $user->image = $filename;
        } else {
            //return $request;
            //$user ->image = $request->image;
        }
        $user->first_name = $request->fname;
        $user->last_name = $request->lname;
        $user->role = $request->role;
        $user->salary = $request->salary;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->join_date = $request->join_date;
        $user->relieve_date = $request->relieve_date;
        $user->job_type = $request->job_type;
        $user->city = $request->city;
        $user->age = $request->age;
        $user->status = $request->status;
        $user->last_working = $request->last_working;
        $user->reason_exit = $request->reason_exit;
        $user->designation = $request->designation;
        $user->manager = $request->manager;
        $user->department = $request->department;


        // $user -> password = $request -> password;
        // $user -> password = bcrypt($request -> password);        
        //    dd($user);
        //  $user -> status = $request -> status == 'active'?1:0;
        $user->save();
        Toastr::success('User successfully updated!', 'Success');
        return redirect()->route('user');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assign($id) {
        
        if (!Gate::allows('isAdmin') && !Gate::allows('isManager')) {
            abort(401);
        }
        $user = User::find($id);
        $userlist = User::WhereIn('role',['employee'])->pluck('username', 'id');
        
        $assignids = Userassign::Where('user_id', $id)->pluck('assign_id', 'id')->toArray();
                
        return view('admin.user.assign', compact('user', 'userlist','assignids'));
    }

    public function assignupdate(Request $request, $id) {
       
        if (!Gate::allows('isAdmin') && !Gate::allows('isManager')) {
            abort(401);
        }

        if (count($request->assign_id) > 0) {
            Userassign::where("user_id", $id)->delete();
            foreach ($request->assign_id as $asid) {
                $data = Userassign::create(['user_id' => $id, 'assign_id' => $asid]);
            }
            Toastr::success('Users assigned successfully!', 'Success');
        } else {
           Toastr::error('Please try again!', 'Error');  
        }

        return redirect()->route('user.assign', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        if (!Gate::allows('isAdmin') && !Gate::allows('isManager')) {
            abort(401);
        }

        Leave::where("employee_id", $id)->delete();
        $user = User::find($id);
        $user->delete();

        Toastr::error('User successfully deleted!', 'Deleted');
        return redirect()->route('user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {

        //$users = User::where('username', 'LIKE', "%{$request->search}%")->paginate();
        if (Gate::allows('isAdmin')){
           $users = User::withCount(['leave', 'leave as approve_leave_count' => function($query) {
                        $query->where('is_approved', true);
                    }])->where('username', 'LIKE', "%{$request->search}%")->paginate(15); 
        }else{
           $users = User::withCount(['leave', 'leave as approve_leave_count' => function($query) {
                        $query->where('is_approved', true);
                    }])->whereIn('id', Request()->session()->get('AssIdsArr'))->where('username', 'LIKE', "%{$request->search}%")->paginate(15);  
        }
        
        
        return view('admin.user.index', compact('users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportall() {

        if (!Gate::allows('isAdmin') && !Gate::allows('isManager')) {
            abort(401);
        }
        $type = 'xlsx';  //xls,csv 
        //$users = User::where('id', '>' ,0)->get();
        //$users = User::all();
        //return Excel::download($users,'users.xlsx');
        return Excel::download(new UsersExport, 'users.' . $type);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changefy(Request $request) {

        $fy_year = $request->fy_year;
        Request()->session()->put('CFY', $fy_year);
        return redirect()->back();
    }

}
