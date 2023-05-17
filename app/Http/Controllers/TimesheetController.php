<?php

namespace App\Http\Controllers;

use Mail;
use Gate;
use App\User;
use App\Timesheet;
use App\Timesheetdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TimesheetRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class TimesheetController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->cfy = Request()->session()->get('CFY');
            return $next($request);
        });
    }

    public function index() {
        $user = Auth::user();
        if (Auth::user()->role == 'admin') {
            //$timesheets = Timesheet::paginate(20);
            $timesheets = Timesheet::leftJoin('users', 'timesheets.user_id', '=', 'users.id')
                            ->leftJoin('timesheetdetails', 'timesheets.id', '=', 'timesheetdetails.timesheet_id')
                            ->select('timesheets.*', 'users.first_name', 'users.last_name', DB::raw("SUM(timesheetdetails.working_mintus) as totalmins"))
                            ->where('timesheets.fy', $this->cfy)->groupBy("timesheets.id")->orderBy('timesheets.created_at', 'DESC')->paginate(20);
            $userlist = User::select(DB::raw("CONCAT(first_name,' ',last_name) AS username"),'id')->pluck('username', 'id');
        } elseif (Auth::user()->role == 'employee') {

            //$timesheets =  Auth::user()->timesheet()->paginate(20);
            $timesheets = Timesheet::where('timesheets.user_id', Auth::id())->leftJoin('users', 'timesheets.user_id', '=', 'users.id')
                            ->leftJoin('timesheetdetails', 'timesheets.id', '=', 'timesheetdetails.timesheet_id')
                            ->select('timesheets.*', 'users.first_name', 'users.last_name', DB::raw("SUM(timesheetdetails.working_mintus) as totalmins"))
                            ->where('timesheets.fy', $this->cfy)->groupBy("timesheets.id")->orderBy('timesheets.created_at', 'DESC')->paginate(20);
            $userlist = "";
            
        } else {

            $UserIds = Request()->session()->get('AssIdsArr');
            $UserIds[] = Auth::id();
            $timesheets = Timesheet::whereIn('timesheets.user_id', $UserIds)->leftJoin('users', 'timesheets.user_id', '=', 'users.id')
                            ->leftJoin('timesheetdetails', 'timesheets.id', '=', 'timesheetdetails.timesheet_id')
                            ->select('timesheets.*', 'users.first_name', 'users.last_name', DB::raw("SUM(timesheetdetails.working_mintus) as totalmins"))
                            ->where('timesheets.fy', $this->cfy)->groupBy("timesheets.id")->orderBy('timesheets.created_at', 'DESC')->paginate(20);
            $userlist = User::select(DB::raw("CONCAT(first_name,' ',last_name) AS username"),'id')->whereIn('id', $UserIds)->pluck('username', 'id');
        }
        

        //$user = Auth::user();
        return view('admin.timesheet.index', compact('timesheets', 'user', 'userlist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $userid = Auth::id();
        $fy_yr_cur = date('n') > 3 ? date('Y') . '-' . (date('y') + 1) : (date('Y') - 1) . '-' . date('y');
        if ($fy_yr_cur == $this->cfy) {

            //$TotalTimesheets =  TotalTimesheet::where('employee_id','=',"{$userid}")->select('totalleaves')->first();
            //$results = TotalTimesheet::where('employee_id','=',"{$userid}")->Where('leaveyear','2020')->toSql();
            //$TotalTimesheets =  TotalTimesheet::where('employee_id','=',"{$userid}")->Where('leaveyear','2020')->first()->totalleaves;
            //$TakenTimesheets = Timesheet::where('employee_id','=',"{$userid}")->Where('is_approved','1')->groupBy('employee_id')->sum('days');
            //$BalanceTimesheets = $TotalTimesheets - $TakenTimesheets;

            $userlist = User::pluck('username', 'id');

            return view('admin.timesheet.create', compact('userlist'));
        } else {

            return view('admin.leave.noauth');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TimesheetRequest $request) {

        if (Gate::allows('isAdmin')) {
            $uid = $request->userid;
        } else {
            $uid = Auth::id();
        }

        $cfy = Request()->session()->get('CFY');

        $timesheet = Timesheet::where('timesheet_date', '=', "{$request->timesheet_date}")->Where('user_id', $uid)->first();

        if ($timesheet === null) {
            $data = Timesheet::create([
                        'user_id' => $uid,
                        'timesheet_date' => $request->timesheet_date,
                        'fy' => $cfy,
            ]);
            $timesheet_id = $data->id;
        } else {
            $timesheet_id = $timesheet->id;
        }

        for ($i = 0; $i < count($request->comments); $i++) {
            if ($request->comments[$i] != "" && ($request->hours[$i] > 0 || $request->mintus[$i] > 0)) {

                $total_min = ($request->hours[$i] * 60) + $request->mintus[$i];
                Timesheetdetail::create([
                    'timesheet_id' => $timesheet_id,
                    'working_mintus' => $total_min,
                    'comments' => $request->comments[$i],
                ]);
            }
        }

        Toastr::success('Timesheet successfully submitted!', 'Success');
        return redirect()->route('timesheet');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Timesheet  $leave
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {

        $where = " timesheets.id > '0'";
        if ($request->userid > 0) {
            $where .= " AND timesheets.user_id = '{$request->userid}' ";
        }
        if ($request->createddate != "") {

            $createdstart = $request->createddate;
            $createdend = $request->createddate;
            $where .= " AND timesheets.timesheet_date = '{$createdstart}'";
        }
        //$timesheets = Timesheet::whereRaw($where)->paginate(20); 
        if (Auth::user()->role == 'admin') {
            $timesheets = Timesheet::leftJoin('users', 'timesheets.user_id', '=', 'users.id')
                            ->leftJoin('timesheetdetails', 'timesheets.id', '=', 'timesheetdetails.timesheet_id')
                            ->select('timesheets.*', 'users.first_name', 'users.last_name', DB::raw("SUM(timesheetdetails.working_mintus) as totalmins"))
                            ->where('timesheets.fy', $this->cfy)->whereRaw($where)->groupBy("timesheets.id")->orderBy('timesheets.created_at', 'DESC')->paginate(20);
            $userlist = User::pluck('username', 'id');
            
        } elseif (Auth::user()->role == 'employee') {

            //$timesheets =  Auth::user()->timesheet()->paginate(20);
            $timesheets = Timesheet::where('timesheets.user_id', Auth::id())->leftJoin('users', 'timesheets.user_id', '=', 'users.id')
                            ->leftJoin('timesheetdetails', 'timesheets.id', '=', 'timesheetdetails.timesheet_id')
                            ->select('timesheets.*', 'users.first_name', 'users.last_name', DB::raw("SUM(timesheetdetails.working_mintus) as totalmins"))
                            ->where('timesheets.fy', $this->cfy)->whereRaw($where)->groupBy("timesheets.id")->orderBy('timesheets.created_at', 'DESC')->paginate(20);
        } else {

            $UserIds = Request()->session()->get('AssIdsArr');
            $UserIds[] = Auth::id();
            $timesheets = Timesheet::whereIn('timesheets.user_id', $UserIds)->leftJoin('users', 'timesheets.user_id', '=', 'users.id')
                            ->leftJoin('timesheetdetails', 'timesheets.id', '=', 'timesheetdetails.timesheet_id')
                            ->select('timesheets.*', 'users.first_name', 'users.last_name', DB::raw("SUM(timesheetdetails.working_mintus) as totalmins"))
                            ->where('timesheets.fy', $this->cfy)->whereRaw($where)->groupBy("timesheets.id")->orderBy('timesheets.created_at', 'DESC')->paginate(20);
            $userlist = User::whereIn('id', $UserIds)->pluck('username', 'id');
        }

        
        return view('admin.timesheet.index', compact('timesheets', 'userlist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timesheet  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Timesheet $leave) {
        //
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timesheet $timesheet) {
        // Validate the request data
        $request->validate([
            'timesheet_date' => 'required|date',
            'comments.*' => 'required|string',
            'hours.*' => 'required|integer|min:0',
            'mintus.*' => 'required|integer|min:0|max:59',
        ]);

        // Update the timesheet date
        $timesheet->timesheet_date = $request->timesheet_date;
        $timesheet->save();

        // Delete the existing timesheet details
        Timesheetdetail::where('timesheet_id', $timesheet->id)->delete();

        // Add the updated timesheet details
        for ($i = 0; $i < count($request->comments); $i++) {
            if ($request->comments[$i] != "" && ($request->hours[$i] > 0 || $request->mintus[$i] > 0)) {
                $total_min = ($request->hours[$i] * 60) + $request->mintus[$i];
                Timesheetdetail::create([
                    'timesheet_id' => $timesheet->id,
                    'working_mintus' => $total_min,
                    'comments' => $request->comments[$i],
                ]);
            }
        }

        Toastr::success('Timesheet successfully updated!', 'Success');
        return redirect()->route('timesheet');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timesheet  $leave
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        /* if(!Gate::allows('isAdmin')){
          abort(401);
          } */
        $timesheet = Timesheet::find($id);
        $timesheet->delete();
        Timesheetdetail::where("timesheet_id", $id)->delete();

        Toastr::error('Timesheet successfully deleted!', 'Deleted');
        return redirect()->route('timesheet');
    }

    public function ajaxindex($id) {
        /* if(!Gate::allows('isAdmin')){
          abort(401);
          } */
        $timesheetdetails = Timesheetdetail::where('timesheet_id', '=', $id)->paginate(20);
        return view('admin.timesheet.ajaxindex', compact('timesheetdetails'));
    }

    public function ajaxdelete($id) {
        
        $timesheetdetail = Timesheetdetail::find($id);
        if ($timesheetdetail->delete()) {
            return $id;
        } else {
            return false;
        }
    }

}
