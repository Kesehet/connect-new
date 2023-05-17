<?php

namespace App\Http\Controllers;

use Mail;
use Gate;
use App\User;
use App\Leave;
use App\Totalleave;
use App\Userassign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LeaveRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
           $this->cfy =  Request()->session()->get('CFY'); 
            return $next($request);
        });
    }

    public function index()
    {
        $user = Auth::user();
        if(Auth::user()->role=='admin') {
           $leaves = Leave::where('fy', $this->cfy)->orderBy('created_at', 'DESC')->paginate(20);
           $userlist = User::select(DB::raw("CONCAT(first_name,' ',last_name) AS username"),'id')->pluck('username', 'id');
        }elseif(Auth::user()->role=='manager'){
            
           $UserIds = Request()->session()->get('AssIdsArr'); 
           $UserIds[] = Auth::id();
           $leaves = Leave::where('fy', $this->cfy)->whereIn('employee_id', $UserIds)->orderBy('created_at', 'DESC')->paginate(20);
           $userlist = User::select(DB::raw("CONCAT(first_name,' ',last_name) AS username"),'id')
                       ->whereIn('id', $UserIds)->pluck('username', 'id');
           
        }else{
           $userlist = "";
           $leaves =  Auth::user()->leave()->where('fy', $this->cfy)->orderBy('created_at', 'DESC')->paginate(20);
        }
        
        return view('admin.leave.index',compact('leaves','user','userlist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userid =  Auth::id(); 
        
       //$TotalLeaves =  Totalleave::where('employee_id','=',"{$userid}")->select('totalleaves')->first();
       //$results = Totalleave::where('employee_id','=',"{$userid}")->Where('leaveyear','2020')->toSql();
        
          $fy_yr_cur =  date('n') > 3 ? date('Y').'-'.(date('y') + 1) : (date('Y') - 1).'-'.date('y'); 
        
        if($fy_yr_cur == $this->cfy){
            
          
            $TotalLeavesObj = Totalleave::where('employee_id','=',"{$userid}")->Where('leaveyear',$this->cfy)->first();
            
            if(empty($TotalLeavesObj->totalleaves)){
               $TotalLeaves =  18; 
            }else{
               $TotalLeaves =  $TotalLeavesObj->totalleaves; 
            }
            
            
            $TakenLeaves = Leave::where('employee_id','=',"{$userid}")->Where('is_approved','!=','2')->where('fy', $this->cfy)->groupBy('employee_id')->sum('days');
            $BalanceLeaves = $TotalLeaves - $TakenLeaves;
            
            return view('admin.leave.create', compact('TotalLeaves','BalanceLeaves','TakenLeaves')); 
            
        }else{
          
            return view('admin.leave.noauth');
           
        }
        
       
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeaveRequest $request)
    {
        $cfy = Request()->session()->get('CFY'); 
        $user = Auth::user();
        
        if($request->leave_type == 'work from home'){
          $request->days = 0;  
        }
        
        if($request->hasfile('drfile')){
            $file = $request->file('drfile');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file -> move('uploads/prescription/', $filename);
        }else{
            $filename = '';
        }
        
        Leave::create([
            'employee_id'   => Auth::id(),
            'leave_type'    => $request->leave_type,
            'date_from'     => $request->date_from,
            'date_to'       => $request->date_to,
            'days'          => $request->days,
            'reason'        => $request->reason,
            'fy'            => $cfy,
            'up_file'       => $filename,
        ]);
        
        //---send mail to manager and admin------>
        $mangerEmails =  Userassign::leftJoin('users', 'userassigns.user_id', '=', 'users.id')
                         ->select(DB::raw("group_concat(users.email) as emails"))
                         ->where('userassigns.assign_id', $user['id'])->groupBy("userassigns.assign_id")->first();
        $Emails = $mangerEmails->emails ?? '';
        $emailsArr =  array_filter(explode(",",$Emails.','.config('mail.emailadmin'))); 
        
        $data['title'] = "Admin";
        $data['name'] = $user['first_name'].' '.$user['last_name'];
        $data['msg'] =  'has applied '.$request->days.' '.$request->leave_type.'. Kindly review and take necessary action (approve/reject) on Thinknyx Connect portal';
        $data['email'] = $emailsArr;
        
        Mail::send('admin.emails.newleave', $data, function($message) use ($data){
             $message->to($data['email'], 'Admin');
             $message->subject('New Leave Application from '.$data['name']);
             //$message->from('connect@thinknyx.com', 'From User');
        });
         if (Mail::failures()) {
           Toastr::Fail('Sorry! Please try again latter');
         }else{
           Toastr::success('Great! Email sent successfully');
         }
        
        Toastr::success('Leave successfully requested to HR!','Success');
        
        return redirect()->route('leave');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
           //dd($request->all());
           //$leave = $request ->get('search');
           //$leaves = Leave::where('id', '>',"0")->paginate();
            $where = " id > '0'";
            if($request->leavetype != ""){
               $where .= " AND leave_type LIKE '%{$request->leavetype}%' ";  
             }
             if($request->userid > 0){
               $where .= " AND employee_id = '{$request->userid}' ";   
             }
             if($request->createddate != ""){
                 
               $createdstart = $request->createddate." 00:00:00";  
               $createdend = $request->createddate." 23:59:59";  
               $where .= " AND created_at > '{$createdstart}' AND  created_at < '{$createdend}' ";   
             }
           // $leaves = Leave::whereRaw($where)->where('fy', $this->cfy)->paginate(20);
            
        if(Auth::user()->role=='admin') {
            
           $leaves = Leave::whereRaw($where)->where('fy', $this->cfy)->orderBy('created_at', 'DESC')->paginate(20);
           $userlist = User::pluck('username', 'id');
           
        }elseif(Auth::user()->role=='manager'){
            
           $UserIds = Request()->session()->get('AssIdsArr'); 
           $UserIds[] = Auth::id();
           $leaves = Leave::whereRaw($where)->where('fy', $this->cfy)->whereIn('employee_id', $UserIds)->orderBy('created_at', 'DESC')->paginate(20);
           $userlist = User::whereIn('id', $UserIds)->pluck('username', 'id');
           
        }else{
           $leaves =  Auth::user()->leave()->whereRaw($where)->where('fy', $this->cfy)->orderBy('created_at', 'DESC')->paginate(20);
        }
        
        return view('admin.leave.index',compact('leaves','userlist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
       $userid =  Auth::id(); 
       $TotalLeaves =  Totalleave::where('employee_id','=',"{$userid}")->Where('leaveyear',$this->cfy)->first()->totalleaves;
       $TakenLeaves = Leave::where('employee_id','=',"{$userid}")->Where('is_approved','!=','2')->where('fy', $this->cfy)->groupBy('employee_id')->sum('days');
       $BalanceLeaves = $TotalLeaves - $TakenLeaves;
        
        $leave = Leave::find($id);
        return view('admin.leave.edit',compact('leave','TotalLeaves','BalanceLeaves','TakenLeaves'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->leave_type == 'work from home'){
          $request->days = 0;  
        }
        
        if($request->hasfile('drfile')){
            $file = $request->file('drfile');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file -> move('uploads/prescription/', $filename);
            $leave -> up_file = $filename;
        }else{
            //$filename = '';
        }
                
        $leave = Leave::find($id);
        $leave -> leave_type = $request->leave_type;
        $leave -> date_from = $request->date_from;
        $leave -> date_to = $request->date_to;
        $leave -> days = $request->days;
        $leave -> reason = $request->reason;
        
        $leave -> save();
        Toastr::success('Leave successfully updated!','Success');
        return redirect()->route('leave');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */

    public function approve(Request $request,$id)
    {

         //  dd($request->all());
        $leave = Leave::find($id);
        // dd($leave);
       if($leave){
           
        $leave->is_approved = $request -> approve;
        $leave->manager_comment = $request -> approve_comment;
        $leave->save();
          
        $user=User::find($leave->employee_id);  
        $name = $user['first_name'].' '.$user['last_name'];  
           
        $data['title'] = $name;
        $data['email'] = $user['email'];
        $data['name'] = '';
        
        if($request -> approve == 1){
           $data['msg'] =  'Your '.$leave->days.' '.$leave->leave_type.' is approved. Kindly check details on Thinknyx Connect portal'; 
           Toastr::success('Leave approved successfully!');
        }else{
           $data['msg'] =  'Your '.$leave->days.' '.$leave->leave_type.' is rejected . Kindly check details on Thinknyx Connect portal'; 
           Toastr::success('Leave rejected successfully!');
        }
        
        Mail::send('admin.emails.newleave', $data, function($message) use ($data) {
             $message->to($data['email'], $data['title']);
             $message->subject('New Leave Application from '.$data['title']);
             //$message->from('connect@thinknyx.com', 'From User');
        });
         if (Mail::failures()) {
           Toastr::Fail('Sorry! Please try again latter');
         }else{
           Toastr::success('Great! Email sent successfully');
         }
          
        return redirect()->back();
       }
    }

    public function paid(Request $request,$id)
    {
        $leave = Leave::find($id);
        if($leave){
            $leave->leave_type_offer = $request -> paid;
            $leave->save();
            return redirect()->back();
        }
    }
}
