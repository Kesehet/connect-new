@extends('admin.layout.master')

@section('content')

<div class="page-wrapper">

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Dashboard</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h3 class="card-title capitalize">Hello {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}, Welcome To Thinknyx Connect</h3>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


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
                                                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i>
                                                    </td>
                                                    <td><strong>Phone number</strong></td>
                                                    <td>{{$user->phone}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i>
                                                    </td>
                                                    <td><strong>Designation</strong></td>
                                                    <td>{{$user->designation}}</td>
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

                    <div class="col-md-5">
                        <div class="box box-success">
                            <div class="panel">


                                <div class="panel-body pn pb5">


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
                                                    <td><span id="join_date" style="display: none;">{{$user->join_date}}</span> {{ \Carbon\Carbon::parse($user->join_date)->format('d-m-Y') }}</td>
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


        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Birthdays Current Month</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                
                                    <div id="calendar">
                                        <div class="table-responsive">
                                            <table id="zero_config" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>S.N</th>
                                                        <th>Username</th>
                                                        <th>DOB</th>
                                                        <th>Email</th>
                                                        
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($users as $user)
                                                    <tr>
                                                        <th>{{$loop->index+1}}</th>
                                                        <td>{{$user->username}}</td>
                                                        <td>{{$user->dob}}</td>
                                                        <td>{{$user->email}}</td>
                                                    </tr>

                                                    @endforeach
                                                </tbody>
                                            </table>
                                            
                                        </div>

                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Weekly Timesheet</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">

                                <div id="calendar">

                                    <div class="table-responsive">
                                        <table id="zero_config" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>S.N.</th>
                                                    <th>Employee name</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($timesheets as $timesheet)
                                                <tr>
                                                    <td>{{$loop -> index+1 }}</td>
                                                    <td>{{$timesheet->users->username }}</td>
                                                    <td>{{$timesheet->timesheet_date}}</td>
                                                    <td>{{floor($timesheet->totalmins/60)}}:{{$timesheet->totalmins%60}}</td>
                                                    
                                                </tr>
                                            </tbody>
                                            @endforeach
                                        </table>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>




        <?php /* <div class="row">
          <!-- Column -->
          <div class="col-md-6 col-lg-4 col-xlg-3">
          <div class="card card-hover">
          <div class="box bg-success text-center">
          <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
          <h5 class="m-b-0 m-t-5 text-white">{{ $users->total() }}</h5>
          <h6 class="text-white">Total employees</h6>
          </div>
          </div>
          </div>
          <!-- Column -->
          <div class="col-md-6 col-lg-2 col-xlg-3">
          <div class="card card-hover">
          <div class="box bg-warning text-center">
          <h1 class="font-light text-white"><i class="mdi mdi-collage"></i></h1>
          <h5 class="m-b-0 m-t-5 text-white">25</h5>
          <h6 class="text-white">Total leaves</h6>
          </div>
          </div>
          </div>
          <!-- Column -->
          <div class="col-md-6 col-lg-2 col-xlg-3">
          <div class="card card-hover">
          <div class="box bg-danger text-center">
          <h1 class="font-light text-white"><i class="mdi mdi-border-outside"></i></h1>
          <h5 class="m-b-0 m-t-5 text-white">2</h5>
          <h6 class="text-white">On leave</h6>
          </div>
          </div>
          </div>

          <div class="col-md-6 col-lg-2 col-xlg-3">
          <div class="card card-hover">
          <div class="box bg-cyan text-center">
          <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
          <h5 class="m-b-0 m-t-5 text-white">6</h5>
          <h6 class="text-white">Designation</h6>
          </div>
          </div>
          </div>
          </div> */ ?>

        <!--<div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Calendar</h4>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-lg-12">
                                    <div class="card-body b-l calender-sidebar">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->

    </div> 

    @include('admin.includes.footer')   
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

<script src="{{asset('admin-panel/assets/libs/flot/excanvas.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/flot/jquery.flot.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/flot/jquery.flot.pie.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/flot/jquery.flot.time.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/flot/jquery.flot.stack.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/flot/jquery.flot.crosshair.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script>
<script src="{{asset('admin-panel/dist/js/pages/chart/chart-page-init.js')}}"></script>

<!-- {{--<script src="{{asset('admin-panel/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('admin-panel/dist/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin-panel/dist/js/custom.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/moment/min/moment.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<script src="{{asset('admin-panel/dist/js/pages/calendar/cal-init.js')}}"></script>--}} -->

@endsection
