@extends('admin.layout.master')

@section('content')

@include('admin.includes.sidebar')

<div class="page-wrapper">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <!--<h4 class="page-title">Admin Manager</h4>-->
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('user')}}">User</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 d-flex no-block align-items-center">

        <div class="bs-example" style="width: 98%">

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="{{route('user.edit',$user->id)}}" class="nav-link active">Basic Details</a>
                </li>
               
                @if($user->role == 'manager') 
                 <li class="nav-item">
                    <a href="{{route('user.assign',$user->id)}}" class="nav-link ">Assign Users</a>
                </li>
                @endif
            </ul>

            <div class="tab-content">

                <div class="tab-pane fade show active" id="home">

                    <div class="card">
                        <form action="{{route('user.update',$user->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            {{--@method('PUT')--}}
                            <div class="card-body">
                                <h4 class="card-title">Edit User</h4>
                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Employee ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="emp_id" class="form-control" id="emp_id" value="{{$user->emp_id}}" disabled="disabled">

                                    </div>
                                </div>
                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="username" class="form-control" id="username" value="{{$user->username}}" required>
                                    </div>
                                </div>

                                <div class="form-group required row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">First name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="fname" class="form-control" id="fname" value="{{$user->first_name}}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Last name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="lname" class="form-control" id="lname" value="{{$user->last_name}}">
                                    </div>
                                </div>

                                <div class="form-group required row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Designation</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="designation" class="form-control" id="designation" placeholder="Enter Designation" value="{{$user->designation}}" required>
                                    </div>
                                </div>

                                <div class="form-group required row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Manager</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="manager" class="form-control" id="manager" placeholder="Enter Manager" value="{{$user->manager}}" required>
                                    </div>
                                </div>

                                <div class="form-group required row">
                                    <label for="city" class="col-sm-3 text-right control-label col-form-label">Department</label>
                                    <div class="col-sm-9">
                                        <select type="text" name="department" class="form-control" id="department" value="{{$user->department}}" required>
                                            <option value="" disabled selected>Select Department</option>
                                            <option value="HR" {{ ($user->department == 'HR'?'selected':'') }}>HR</option>
                                            <option value="Finance" {{ ($user->department == 'Finance'?'selected':'') }}>Finance</option>
                                            <option value="Marketing" {{ ($user->department == 'Marketing'?'selected':'') }}>Marketing</option>
                                            <option value="Admin" {{ ($user->department == 'Admin'?'selected':'') }}>Admin</option>
                                            <option value="IT - Development" {{ ($user->department == 'IT - Development'?'selected':'') }}>IT - Development</option>
                                            <option value="IT - Infrastructure" {{ ($user->department == 'IT - Infrastructure'?'selected':'') }}>IT - Infrastructure</option>
                                            <option value="Trainings" {{ ($user->department == 'Trainings'?'selected':'') }}>Trainings</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group required row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Role</label>
                                    <div class="col-sm-9">
                                        <select type="text" name="role" class="form-control" id="lname" value="{{$user->role}}" required>
                                            <option value="" disabled selected>Select Role</option>
                                            @can('isAdmin')
                                            <option value="admin" {{ ($user->role == 'admin' ? 'selected' : '') }}>Admin</option>
                                            <option value="manager" {{ (old('role') == 'manager' ? 'selected' : '') }}>Manager</option>
                                            @endcan
                                            <option value="employee" {{ ($user->role == 'employee' ? 'selected' : '') }}>Employee</option>
                                        </select>
                                    </div>
                                </div>

                                <!--<div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Salary</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="salary" class="form-control" value="{{$user->salary}}">
                                    </div>
                                </div>-->

                                <div class="form-group required row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="email" class="form-control" id="lname" value="{{$user->email}}" required>
                                    </div>
                                </div>

                                <div class="form-group required row">
                                    <label for="phone" class="col-sm-3 text-right control-label col-form-label">Phone number</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="phone" class="form-control" id="phone" value="{{$user->phone}}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-sm-3 text-right control-label col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="address" class="form-control" id="address" value="{{$user->address}}">
                                    </div>
                                </div>

                                <div class="form-group required row">
                                    <label for="gender" class="col-sm-3 text-right control-label col-form-label">Gender</label>
                                    <div class="col-sm-9">
                                        <select type="text" name="gender" class="form-control" id="gender" value="{{$user->gender}}" required>
                                            <option value="Male" {{ ($user->gender == 'Male' ? 'selected' : '') }}>Male</option>
                                            <option value="Female" {{ ($user->gender == 'Female' ? 'selected' : '') }}>Female</option>
                                            <option value="Other" {{ ($user->gender == 'Other' ? 'selected' : '') }}>Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group required row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <select type="text" name="status" class="form-control" id="status" placeholder="Status">
                                            <option value="1" {{ ($user->status == 1 ? 'selected' : '') }}>Active</option>
                                            <option value="0" {{ ($user->status == 0 ? 'selected' : '') }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group  required row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Date of Birth</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="dob" class="form-control" id="dob" value="{{$user->dob}}" onblur="ageCalculate()" required>
                                    </div>
                                </div>

                                <div class="form-group required row">
                                    <label for="joindate" class="col-sm-3 text-right control-label col-form-label">Join date</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="join_date" class="form-control" id="join_date" value="{{$user->join_date}}" required>
                                    </div>
                                </div>

                                <div class="form-group required row">
                                    <label for="job type" class="col-sm-3 text-right control-label col-form-label">Job type</label>
                                    <div class="col-sm-9">
                                        <select type="text" name="job_type" class="form-control" id="job_type" value="{{$user->job_type}}" required>
                                            <option value="" disabled selected>Select Job Type</option>
                                            <option value="Regular" {{ ($user->job_type == 'Regular'?'selected':'') }}>Regular</option>
                                            <option value="Contractual" {{ ($user->job_type == 'Contractual'?'selected':'') }}>Contractual</option>
                                            <option value="Part Time" {{ ($user->job_type == 'Part Time'?'selected':'') }}>Part Time</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group required row">
                                    <label for="city" class="col-sm-3 text-right control-label col-form-label">Office</label>
                                    <div class="col-sm-9">
                                        <select type="text" name="city" class="form-control" id="city" value="{{$user->city}}" required>
                                            <option value="" disabled selected>Select Office</option>
                                            <option value="Faridabad" {{ ($user->city == 'Faridabad'?'selected':'') }}>Faridabad</option>
                                            <option value="Home Office" {{ ($user->city == 'Home Office'?'selected':'') }}>Home Office</option>
                                            <option value="London UK" {{ ($user->city == 'London UK'?'selected':'') }}>London UK</option>
                                            <option value="Other Location" {{ ($user->city == 'Other Location'?'selected':'') }}>Other Location</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group  row">
                                    <label for="age" class="col-sm-3 text-right control-label col-form-label">Age</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="age" class="form-control" id="age" value="{{$user->age}}">
                                    </div>
                                </div>

                                <div class="form-group  row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Upload Profile Image</label>
                                    <div class="col-md-9">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input" value="{{$user->image}}">
                                            <label class="custom-file-label">{{$user->image}}</label>
                                        {{--<div class="invalid-feedback">Example invalid custom file feedback</div>--}}
                                        </div>
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <label for="joindate" class="col-sm-3 text-right control-label col-form-label">Relieve  date</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="relieve_date" class="form-control" id="relieve_date" value="{{$user->relieve_date}}">
                                    </div>
                                </div>

                                <div class="form-group  row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Last working Day</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="last_working" class="form-control" id="last_working" value="{{$user->last_working}}">
                                    </div>
                                </div>

                                <div class="form-group  row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Reason for Exit</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" name="reason_exit" class="form-control" placeholder="Reason">{{$user->reason_exit}}</textarea>
                                    </div>
                                </div>


                                <!--<div class="form-group row">
                                    <label for="age" class="col-sm-3 text-right control-label col-form-label">Connectivity:</label>
                                    <div class="col-sm-9">
                                        <input type="checkbox" class="form-check-input" id="check1" name="option1" checked>Slack account <br>
                                        <input type="checkbox" class="form-check-input" id="check1" name="option1" >Trello account <br>
                                        <input type="checkbox" class="form-check-input" id="check1" name="option1" >Ipage account <br>
                                        <input type="checkbox" class="form-check-input" id="check1" name="option1" >Others
                                    </div>
                                </div>-->

                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-dark">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>


        </div>
    </div>



    @include('admin.includes.footer')   
</div>
@endsection

@section('js')
<script type="text/javascript">
    function ageCalculate() {
        //document.getElementById('age').InnerHtml
        // document.getElementById("demo").InnerHtml=4+5;
        //document.write="Hi";
        var birthDate = document.getElementById('dob').value;

        //if(birthDate==""){
        //  alert("Choose correct birthdate.")
        //}else{
        //  alert(birthDate);
        //  alert(Date());
        //var d = new Date(birthDate);
        // document.getElementById("age").innerHTML = d;
        //}

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
        //var day_age = Math.floor((differenceInMilisecond % 31536000000) / 86400000);

        //if ((today.getMonth() == birthday.getMonth()) && (today.getDate() == birthday.getDate())) {
        // alert("Happy B'day!!!");
        // }

        //var month_age = Math.floor(day_age / 30);
        //day_age = day_age % 30;
        //var tMnt = (month_age + (year_age * 12));
        //var tDays = (tMnt * 30) + day_age;

        if (isNaN(year_age)) {
            document.getElementById('age').value = 0;
        } else {
            document.getElementById('age').value = year_age;
        }


        //if (isNaN(year_age) || isNaN(month_age) || isNaN(day_age)) {
        //document.getElementById("age").innerHTML = ("Invalid birthday - Please try again!");
        //} else {
        //document.getElementById("age").innerHTML = year_age + " years " + month_age + " months " + day_age + " days"
        // + "<br/> or <br/> "
        //+ tMnt + " months " + day_age + " days"
        //+ "<br/> or <br/>"
        //+ tDays + " days"
        //+ "<br/> or <br/>"
        //+ tDays * 24 + " hours"
        //+ "<br/> or <br/>"
        // + tDays * 24 * 3600 + " seconds"
        // + "<br/> or <br/>"
        // + tDays * 24 * 3600 * 1000 + " miliseconds";
        //}

    }

    $('input[type="file"]').change(function (e) {
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });

</script>
@stop
