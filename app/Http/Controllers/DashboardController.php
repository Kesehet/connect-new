<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Timesheet;
use App\Timesheetdetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('dob','>',date('Y-m-01'))->where('dob','<',date('Y-m-31'))->paginate(5);
        
        $user = Auth::user();
        
        $timesheets = Timesheet::where('timesheets.user_id', Auth::id())
                    ->leftJoin('users', 'timesheets.user_id', '=', 'users.id')
                    ->leftJoin('timesheetdetails', 'timesheets.id', '=', 'timesheetdetails.timesheet_id')
                    ->select('timesheets.*','users.first_name','users.last_name', DB::raw("SUM(timesheetdetails.working_mintus) as totalmins"))
                    ->groupBy("timesheets.id")->orderBy('timesheets.created_at', 'DESC')->paginate(7);
        
        return view('admin.dashboard.index',compact('users','user','timesheets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
             
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
