<?php

namespace App\Http\Controllers;

use Gate;
use Brian2694\Toastr\Facades\Toastr;
use App\Employee;
use App\Profile;
use App\User;
use App\Userlog;
use App\Userdetail;
use App\Fyear;
use App\Totalleave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
//        $details = DB::table('users')
//            ->select('dob', 'gender', 'phone','email','join_date','address')
//            ->get();
        $user = Auth::user();
        $userdetail =  Userdetail::Where('user_id', Auth::id())->first();
//        dd($users->username);
        return view('admin.profile.index',compact('user','userdetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        return view('admin.profile.changepw');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function updatePassword(Request $request)
    {
        $userid =  Auth::id(); 
        $request -> validate([
                'current_password' => 'required',
                'new_password' => 'required',
                'confirm_password' => 'required',
        ]);
        //$pass = $request->all();
        
        $current_password = $request->current_password;
        $check_password = User::where(['id'=>$userid])->first();
        
        if(Hash::check($current_password,$check_password->password)){
            
            if(Hash::check($request->new_password,bcrypt($request->confirm_password))){
              
                $user = User::find($userid);
                $user->password = bcrypt($request->new_password);
                //dd($user); die;
                $user->save();
                Toastr::info('Password Changed successfully!!','Info'); 
                return redirect()->route('change.password');
        
            }else{
              Toastr::warning('New Password and Confirm Password does not Match!!','Warning');
              return redirect()->route('change.password'); 
            }
        }else{
            Toastr::warning('Current Password is Wrong!!','Warning');
            return redirect()->route('change.password');
        }
        //  return view('admin.profile.changepw');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addfy()
    {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        return view('admin.profile.addfy');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function updatefy(Request $request)
    {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        $fy =  Fyear::Where('year', $request -> curr_fy)->first();
        if($fy === null){
            
            $data =  Fyear::create(['year' => $request -> curr_fy]); 
            //$id =  $data->id;
            
           $totalleaves =  Totalleave::where('employee_id','>','0')->get();
           
           foreach($totalleaves as $totalleave){
            Totalleave::create(['employee_id' => $totalleave->employee_id, 'leaveyear' => $request -> curr_fy, 'totalleaves' => 18]);
           }
           Toastr::success('FY year successfully added!','Success');
           
        }else{
          Toastr::info('FY year already added!','Info');
        }
        return redirect()->route('profile.addfy');
    }
    
    
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function attendancelog(Request $request)
    {
        
        if(Auth::user()->role=='admin') {
            $userlogs = Userlog::where('userlogs.id', '>', "0")->leftJoin('users', 'userlogs.userid', '=', 'users.id')
                    ->select('userlogs.*', 'users.first_name','users.last_name')->orderBy('userlogs.created_at', 'DESC')->paginate(15);
        }else{
            $userid =  Auth::id();
            $userlogs = Userlog::where('userid', '=', "{$userid}")->orderBy('created_at', 'DESC')->paginate(15);
        }
         
        return view('admin.profile.attendancelog',compact('userlogs'));
        
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
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
       $user = Auth::user();
       // dd($users->username);
        return view('admin.profile.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        $userid =  Auth::id(); 
        $user = User::find($userid);
        
        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file -> move('uploads/gallery/', $filename);
            $user->image = $filename;
        }
        
        $user -> first_name = $request -> fname;
        $user -> last_name = $request -> lname;
        $user -> gender = $request -> gender;
        $user -> join_date = $request -> join_date;
        $user -> job_type = $request -> job_type;
        $user -> tenure = $request -> tenure;
        $user -> department = $request -> department;
        $user -> city = $request -> city;
        
        $user -> save();
        Toastr::success('Employee successfully updated!','Success');
        return redirect()->route('profile.edit');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function personal()
    {
        $user = Auth::user();
        return view('admin.profile.personal',compact('user'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function updatepersonal(Request $request)
    {
        
        $userid =  Auth::id(); 
        $user = User::find($userid);
        
        $user -> skills = $request -> skills;
        $user -> phone = $request -> phone;
        $user -> dob = $request -> dob;
        $user -> email = $request -> email;
        $user -> age = $request -> age;
        $user -> address = $request -> address;
        $user -> current_address = $request -> current_address;
        $user -> pre_org = $request -> pre_org;
        $user -> exp_bfjoin = $request -> exp_bfjoin;
        $user -> emr_contact_no = $request -> emr_contact_no;
        $user -> emr_contact_name = $request -> emr_contact_name;
        $user -> rel_emr_contact = $request -> rel_emr_contact;
        $user -> email_personal = $request -> email_personal;
        $user -> mrtl_status = $request -> mrtl_status;
        $user -> spous_name = $request -> spous_name;
        $user -> blood_group = $request -> blood_group;
        $user -> father_name = $request -> father_name;
        
        $user -> save();
        Toastr::success('Employee successfully updated!','Success');
        return redirect()->route('profile.personal');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function education()
    {
        $user = Auth::user();
        $userdetail =  Userdetail::Where('user_id', Auth::id())->first();
        return view('admin.profile.education',compact('userdetail','user'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function updateducation(Request $request)
    {
        
        $userdetail =  Userdetail::Where('user_id', Auth::id())->first();
        if($userdetail === null){
            
            $data =  Userdetail::create([
               'user_id'           => Auth::id(),
               'certification'    => $request -> certification,
               'grd_diploma'    => $request -> grd_diploma,
               'uni_grd'    => $request -> uni_grd,
               'inst_grd'    => $request -> inst_grd,
               'year_pass_grd'    => $request -> year_pass_grd,
               'uni_pg'    => $request -> uni_pg,
               'inst_pg'    => $request -> inst_pg,
               'year_pass_pg'    => $request -> year_pass_pg,
               'post_grd'    => $request -> post_grd,
             ]); 
            //$id =  $data->id;
            
        }else{
          
          //$id =  $userdetail->id;
          $userdetail -> certification = $request -> certification;
          $userdetail -> grd_diploma = $request -> grd_diploma;
          $userdetail -> uni_grd = $request -> uni_grd;
          $userdetail -> inst_grd = $request -> inst_grd;
          $userdetail -> year_pass_grd = $request -> year_pass_grd;
          $userdetail -> uni_pg = $request -> uni_pg;
          $userdetail -> inst_pg = $request -> inst_pg;
          $userdetail -> year_pass_pg = $request -> year_pass_pg;
          $userdetail -> post_grd = $request -> post_grd;
          
          $userdetail -> save();
            
        }
        
        Toastr::success('Employee successfully updated!','Success');
        return redirect()->route('profile.education');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function important()
    {
        //$user = Auth::user();
       $userdetail =  Userdetail::Where('user_id', Auth::id())->first();
       
       $userdetail->pancard = base64_decode($userdetail->pancard);  
       $userdetail->uanumber = base64_decode($userdetail->uanumber);  
       $userdetail->aadharcard = base64_decode($userdetail->aadharcard);  
       $userdetail->bknumber = base64_decode($userdetail->bknumber);  
       $userdetail->bkname = base64_decode($userdetail->bkname);  
       $userdetail->ifscode = base64_decode($userdetail->ifscode);  
       
        
        return view('admin.profile.important',compact('userdetail'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function updateimportant(Request $request)
    {
        //$userid =  Auth::id();
        $userdetail =  Userdetail::Where('user_id', Auth::id())->first();
        
        if($userdetail === null){
            
            $data =   Userdetail::create([
               'user_id'    => Auth::id(),
               'pancard'    => base64_encode($request -> pancard),
               'uanumber'    => base64_encode($request -> uanumber),
               'aadharcard'    => base64_encode($request -> aadharcard),
               'bknumber'    => base64_encode($request -> bknumber),
               'bkname'    => base64_encode($request -> bkname),
               'ifscode'    => base64_encode($request -> ifscode),
             ]); 
            //$id =  $data->id;
            
        }else{
          
          //$id =  $userdetail->id;
          $userdetail -> pancard = base64_encode($request -> pancard);
          $userdetail -> uanumber = base64_encode($request -> uanumber);
          $userdetail -> aadharcard = base64_encode($request -> aadharcard);
          $userdetail -> bknumber = base64_encode($request -> bknumber);
          $userdetail -> bkname = base64_encode($request -> bkname);
          $userdetail -> ifscode = base64_encode($request -> ifscode);
          $userdetail -> save();
            
        }
        
        Toastr::success('Employee successfully updated!','Success');
        return redirect()->route('profile.important');
    }
    
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function exitdetails()
    {
        $user = Auth::user();
        return view('admin.profile.exitdetails',compact('user'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function updatexit(Request $request)
    {
        $userid =  Auth::id(); 
        $user = User::find($userid);
        
        $user -> last_working = $request -> last_working;
        $user -> reason_exit = $request -> reason_exit;
                
        $user -> save();
        Toastr::success('Employee successfully updated!','Success');
        return redirect()->route('profile.exitdetails');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
    
    function my_simple_crypt( $string, $action = 'e' ) {
        // you may change these values to your own
        $secret_key = 'my_simple_secret_key';
        $secret_iv = 'my_simple_secret_iv';

        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

        if( $action == 'e' ) {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }

        return $output;
   }
    
    
    
}
