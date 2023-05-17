<?php

namespace App\Http\Controllers;

use App\Download;
use Response;
use Illuminate\Http\Request;
use Gate;

class DownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.download.index');
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
     * @param  \App\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function show(Download $download)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function edit(Download $download)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Download $download)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function destroy(Download $download)
    {
        //
    }
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Download  $download
     * @return \Illuminate\Http\Response
     */
    
    public function holidaylist()
    {
       
        /*$file = 'D:\xampp\htdocs\Employee-management-system-in-laravel\public\uploads\holidaylist\Thinknyx_India_Holiday List_2020.pdf';
        $filename = 'Thinknyx_India_Holiday List_2020.pdf';
        
        return Response::make(file_get_contents($file), 200, [
                       'Content-Type' => 'application/pdf',
                       'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);*/
        
        $holiday_list = "uploads/holidaylist/Thinknyx_India_Holiday List_".date('Y').".pdf";
        if(file_exists(public_path($holiday_list))){
           $fileshowflag = "YES"; 
        }else{
          $fileshowflag = "NO"; 
        }
        return view('admin.download.holidaylist',compact('fileshowflag','holiday_list'));
    }
    
    public function companypolicy()
    {
        $company_policy = "uploads/companypolicy/Thinknyx_Employee Handbook_Leave_Policy_".date('Y')."_v1.pdf";
        if(file_exists(public_path($company_policy))){
           $fileshowflag = "YES"; 
        }else{
           $fileshowflag = "NO"; 
        }
               
        /*$file = 'D:\xampp\htdocs\Employee-management-system-in-laravel\public\uploads\holidaylist\Thinknyx_India_Holiday List_2020.pdf';
        $filename = 'Thinknyx_India_Holiday List_2020.pdf';
        
        return Response::make(file_get_contents($file), 200, [
                       'Content-Type' => 'application/pdf',
                       'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);*/
        return view('admin.download.companypolicy',compact('fileshowflag','company_policy'));
    }
    
    public function orggoalsdoc()
    {
       
        $fy_year =  date('n') > 3 ? date('Y').'-'.(date('Y') + 1) : (date('Y') - 1).'-'.date('Y');
        
        $org_goal = "uploads/orggoals/Organizational_Goals_FY_".$fy_year.".pdf";
        if(file_exists(public_path($org_goal))){
           $fileshowflag = "YES"; 
        }else{
          $fileshowflag = "NO"; 
        }
        return view('admin.download.orggoalsdoc',compact('fileshowflag','fy_year','org_goal'));
    }
    
    public function performance()
    {
        $performance = "uploads/orggoals/Performance_Management_Process_Thinknyx_v1.pdf";
        if(file_exists(public_path($performance))){
           $fileshowflag = "YES"; 
        }else{
          $fileshowflag = "NO"; 
        }
        return view('admin.download.performance',compact('fileshowflag','performance'));
    }
    
    public function userguide()
    {
        $user_guide = "uploads/orggoals/Thinknyx_Connect_User_Guide.pdf";
        if(file_exists(public_path($user_guide))){
           $fileshowflag = "YES"; 
        }else{
          $fileshowflag = "NO"; 
        }
        return view('admin.download.userguide',compact('fileshowflag','user_guide'));
    }
    
    public function adminguide()
    {
        if(!Gate::allows('isAdmin')){
            abort(401);
        }
        $admin_guide = "uploads/orggoals/Thinknyx_Connect_Admin_Guide.pdf";
        if(file_exists(public_path($admin_guide))){
           $fileshowflag = "YES"; 
        }else{
          $fileshowflag = "NO"; 
        }
        return view('admin.download.adminguide',compact('fileshowflag','admin_guide'));
    }
    
    
    
}
