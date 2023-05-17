<?php

namespace App\Http\Controllers;

use Mail;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\User;
use App\Userassign;
use Gate;
use App\Appraisal;
use App\Goal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class AppraisalController extends Controller {
    
    public function __construct() {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
           $this->cfy =  Request()->session()->get('CFY'); 
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        if (!Gate::allows('isAdmin') && !Gate::allows('isManager')) {
            return redirect()->route('dashboard');
        }
        
        if (Gate::allows('isAdmin')){
           $users = User::paginate(20);
        }else{
            $users = User::whereIn('id', Request()->session()->get('AssIdsArr'))->paginate(20);
        }
        
        $appraisalcnt = array();

        foreach ($users as $tmpuser) {
            $totalorgcnt = Appraisal::where('user_id', $tmpuser->id)->whereIn('goal_id', [1, 2, 3, 4, 5])->where('fy', $this->cfy)->count();
            $appraisalcnt[$tmpuser->id]['orgcount'] = $totalorgcnt;
            $totalfuncnt = Appraisal::where('user_id', $tmpuser->id)->whereIn('goal_id', [6, 7, 8, 9, 10])->where('fy', $this->cfy)->count();
            $appraisalcnt[$tmpuser->id]['funcount'] = $totalfuncnt;
        }

        $user = Auth::user();
        return view('admin.appraisal.index', compact('users', 'user', 'appraisalcnt'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
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
        
        $cfy = Request()->session()->get('CFY'); 
        
        if ($request->goal_id > 0) {

            $appraisal = Appraisal::Where('user_id', $uid)->Where('goal_id', $request->goal_id)->where('fy', $this->cfy)->first();
            if ($appraisal === null) {

                $appraisal = new Appraisal();
                $appraisal->goal_id = $request->goal_id;
                $appraisal->user_comment = $request->user_comment;
                $appraisal->user_id = Auth::id();
                $appraisal->fy       = $cfy;
                $appraisal->save();
                
            } else {

                if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
                    $appraisal->manager_comment = $request->manager_comment;
                    $appraisal->rating = $request->rating;
                    $appraisal->status = 2;
                } else {
                    $appraisal->user_comment = $request->user_comment;
                }
                $appraisal->save();
            }
            Toastr::success('', 'Success');
        } else {
            Toastr::error('Please try again!', 'Error');
        }

        $redirect = 'appraisal.create';

        if ($request->goal_id == 1) {
            $redirect = 'appraisal.createorone';
        } elseif ($request->goal_id == 2) {
            if ($request->submit == 'back') {
                $redirect = 'appraisal.create';
            } else {
                $redirect = 'appraisal.createortwo';
            }
        } elseif ($request->goal_id == 3) {
            if ($request->submit == 'back') {
                $redirect = 'appraisal.createorone';
            } else {
                $redirect = 'appraisal.createorthree';
            }
        } elseif ($request->goal_id == 4) {
            if ($request->submit == 'back') {
                $redirect = 'appraisal.createortwo';
            } else {
                $redirect = 'appraisal.createorfour';
            }
        } elseif ($request->goal_id == 5) {
            if ($request->submit == 'back') {
                $redirect = 'appraisal.createorthree';
            } else {
                $redirect = 'appraisal.createfun';
            }
        } else {
            $redirect = 'appraisal.create';
        }

        return redirect()->route($redirect, $queryArr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createpd() {

        if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
            if(request()->uid > 0){
              $uid = request()->uid;  
            }else{
              $uid = Auth::id(); 
            }
        } else {
            $uid = Auth::id();
        }

        $goal = Goal::Where('user_id', $uid)->Where('goal_type', 3)->Where('order_no', 1)->where('fy', $this->cfy)->first();
        $appraisal = Appraisal::Where('user_id', $uid)->Where('goal_id', @$goal->id)->where('fy', $this->cfy)->first();
        
        

        return view('admin.appraisal.createpd', compact('appraisal', 'goal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        
        $queryArr = array();
        if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
            if(request()->uid > 0){
              $uid = request()->uid;  
            }else{
              $uid = Auth::id(); 
            }
            $goalappcombArr = $this->goalorders($uid, 1);
            $queryArr = array('uid' => $uid);
        } else {
            $uid = Auth::id();
            $goalappcombArr = $this->goalorders($uid, 1);
        }

        if (Appraisal::Where('user_id', $uid)->WhereIn('status', [3,4])->where('fy', $this->cfy)->count() >= 10) {
            return redirect()->route('appraisal.finalappsubmit', $queryArr);
        }

        $appraisal = Appraisal::Where('user_id', $uid)->Where('goal_id', 1)->where('fy', $this->cfy)->first();

        $goal = Goal::Where('id', 1)->Where('goal_type', 1)->Where('order_no', 1)->where('fy', $this->cfy)->first();

        $appraisalcnt = Appraisal::Where('user_id', $uid)->Where('status', @$appraisal->status)->where('fy', $this->cfy)->count();

        $fungoalcnt = Goal::where('user_id', $uid)->where('status', 2)->where('fy', $this->cfy)->count();

        return view('admin.appraisal.create', compact('appraisal', 'goal', 'goalappcombArr', 'appraisalcnt', 'fungoalcnt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createorone() {
       if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
            if(request()->uid > 0){
              $uid = request()->uid;  
            }else{
              $uid = Auth::id(); 
            }
        } else {
            $uid = Auth::id();
        }

        $goalappcombArr = $this->goalorders($uid, 1);


        $goal = Goal::Where('goal_type', 1)->Where('order_no', 2)->where('fy', $this->cfy)->first();

        $appraisal = Appraisal::Where('user_id', $uid)->Where('goal_id', 2)->where('fy', $this->cfy)->first();

        $appraisalcnt = Appraisal::Where('user_id', $uid)->Where('status', @$appraisal->status)->where('fy', $this->cfy)->count();

        $fungoalcnt = Goal::where('user_id', $uid)->where('status', 2)->where('fy', $this->cfy)->count();

        return view('admin.appraisal.create', compact('appraisal', 'goalappcombArr', 'goal', 'appraisalcnt', 'fungoalcnt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createortwo() {
        if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
            if(request()->uid > 0){
              $uid = request()->uid;  
            }else{
              $uid = Auth::id(); 
            }
        } else {
            $uid = Auth::id();
        }

        $goalappcombArr = $this->goalorders($uid, 1);

        $goal = Goal::Where('goal_type', 1)->Where('order_no', 3)->where('fy', $this->cfy)->first();

        $fungoalcnt = Goal::where('user_id', $uid)->where('status', 2)->where('fy', $this->cfy)->count();

        $appraisal = Appraisal::Where('user_id', $uid)->Where('goal_id', 3)->where('fy', $this->cfy)->first();

        $appraisalcnt = Appraisal::Where('user_id', $uid)->Where('status', @$appraisal->status)->where('fy', $this->cfy)->count();

        return view('admin.appraisal.create', compact('appraisal', 'goalappcombArr', 'goal', 'appraisalcnt', 'fungoalcnt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createorthree() {
        if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
            if(request()->uid > 0){
              $uid = request()->uid;  
            }else{
              $uid = Auth::id(); 
            }
        } else {
            $uid = Auth::id();
        }

        $goalappcombArr = $this->goalorders($uid, 1);

        $goal = Goal::Where('goal_type', 1)->Where('order_no', 4)->where('fy', $this->cfy)->first();

        $appraisal = Appraisal::Where('user_id', $uid)->Where('goal_id', 4)->where('fy', $this->cfy)->first();

        $appraisalcnt = Appraisal::Where('user_id', $uid)->Where('status', @$appraisal->status)->where('fy', $this->cfy)->count();

        $fungoalcnt = Goal::where('user_id', $uid)->where('status', 2)->where('fy', $this->cfy)->count();

        return view('admin.appraisal.create', compact('appraisal', 'goalappcombArr', 'goal', 'appraisalcnt', 'fungoalcnt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createorfour() {
        if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
            if(request()->uid > 0){
              $uid = request()->uid;  
            }else{
              $uid = Auth::id(); 
            }
        } else {
            $uid = Auth::id();
        }

        $goalappcombArr = $this->goalorders($uid, 1);

        $goal = Goal::Where('goal_type', 1)->Where('order_no', 5)->where('fy', $this->cfy)->first();

        $appraisal = Appraisal::Where('user_id', $uid)->Where('goal_id', 5)->where('fy', $this->cfy)->first();

        $appraisalcnt = Appraisal::Where('user_id', $uid)->Where('status', @$appraisal->status)->where('fy', $this->cfy)->count();

        $fungoalcnt = Goal::where('user_id', $uid)->where('status', 2)->where('fy', $this->cfy)->count();

        return view('admin.appraisal.create', compact('appraisal', 'goalappcombArr', 'goal', 'appraisalcnt', 'fungoalcnt'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storefun(Request $request) {
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
        
        $cfy = Request()->session()->get('CFY'); 
        
        if ($request->goal_id > 0) {

            $appraisal = Appraisal::Where('user_id', $uid)->Where('goal_id', $request->goal_id)->where('fy', $this->cfy)->first();
            if ($appraisal === null) {

                $appraisal = new Appraisal();
                $appraisal->goal_id = $request->goal_id;
                $appraisal->user_comment = $request->user_comment;
                $appraisal->user_id = $uid;
                $appraisal->fy = $cfy;
                $appraisal->save();
                
            } else {

                if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
                    $appraisal->manager_comment = $request->manager_comment;
                    $appraisal->rating = $request->rating;
                    $appraisal->status = 2;
                } else {
                    $appraisal->user_comment = $request->user_comment;
                }
                $appraisal->save();
            }
            Toastr::success('', 'Success');
        } else {
            Toastr::error('Please try again!', 'Error');
        }

        $redirect = 'appraisal.createfun';
        
        if ($request->submit == 'submitpd') {
            $redirect = 'appraisal.createpd';
        } elseif ($request->order_no == 1) {
            if ($request->submit == 'back') {
                $redirect = 'appraisal.createorfour';
            } else {
                $redirect = 'appraisal.createfunone';
            }
        } elseif ($request->order_no == 2) {
            if ($request->submit == 'back') {
                $redirect = 'appraisal.createfun';
            } else {
                $redirect = 'appraisal.createfuntwo';
            }
        } elseif ($request->order_no == 3) {
            if ($request->submit == 'back') {
                $redirect = 'appraisal.createfunone';
            } else {
                $redirect = 'appraisal.createfunthree';
            }
        } elseif ($request->order_no == 4) {
            if ($request->submit == 'back') {
                $redirect = 'appraisal.createfuntwo';
            } else {
                $redirect = 'appraisal.createfunfour';
            }
        } elseif ($request->order_no == 5) {
            if ($request->submit == 'back') {
                $redirect = 'appraisal.createfunthree';
            } else {
                $redirect = 'appraisal.createfunfour';
            }
        } else {
            $redirect = 'appraisal.createfunone';
        }

        return redirect()->route($redirect, $queryArr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createfun() {

        //echo request()->id;
       if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
            if(request()->uid > 0){
              $uid = request()->uid;  
            }else{
              $uid = Auth::id(); 
            }
        } else {
            $uid = Auth::id();
        }

        $goalappcombArr = $this->goalorders($uid, 2);

        $fungoalcnt = Goal::where('user_id', $uid)->where('status', 2)->where('fy', $this->cfy)->count();

        $goal = Goal::Where('user_id', $uid)->Where('goal_type', 2)->Where('order_no', 1)->where('fy', $this->cfy)->first();

        $appraisal = Appraisal::Where('user_id', $uid)->Where('goal_id', @$goal->id)->where('fy', $this->cfy)->first();

        $appraisalcnt = Appraisal::Where('user_id', $uid)->Where('status', @$appraisal->status)->where('fy', $this->cfy)->count();

        return view('admin.appraisal.createfun', compact('appraisal', 'goal', 'fungoalcnt', 'goalappcombArr', 'appraisalcnt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createfunone() {
        if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
            if(request()->uid > 0){
              $uid = request()->uid;  
            }else{
              $uid = Auth::id(); 
            }
        } else {
            $uid = Auth::id();
        }

        $goalappcombArr = $this->goalorders($uid, 2);

        $fungoalcnt = Goal::where('user_id', $uid)->where('status', 2)->where('fy', $this->cfy)->count();

        $goal = Goal::Where('user_id', $uid)->Where('goal_type', 2)->Where('order_no', 2)->where('fy', $this->cfy)->first();

        $appraisal = Appraisal::Where('user_id', $uid)->Where('goal_id', @$goal->id)->where('fy', $this->cfy)->first();

        $appraisalcnt = Appraisal::Where('user_id', $uid)->Where('status', @$appraisal->status)->where('fy', $this->cfy)->count();

        return view('admin.appraisal.createfun', compact('appraisal', 'goal', 'goalappcombArr', 'fungoalcnt', 'appraisalcnt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createfuntwo() {
        if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
            if(request()->uid > 0){
              $uid = request()->uid;  
            }else{
              $uid = Auth::id(); 
            }
        } else {
            $uid = Auth::id();
        }

        $goalappcombArr = $this->goalorders($uid, 2);

        $fungoalcnt = Goal::where('user_id', $uid)->where('status', 2)->where('fy', $this->cfy)->count();

        $goal = Goal::Where('user_id', $uid)->Where('goal_type', 2)->Where('order_no', 3)->where('fy', $this->cfy)->first();

        $appraisal = Appraisal::Where('user_id', $uid)->Where('goal_id', @$goal->id)->where('fy', $this->cfy)->first();

        $appraisalcnt = Appraisal::Where('user_id', $uid)->Where('status', @$appraisal->status)->where('fy', $this->cfy)->count();

        return view('admin.appraisal.createfun', compact('appraisal', 'goal', 'goalappcombArr', 'fungoalcnt', 'appraisalcnt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createfunthree() {
        if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
            if(request()->uid > 0){
              $uid = request()->uid;  
            }else{
              $uid = Auth::id(); 
            }
        } else {
            $uid = Auth::id();
        }

        $goalappcombArr = $this->goalorders($uid, 2);

        $fungoalcnt = Goal::where('user_id', $uid)->where('status', 2)->where('fy', $this->cfy)->count();

        $goal = Goal::Where('user_id', $uid)->Where('goal_type', 2)->Where('order_no', 4)->where('fy', $this->cfy)->first();

        $appraisal = Appraisal::Where('user_id', $uid)->Where('goal_id', @$goal->id)->where('fy', $this->cfy)->first();

        $appraisalcnt = Appraisal::Where('user_id', $uid)->Where('status', @$appraisal->status)->where('fy', $this->cfy)->count();

        return view('admin.appraisal.createfun', compact('appraisal', 'goal', 'goalappcombArr', 'fungoalcnt', 'appraisalcnt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createfunfour() {

        if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
            if(request()->uid > 0){
              $uid = request()->uid;  
            }else{
              $uid = Auth::id(); 
            }
        } else {
            $uid = Auth::id();
        }

        $goalappcombArr = $this->goalorders($uid, 2);

        $fungoalcnt = Goal::where('user_id', $uid)->where('status', 2)->where('fy', $this->cfy)->count();

        $goal = Goal::Where('user_id', $uid)->Where('goal_type', 2)->Where('order_no', 5)->where('fy', $this->cfy)->first();

        $appraisal = Appraisal::Where('user_id', $uid)->Where('goal_id', @$goal->id)->where('fy', $this->cfy)->first();

        $appraisalcnt = Appraisal::Where('user_id', $uid)->Where('status', @$appraisal->status)->where('fy', $this->cfy)->count();

        return view('admin.appraisal.createfun', compact('appraisal', 'goal', 'goalappcombArr', 'fungoalcnt', 'appraisalcnt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function finalappsubmit() 
    {
       if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
            if(request()->uid > 0){
              $uid = request()->uid;  
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

        $sts = 0;
        if (request()->sts > 0) {
            
            $sts = request()->sts;
            Appraisal::where(['user_id' => $uid],['fy', $this->cfy])->update(['status' => $sts]);
            Request()->session()->put('sts', $sts);
                      

            if (request()->sts == 1) {
                
                //submited
                $data['title'] = "Admin";
                $data['name'] = $user['first_name'] . ' ' . $user['last_name'];
                $data['subject'] = "Final Appraisal Evaluation Submitted";
                $data['msg'] = ' has submitted the self appraisal for the FY '.$fy_year.'. Kindly review and take necessary action on Thinknyx Connect portal';
                $data['email'] = $emailsArr;
                Toastr::success('Appraisal successfully submitted!', 'Success');
                
            } elseif (request()->sts == 2) {
                
                //"returned";
                $data['name'] = $user['first_name'] . ' ' . $user['last_name'];
                $data['title'] = "Admin";
                $data['subject'] = "Final Appraisal Evaluation Returned";
                $data['msg'] =  ' has returned the appraisal for the FY '.$fy_year.' . Kindly check details on Thinknyx Connect portal and take necessary action';
                $data['email'] = $emailsArr;
                Toastr::success('Appraisal successfully rejected!', 'Success');
                                
            } elseif (request()->sts == 3) {
                
                //"admin submited"
                $data['name'] = '';
                $data['title'] = $user['first_name'] . ' ' . $user['last_name'];
                $data['subject'] = "Final Appraisal Evaluation Submitted";
                $data['msg'] = ' Your appraisal for the FY '.$fy_year.' has been submitted by your supervisor . Please review and do needfull action on Thinknyx Connect portal';
                $data['email'] = $user['email'];
                Toastr::success('Appraisal successfully submitted!', 'Success');
                                
            } elseif (request()->sts == 4) {
                
                //"accept";
                $data['name'] = $user['first_name'] . ' ' . $user['last_name'];
                $data['title'] = "Admin";
                $data['subject'] = "Final Appraisal Evaluation Accepted";
                $data['msg'] = ' has accept the appraisal for the FY '.$fy_year.'. Kindly check details on Thinknyx Connect portal';
                $data['email'] = $emailsArr;
                Toastr::success('Appraisal successfully accepted!', 'Success');
            }

            Mail::send('admin.emails.newappraisal', $data, function($message) use ($data) {
                $message->to($data['email'], $data['title']);
                $message->subject($data['subject'] . $data['name']);
                //$message->from('connect@thinknyx.com', 'From User');
            });
            
            if (Mail::failures()) {
                Toastr::Fail('Sorry! Please try again latter');
            } else {
                Toastr::success('Great! Email sent successfully');
            }
            
            
            if (Gate::allows('isAdmin')) {
              return redirect()->route('appraisal.finalappsubmit', 'uid=' . $uid);
            } else {
              return redirect()->route('appraisal.finalappsubmit');
            }
            
        }
        
        $appraisals = Appraisal::leftJoin('goals', 'appraisals.goal_id', '=', 'goals.id')
                      ->select('appraisals.*','goals.*','appraisals.status')->where('appraisals.user_id', $uid)->where('appraisals.fy', $this->cfy)->paginate(20);
        
        $appraisalcnt = Appraisal::Where('user_id', $uid)->WhereIn('status', [3, 4])->where('fy', $this->cfy)->count(); 

        $sumRating = Appraisal::where('user_id', $uid)->where('fy', $this->cfy)->groupBy('user_id')->sum('rating');

        $avgRating = ceil($sumRating / 10);

        return view('admin.appraisal.finalappsubmit', compact('appraisals', 'avgRating', 'appraisalcnt','fy_year'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatepdf() {

        if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
            if(request()->uid > 0){
              $uid = request()->uid;  
            }else{
              $uid = Auth::id(); 
            }
        } else {
            $uid = Auth::id();
        }
        $fy_year =  date('n') > 3 ? date('Y').'-'.(date('Y') + 1) : (date('Y') - 1).'-'.date('Y');
        
        $appraisals = Appraisal::leftJoin('goals', 'appraisals.goal_id', '=', 'goals.id')->where('appraisals.user_id', $uid)->where('appraisals.fy', $this->cfy)->paginate(20);
        $appraisalcnt = Appraisal::Where('user_id', $uid)->WhereIn('status', [3, 4])->where('fy', $this->cfy)->count(); 
        
        $sumRating = Appraisal::where('user_id', $uid)->where('fy', $this->cfy)->groupBy('user_id')->sum('rating');
        $avgRating = ceil($sumRating / 10);
                
        $data = ['title' => 'Final Appraisal Summary', 'appraisals' => $appraisals, 'appraisalcnt' => $appraisalcnt,'avgRating' => $avgRating,'fy_year'=>$fy_year];
               
        $pdf = PDF::loadView('admin.appraisal.generatepdf', $data);
         
        return $pdf->download('appraisal.pdf');
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    private function goalorders($uid, $type) {

        $goalappcombArr = array();
        if (Gate::allows('isAdmin')) {

            $goalappcomb = Appraisal::leftJoin('goals', 'appraisals.goal_id', '=', 'goals.id')
                            ->select('goals.goal_type', DB::raw("group_concat(goals.order_no) as order_no"))->Where('appraisals.user_id', $uid)
                            ->Where('goals.goal_type', $type)->Where('appraisals.rating', '>', 0)->where('appraisals.fy', $this->cfy)->groupBy("goal_type")->first();
        } else {

            $goalappcomb = Appraisal::leftJoin('goals', 'appraisals.goal_id', '=', 'goals.id')
                            ->select('goals.goal_type', DB::raw("group_concat(goals.order_no) as order_no"))->Where('appraisals.user_id', $uid)
                            ->Where('goals.goal_type', $type)->where('appraisals.fy', $this->cfy)->groupBy("goal_type")->first();
        }


        if ($goalappcomb) {
            $goalappcombArr = explode(",", $goalappcomb->order_no);
        }

        return $goalappcombArr;
    }

}
