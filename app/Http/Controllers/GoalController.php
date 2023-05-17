<?php

namespace App\Http\Controllers;

use Mail;
use App\User;
use App\Goal;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\GoalRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Userassign;

class GoalController extends Controller {

    
    public $cfy; 
    
    public function __construct() {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
           $this->cfy =  Request()->session()->get('CFY'); 
            return $next($request);
        });
        
    }

    public function index() {
        

        $user = Auth::user();
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'manager') {

            if(request()->uid > 0){
              $uid = request()->uid;  
            }else{
              $uid = Auth::id(); 
            }
            
            $goals = Goal::where('user_id', $uid)->whereIn('goal_type', [2])->where('fy', $this->cfy)->paginate(20);
            $goalspd = Goal::where('user_id', $uid)->whereIn('goal_type', [3])->where('fy', $this->cfy)->paginate(20);
            $goalcntZero = Goal::where('user_id', $uid)->whereIn('goal_type', [2,3])->whereIn('status', [0, 3])->where('fy', $this->cfy)->count();
            $goalcntThree = Goal::where('user_id', $uid)->where('goal_type', 2)->whereIn('status', [1])->where('fy', $this->cfy)->count();

            $goalcnt = Goal::where('user_id', $uid)->where('goal_type', 2)->where('fy', $this->cfy)->count();
            $goalcntpd = Goal::where('user_id', $uid)->where('goal_type', 3)->where('fy', $this->cfy)->count();
            
        } else {

            $goals = Auth::user()->goal()->whereIn('goal_type', [2])->where('fy', $this->cfy)->paginate(20);
            $goalspd = Auth::user()->goal()->whereIn('goal_type', [3])->where('fy', $this->cfy)->paginate(20);

            $userid = Auth::id();
            $goalcnt = Goal::where('user_id', $userid)->where('goal_type', 2)->where('fy', $this->cfy)->count();
            $goalcntZero = Goal::where('user_id', $userid)->whereIn('goal_type', [2,3])->whereIn('status', [0, 3])->where('fy', $this->cfy)->count(); 
            
            $goalcntThree = 0;
            $goalcntpd = Goal::where('user_id', $userid)->where('goal_type', 3)->where('fy', $this->cfy)->count();
        }
        
        $orgoals = Goal::whereIn('goal_type', [1])->where('fy', $this->cfy)->paginate(20);

        //$user = Auth::user();
        return view('admin.goal.index', compact('goals', 'user', 'goalcnt', 'goalcntpd', 'goalspd', 'goalcntZero', 'goalcntThree','orgoals'));
    }

    public function orgindex() {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        $goals = Goal::whereIn('goal_type', [1])->where('fy', $this->cfy)->paginate(20);
        return view('admin.goal.orgindex', compact('goals'));
    }

    public function storemutiple(Request $request) {

        $queryArr = array();
        if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
            if(request()->uid > 0){
              $uid = request()->uid;  
               $queryArr = array('uid' => $uid);
            }else{
              $uid = Auth::id(); 
            }
        } else {
            $uid = Auth::id();
        }

        $user = User::find($uid);
        $fy_year =  date('n') > 3 ? date('Y').'-'.(date('Y') + 1) : (date('Y') - 1).'-'.date('Y');
        
        //---send mail to manager and admin------>
        $mangerEmails =  Userassign::leftJoin('users', 'userassigns.user_id', '=', 'users.id')
                 ->select(DB::raw("group_concat(users.email) as emails"))
                 ->where('userassigns.assign_id', $user['id'])->groupBy("userassigns.assign_id")->first();
        $Emails = $mangerEmails->emails ?? '';
        $emailsArr =  array_filter(explode(",",$Emails.','.config('mail.emailadmin'))); 
        
        if (request()->submit_x == 'submitted') {
            
            /* foreach($request -> selected as $tmpid){
              $goal = Goal::find($tmpid);
              $goal -> status = 1;
              $goal -> save();
              } */
            Goal::where(['user_id' => $uid], ['goal_type' => 2], ['fy'=>$this->cfy])->update(['status' => 1]);
            Goal::where(['user_id' => $uid], ['goal_type' => 3], ['fy'=>$this->cfy])->update(['status' => 1]);
            
            $data['title'] = "Admin";
            $data['name'] = $user['first_name'] . ' ' . $user['last_name'];
            $data['msg'] = ' has submitted the performance goals for the FY '.$fy_year.'. Kindly review and take necessary action (Approve/Return)';
            $data['email'] = $emailsArr;
            Toastr::success('Goal successfully submitted!', 'Success');
            
        } elseif ($request->submit_x == 'approved') {

            Goal::where(['user_id' => $uid], ['goal_type' => 2],['fy'=>$this->cfy])->update(['status' => 2]);
            Goal::where(['user_id' => $uid], ['goal_type' => 3],['fy'=>$this->cfy])->update(['status' => 2]);

            $data['name'] = '';
            $data['title'] = $user['first_name'] . ' ' . $user['last_name'];
            $data['msg'] = 'Your performance goals for the FY '.$fy_year.' has been approved by your supervisor. Kindly check details on Thinknyx Connect portal';
            $data['email'] = $user['email'];
            Toastr::success('Goal successfully approved!', 'Success');
            
        } elseif ($request->submit_x == 'returned') {

            Goal::where(['user_id' => $uid], ['goal_type' => 2],['fy'=>$this->cfy])->update(['status' => 3]);
            Goal::where(['user_id' => $uid], ['goal_type' => 3],['fy'=>$this->cfy])->update(['status' => 3]);

            $data['name'] = '';
            $data['title'] = $user['first_name'] . ' ' . $user['last_name'];
            $data['msg'] = 'Your performance goals for the FY '.$fy_year.' has been returned by your supervisor. Kindly check details on Thinknyx Connect portal';
            $data['email'] = $user['email'];
            Toastr::success('Goal successfully returned!', 'Success');
        }

        Mail::send('admin.emails.newgoal', $data, function($message) use ($data) {
            $message->to($data['email'], $data['title']);
            $message->subject('New Goals Application ' . $data['name']);
            //$message->from('connect@thinknyx.com', 'From User');
        });
        if (Mail::failures()) {
            Toastr::Fail('Sorry! Please try again latter');
        } else {
            Toastr::success('Great! Email sent successfully');
        }

         return redirect()->route('goal', $queryArr);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $userid = Auth::id();
        
        $fy_yr_cur =  date('n') > 3 ? date('Y').'-'.(date('y') + 1) : (date('Y') - 1).'-'.date('y');
        if($fy_yr_cur == $this->cfy){
            
        $goalcnt = Goal::where('user_id', $userid)->where('goal_type', 2)->where('fy', $this->cfy)->count();
        $goalcnt = $goalcnt + 1;

        return view('admin.goal.create', compact('goalcnt'));
        
        }else{
            return view('admin.leave.noauth'); 
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createpd() {

        $userid = Auth::id();

        $goalcnt = Goal::where('user_id', $userid)->where('goal_type', 3)->where('fy', $this->cfy)->count();
        $goalcnt = $goalcnt + 1;

        return view('admin.goal.createpd', compact('goalcnt'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GoalRequest $request) {

        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        
        $cfy = Request()->session()->get('CFY'); 
        
        $goal = new Goal();
        $goal->user_id = Auth::id();
        $goal->goal_type = 2;
        $goal->title = $request->title;
        $goal->description = $request->description;
        $goal->order_no = $request->order_no;
        $goal->fy       = $cfy;
        $goal->save();

        Toastr::success('Goal successfully added!', 'Success');
        //return redirect()->back();
        return redirect()->route('goal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storepd(GoalRequest $request) {

        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        
        $cfy = Request()->session()->get('CFY'); 
        $goal = new Goal();
        $goal->user_id = Auth::id();
        $goal->goal_type = 3;
        $goal->title = $request->title;
        $goal->description = $request->description;
        $goal->fy       = $cfy;
        $goal->order_no = $request->order_no;
        $goal->save();

        Toastr::success('Goal successfully added!', 'Success');
        //return redirect()->back();
        return redirect()->route('goal');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Goal  $leave
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
//        dd($request->all());
        // $leave = $request -> get('search');
        $leaves = Goal::where('leave_type', 'LIKE', "%{$request->search}%")->paginate();
        return view('admin.goal.index', compact('leaves'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Goal  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $goal = Goal::find($id);
        return view('admin.goal.edit', compact('goal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Goal  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $goal = Goal::find($id);
        $goal->title = $request->title;
        $goal->description = $request->description;
        $goal->save();

        Toastr::success('Goal successfully added!', 'Success');

        if ($goal->goal_type == 1) {
            return redirect()->route('goal.orgindex');
        } else {
            return redirect()->route('goal');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Goal  $leave
     * @return \Illuminate\Http\Response
     */
    public function view($id) {
        $goal = Goal::find($id);
        return view('admin.goal.view', compact('goal'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Goal  $leave
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        /* if(!Gate::allows('isAdmin')){
          abort(401);
          } */
        $goal = Goal::find($id);
        $goal->delete();

        //Goaldetail::where("goal_id", $id)->delete();

        Toastr::error('Goal successfully deleted!', 'Deleted');
        return redirect()->route('goal');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userlist() {
        
        if (!Gate::allows('isAdmin') && !Gate::allows('isManager')) {
            abort(401);
        }
          
        if (Gate::allows('isAdmin')){
           $users = User::paginate(20);
        }else{
            $users = User::whereIn('id', Request()->session()->get('AssIdsArr'))->paginate(20);
        }
        
        $appraisalcnt = array();

        foreach ($users as $tmpuser) {
            $totalorgcnt = Goal::where('user_id', $tmpuser->id)->whereIn('goal_type', [2])->whereIn('status', [1, 2])->where('fy', $this->cfy)->count();
            $appraisalcnt[$tmpuser->id]['orgcount'] = $totalorgcnt;
            $totalfuncnt = Goal::where('user_id', $tmpuser->id)->whereIn('goal_type', [3])->where('status', 0)->where('fy', $this->cfy)->count();
            $appraisalcnt[$tmpuser->id]['funcount'] = $totalfuncnt;
        }

        $user = Auth::user();
        return view('admin.goal.userlist', compact('users', 'user', 'appraisalcnt'));
    }

}
