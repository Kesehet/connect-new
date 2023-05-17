@extends('admin.layout.master')

@section('content')

<div id="main-wrapper">
    @include('admin.includes.sidebar')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <!--<h4 class="page-title">My profile</h4>-->
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('profile')}}">Profile</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 d-flex no-block align-items-center">
            <div class="bs-example" style="width: 98%">

                <div class="tab-content">

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#home" class="nav-link active" data-toggle="tab">Basic Details</a>
                        </li>
                        <li class="nav-item">
                            <a href="#profile" class="nav-link " data-toggle="tab">Personal Details</a>
                        </li>
                        <li class="nav-item">
                            <a href="#messages" class="nav-link" data-toggle="tab">Educational Details</a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="#important" class="nav-link" data-toggle="tab">Important Details</a>
                        </li>
                        @can('isAdmin')
                        <li class="nav-item">
                            <a href="#exit" class="nav-link" data-toggle="tab">Exit Details</a>
                        </li>
                        @endcan
                    </ul>

                    <div class="tab-pane fade show active" id="home">

                        <div class="card" style="margin-top: 0px;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="box box-success">
                                            <div class="panel">

                                                <!--<div class="panel-heading">
                                                    <span class="panel-title">Personal Details</span>
                                                </div>-->

                                                <div class="panel-body pn pb5">
                                                    <!--<hr class="short br-lighter">-->

                                                    <div class="box-body no-padding">

                                                        <table class="table">
                                                            <tbody>
                                                                {{--@foreach($users as $user)--}}

                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i>
                                                                    </td>
                                                                    <td><strong>Employee ID</strong></td>
                                                                    <td>{{$user->emp_id}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i>
                                                                    </td>
                                                                    <td><strong>First name</strong></td>
                                                                    <td class="capitalize">{{$user->first_name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i>
                                                                    </td>
                                                                    <td><strong>Last name</strong></td>
                                                                    <td class="capitalize">{{$user->last_name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-mobile-alt"></i>
                                                                    </td>
                                                                    <td><strong>Phone number</strong></td>
                                                                    <td>{{$user->phone}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i>
                                                                    </td>
                                                                    <td><strong>Designation</strong></td>
                                                                    <td class="capitalize">{{$user->designation}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i>
                                                                    </td>
                                                                    <td><strong>Gender</strong></td>
                                                                    <td class="capitalize">{{$user->gender}}</td>
                                                                </tr>
                                                                
                                                                {{--@endforeach--}}
                                                            </tbody>
                                                        </table>
                                                        {{--{{ $users->links() }}--}}

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="box box-success">
                                        <div class="panel">

                                            <!--<div class="panel-heading">
                                                <span class="panel-title">Bank Details</span>
                                            </div>-->
                                            <div class="panel-body pn pb5">
                                                <!--<hr class="short br-lighter">-->

                                                <div class="box-body no-padding">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 10px" class="text-center"><i class="fa fa-credit-card"></i></td>
                                                                <td><strong>Office</strong></td>
                                                                <td class="capitalize">{{$user->city}}</td>

                                                            </tr>
                                                            <tr>
                                                                <td style="width: 10px" class="text-center"><i class="fa fa-credit-card"></i></td>
                                                                <td><strong>Manager</strong></td>
                                                                <td class="capitalize">{{$user->manager}}</td>
                                                            </tr>
                                                            <tr>

                                                                <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i></td>
                                                                <td><strong>Department</strong></td>
                                                                <td class="capitalize">{{$user->department}}</td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td style="width: 10px" class="text-center"><i class="fa fa-calendar-times"></i>
                                                                </td>
                                                                <td><strong>Join date</strong></td>
                                                                <td><span id='join_date' style="display: none;">{{$user->join_date}}</span>{{ \Carbon\Carbon::parse($user->join_date)->format('d-m-Y') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 10px" class="text-center"><i class="fa fa-universal-access"></i></td>
                                                                <td><strong>Thinknyx Tenure (Years)</strong></td>
                                                                <td><span id='tenure'>{{$user->tenure}}</span></td>
                                                            </tr>
                                                                                                                        
                                                            <tr>
                                                                <td style="width: 10px" class="text-center"><i class="fa fa-code"></i>
                                                                </td>
                                                                <td><strong>Job type (Status)</strong></td>
                                                                <td class="capitalize">{{$user->job_type}}</td>
                                                            </tr>

                                                            <!--<tr>
                                                                <td style="width: 10px" class="text-center"><i class="fa fa-accessible-icon"></i></td>
                                                                <td><strong>Bank Branch</strong></td>
                                                                <td>{{$user->city}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 10px" class="text-center"><i class="fa fa-code"></i></td>
                                                                <td><strong>Ifsc Code</strong></td>
                                                                <td>{{$user->city}}</td>
                                                            </tr>-->
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="profile">
                        
                        <div class="card" style="margin-top: 0px;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="box box-success">
                                            <div class="panel">

                                                <!--<div class="panel-heading">
                                                    <span class="panel-title">Personal Details</span>
                                                </div>-->

                                                <div class="panel-body pn pb5">
                                                    <!--<hr class="short br-lighter">-->

                                                    <div class="box-body no-padding">

                                                        <table class="table">
                                                            <tbody>
                                                               

                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i>
                                                                    </td>
                                                                    <td><strong>Skills</strong></td>
                                                                    <td>{{$user->skills}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-mobile-alt"></i>
                                                                    </td>
                                                                    <td><strong>Phone number</strong></td>
                                                                    <td>{{$user->phone}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-birthday-cake"></i>
                                                                    </td>
                                                                    <td><strong>Date of birth</strong></td>
                                                                    <td>{{$user->dob}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i>
                                                                    </td>
                                                                    <td><strong>Email</strong></td>
                                                                    <td>{{$user->email}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i>
                                                                    </td>
                                                                    <td><strong>Age (Years)</strong></td>
                                                                    <td>{{$user->age}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i>
                                                                    </td>
                                                                    <td><strong>Permanent Address</strong></td>
                                                                    <td>{{$user->address}}</td>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-code"></i></td>
                                                                    <td><strong>Spouse Name</strong></td>
                                                                    <td class="capitalize">{{$user->spous_name}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-code"></i></td>
                                                                    <td><strong>Blood Group</strong></td>
                                                                    <td>{{$user->blood_group}}</td>
                                                                </tr>
                                                                
                                                            </tbody>
                                                        </table>
                                                        
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="box box-success">
                                        <div class="panel">

                                            <!--<div class="panel-heading">
                                                <span class="panel-title">Bank Details</span>
                                            </div>-->
                                            <div class="panel-body pn pb5">
                                                <!--<hr class="short br-lighter">-->

                                                <div class="box-body no-padding">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 10px" class="text-center"><i class="fa fa-credit-card"></i></td>
                                                                <td><strong>Current Address</strong></td>
                                                                <td>{{$user->current_address}}</td>

                                                            </tr>
                                                            <tr>
                                                                <td style="width: 10px" class="text-center"><i class="fa fa-credit-card"></i></td>
                                                                <td><strong>Previous Org</strong></td>
                                                                <td class="capitalize">{{$user->pre_org}}</td>
                                                            </tr>
                                                            <tr>

                                                                <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i></td>
                                                                <td><strong>Total Experience (yrs.) before joining</strong></td>
                                                                <td>{{$user->exp_bfjoin}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 10px" class="text-center"><i class="fa fa-universal-access"></i></td>
                                                                <td><strong>Emergency Contact Number</strong></td>
                                                                <td>{{$user->emr_contact_no}}</td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td style="width: 10px" class="text-center"><i class="fa fa-calendar-times"></i>
                                                                </td>
                                                                <td><strong>Emergency Contact Name</strong></td>
                                                                <td>{{$user->emr_contact_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 10px" class="text-center"><i class="fa fa-code"></i>
                                                                </td>
                                                                <td><strong>Relationship with emergency contact</strong></td>
                                                                <td class="capitalize">{{$user->rel_emr_contact}}</td>
                                                            </tr>

                                                            <tr>
                                                                <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i></td>
                                                                <td><strong>Personal Mail ID</strong></td>
                                                                <td>{{$user->email_personal}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 10px" class="text-center"><i class="fa fa-code"></i></td>
                                                                <td><strong>Father's Name</strong></td>
                                                                <td class="capitalize">{{$user->father_name}}</td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td style="width: 10px" class="text-center"><i class="fa fa-code"></i></td>
                                                                <td><strong>Marital Status</strong></td>
                                                                <td class="capitalize">{{$user->mrtl_status}}</td>
                                                            </tr>
                                                            
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="messages">
                        
                        <div class="card" style="margin-top: 0px;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="box box-success">
                                            <div class="panel">

                                                <!--<div class="panel-heading">
                                                    <span class="panel-title">Personal Details</span>
                                                </div>-->

                                                <div class="panel-body pn pb5">
                                                    <!--<hr class="short br-lighter">-->

                                                    <div class="box-body no-padding">

                                                        <table class="table">
                                                            <tbody>
                                                                

                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i>
                                                                    </td>
                                                                    <td><strong>Certifications</strong></td>
                                                                    <td>{{$userdetail->certification}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i>
                                                                    </td>
                                                                    <td><strong>Graduation/Diploma</strong></td>
                                                                    <td>{{$userdetail->grd_diploma}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i>
                                                                    </td>
                                                                    <td><strong>University (for Graduation)</strong></td>
                                                                    <td>{{$userdetail->uni_grd}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i>
                                                                    </td>
                                                                    <td><strong>Institute (for Graduation)</strong></td>
                                                                    <td>{{$userdetail->inst_grd}}</td>
                                                                </tr>
                                                                
                                                               
                                                            </tbody>
                                                        </table>
                                                     
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="box box-success">
                                        <div class="panel">

                                            <!--<div class="panel-heading">
                                                <span class="panel-title">Bank Details</span>
                                            </div>-->
                                            <div class="panel-body pn pb5">
                                                <!--<hr class="short br-lighter">-->

                                                <div class="box-body no-padding">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 10px" class="text-center"><i class="fa fa-credit-card"></i></td>
                                                                <td><strong>University (for PG)</strong></td>
                                                                <td>{{$userdetail->uni_pg}}</td>

                                                            </tr>
                                                            <tr>
                                                                <td style="width: 10px" class="text-center"><i class="fa fa-credit-card"></i></td>
                                                                <td><strong>Institute (for PG)</strong></td>
                                                                <td>{{$userdetail->inst_pg}}</td>
                                                            </tr>
                                                            <tr>

                                                                <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i></td>
                                                                <td><strong>Year of Passing PG</strong></td>
                                                                <td>{{$user->year_pass_pg}}</td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i>
                                                                    </td>
                                                                    <td><strong>Year of Passing Graduation</strong></td>
                                                                    <td>{{$userdetail->year_pass_grd}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i>
                                                                    </td>
                                                                    <td><strong>Post Graduation</strong></td>
                                                                    <td>{{$userdetail->post_grd}}</td>
                                                                </tr>
                                                            

                                                            
                                                        </tbody>
                                                    </table>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="tab-pane fade" id="important">
                        
                        <div class="card" style="margin-top: 0px;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="box box-success">
                                            <div class="panel">

                                                <!--<div class="panel-heading">
                                                    <span class="panel-title">Personal Details</span>
                                                </div>-->

                                                <div class="panel-body pn pb5">
                                                    <!--<hr class="short br-lighter">-->

                                                    <div class="box-body no-padding">

                                                        <table class="table">
                                                            <tbody>
                                                                

                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i>
                                                                    </td>
                                                                    <td><strong>PAN Card Number</strong></td>
                                                                    <td>{{ base64_decode($userdetail->pancard) }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i>
                                                                    </td>
                                                                    <td><strong>UAN  Number</strong></td>
                                                                    <td>{{ base64_decode($userdetail->uanumber) }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i>
                                                                    </td>
                                                                    <td><strong>Aadhar Card Number</strong></td>
                                                                    <td>{{ base64_decode($userdetail->aadharcard) }}</td>
                                                                </tr>
                                                               
                                                               
                                                            </tbody>
                                                        </table>
                                                     
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="box box-success">
                                        <div class="panel">

                                            <!--<div class="panel-heading">
                                                <span class="panel-title">Bank Details</span>
                                            </div>-->
                                            <div class="panel-body pn pb5">
                                                <!--<hr class="short br-lighter">-->

                                                <div class="box-body no-padding">
                                                    <table class="table">
                                                        <tbody>
                                                            
                                                             <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i>
                                                                    </td>
                                                                    <td><strong>Bank A/C Number</strong></td>
                                                                    <td>{{ base64_decode($userdetail->bknumber) }}</td>
                                                                </tr>
                                                                
                                                            <tr>
                                                                <td style="width: 10px" class="text-center"><i class="fa fa-credit-card"></i></td>
                                                                <td><strong>Bank Name</strong></td>
                                                                <td>{{ base64_decode($userdetail->bkname) }}</td>

                                                            </tr>
                                                            <tr>
                                                                <td style="width: 10px" class="text-center"><i class="fa fa-credit-card"></i></td>
                                                                <td><strong>IFSC Code</strong></td>
                                                                <td>{{ base64_decode($userdetail->ifscode) }}</td>
                                                            </tr>
                                                            
                                                            

                                                            
                                                        </tbody>
                                                    </table>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="tab-pane fade" id="exit">
                        
                        <div class="card" style="margin-top: 0px;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="box box-success">
                                            <div class="panel">

                                                <!--<div class="panel-heading">
                                                    <span class="panel-title">Personal Details</span>
                                                </div>-->

                                                <div class="panel-body pn pb5">
                                                    <!--<hr class="short br-lighter">-->

                                                    <div class="box-body no-padding">

                                                        <table class="table">
                                                            <tbody>
                                                                

                                                                <tr>
                                                                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i>
                                                                    </td>
                                                                    <td><strong>Last working Day</strong></td>
                                                                    <td>{{$user->last_working}}</td>
                                                                </tr>
                                                                
                                                                
                                                               
                                                            </tbody>
                                                        </table>
                                                     
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="box box-success">
                                        <div class="panel">

                                            <!--<div class="panel-heading">
                                                <span class="panel-title">Bank Details</span>
                                            </div>-->
                                            <div class="panel-body pn pb5">
                                                <!--<hr class="short br-lighter">-->

                                                <div class="box-body no-padding">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 10px" class="text-center"><i class="fa fa-credit-card"></i></td>
                                                                <td><strong>Reason for Exit</strong></td>
                                                                <td>{{$user->reason_exit}}</td>

                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>

            </div>
        </div>

       @include('admin.includes.footer')   
    </div>
</div>



@endsection

@section('js')
<script type="text/javascript">
    function ageCalculate() {

        var birthDate = document.getElementById('join_date').innerHTML;
        // document.getElementById("age").innerHTML = d;
        var mdate = birthDate.toString();
        var yearThen = parseInt(mdate.substring(0, 4), 10);
        var monthThen = parseInt(mdate.substring(5, 7), 10);
        var dayThen = parseInt(mdate.substring(8, 10), 10);

        var today = new Date();
        var birthday = new Date(yearThen, monthThen - 1, dayThen);
        //   alert(today.valueOf() + " " + birthday.valueOf());
        var differenceInMilisecond = today.valueOf() - birthday.valueOf();
        //  alert(differenceInMilisecond);
        var year_age = Math.floor(differenceInMilisecond / 31536000000);
        var day_age = Math.floor((differenceInMilisecond % 31536000000) / 86400000);

        var month_age = Math.floor(day_age / 30);
        day_age = day_age % 30;
        //var tMnt = (month_age + (year_age * 12));
        //var tDays = (tMnt * 30) + day_age;

        if (isNaN(year_age) || isNaN(month_age) || isNaN(day_age)) {
            document.getElementById('tenure').innerHTML = 0;
        } else {
            document.getElementById('tenure').innerHTML = year_age + " Years " + month_age + " Months " + day_age + " Days";
        }
    }
    $( document ).ready(function() {
      ageCalculate();
    });  
</script>
@endsection


