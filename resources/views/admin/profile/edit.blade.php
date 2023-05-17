@extends('admin.layout.master')

@section('content')





<div id="main-wrapper">
    @include('admin.includes.sidebar')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">

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
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="{{route('profile.edit')}}" class="nav-link active">Basic Details</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('profile.personal')}}" class="nav-link alertme">Personal Details</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('profile.education')}}" class="nav-link alertme">Educational Details</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('profile.important')}}" class="nav-link alertme">Important Details</a>
                    </li>
                    @can('isAdmin')
                    <li class="nav-item">
                        <a href="{{route('profile.exitdetails')}}" class="nav-link alertme">Exit Details</a>
                    </li>
                    @endcan
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="home">
                        <p>
                        <div class="card" style="margin-top: -15px;">
                            <form action="{{route('profile.update',$user->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">

                                    <div class="form-group required row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Employee ID</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="emp_id" class="form-control" id="emp_id" value="{{$user->emp_id}}" disabled="disabled">

                                        </div>
                                    </div>

                                    <div class="form-group required row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Upload Profile Image</label>
                                        <div class="col-md-9">
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input" value="{{$user->image}}">
                                                <label class="custom-file-label">{{$user->image}}</label>
                                            {{--<div class="invalid-feedback">Example invalid custom file feedback</div>--}}
                                                </div>
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

                                    <!--<div class="form-group row">
                                       <label for="lname" class="col-sm-3 text-right control-label col-form-label">Designation</label>
                                       <div class="col-sm-9">
                                           <input type="text" name="designation" class="form-control" id="designation" value="{{$user->designation}}">
                                       </div>
                                   </div>-->


                                    <!--<div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Salary</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="salary" class="form-control" value="{{$user->salary}}">
                                        </div>
                                    </div>-->


                                    <div class="form-group required row">
                                        <label for="gender" class="col-sm-3 text-right control-label col-form-label">Gender</label>
                                        <div class="col-sm-9">
                                            <select type="text" name="gender" class="form-control" id="gender" value="{{$user->gender}}" required>
                                                <option value="" disabled selected>Select Gender</option>
                                                <option value="Male" {{ ($user->gender == 'Male'?'selected':'') }}>Male</option>
                                                <option value="Female" {{ ($user->gender == 'female'?'selected':'') }}>Female</option>
                                                <option value="Other" {{ ($user->gender == 'Other'?'selected':'') }}>Other</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group required row">
                                        <label for="joindate" class="col-sm-3 text-right control-label col-form-label">Join date</label>
                                        <div class="col-sm-9">
                                            <input type="date" name="join_date" class="form-control" id="join_date" value="{{$user->join_date}}" onblur="ageCalculate()" required>
                                        </div>
                                    </div>

                                    <!--<div class="form-group row">
                                        <label for="joindate" class="col-sm-3 text-right control-label col-form-label">Relieve  date</label>
                                        <div class="col-sm-9">
                                            <input type="date" name="relieve_date" class="form-control" id="relieve_date" value="{{$user->relieve_date}}">
                                        </div>
                                    </div>-->


                                    <div class="form-group required row">
                                        <label for="job type" class="col-sm-3 text-right control-label col-form-label">Job type (Status)</label>
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

                                    <!--<div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Manager</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="manager" class="form-control" id="manager" value="{{$user->manager}}">
                                        </div>
                                    </div>-->

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

                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Thinknyx Tenure (Years)</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="tenure" class="form-control" id="tenure" value="{{$user->tenure}}">
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
                                        <input type="submit" class="btn btn-dark" value="Submit" />
                                    </div>
                                </div>
                            </form>
                        </div>

                        </p>
                    </div>

                    <!--
                    <ul class="nav nav-tabs">
                       <li class="nav-item">
                           <a href="#home" class="nav-link" data-toggle="tab">Basic Details</a>
                       </li>
                       <li class="nav-item">
                           <a href="#profile" class="nav-link active" data-toggle="tab">Personal Details</a>
                       </li>
                       <li class="nav-item">
                           <a href="#messages" class="nav-link" data-toggle="tab">Educational Details</a>
                       </li>
                       <li class="nav-item">
                           <a href="#messages" class="nav-link" data-toggle="tab">Exit Details</a>
                       </li>
                    </ul>
                    <div class="tab-content">
                       <div class="tab-pane fade show active" id="home">
                          <h4 class="mt-2">Profile tab content</h4>
                          <p></p>
                        </div>

                      <div class="tab-pane fade" id="profile">
                          <h4 class="mt-2">Profile tab content</h4>
                          <p>Vestibulum nec erat eu nulla rhoncus fringilla ut non neque. Vivamus nibh urna, ornare id gravida ut, mollis a magna. Aliquam porttitor condimentum nisi, eu viverra ipsum porta ut. Nam hendrerit bibendum turpis, sed molestie mi fermentum id. Aenean volutpat velit sem. Sed consequat ante in rutrum convallis. Nunc facilisis leo at faucibus adipiscing.</p>
                      </div>
                      <div class="tab-pane fade" id="messages">
                          <h4 class="mt-2">Messages tab content</h4>
                          <p>Donec vel placerat quam, ut euismod risus. Sed a mi suscipit, elementum sem a, hendrerit velit. Donec at erat magna. Sed dignissim orci nec eleifend egestas. Donec eget mi consequat massa vestibulum laoreet. Mauris et ultrices nulla, malesuada volutpat ante. Fusce ut orci lorem. Donec molestie libero in tempus imperdiet. Cum sociis natoque penatibus et magnis.</p>
                      </div>
                    </div>-->

                </div>
            </div>

        </div>



        @include('admin.includes.footer')   
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.8/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
    function ageCalculate() {

        var birthDate = document.getElementById('join_date').value;

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
        var day_age = Math.floor((differenceInMilisecond % 31536000000) / 86400000);

        var month_age = Math.floor(day_age / 30);
        day_age = day_age % 30;
        //var tMnt = (month_age + (year_age * 12));
        //var tDays = (tMnt * 30) + day_age;

        if (isNaN(year_age) || isNaN(month_age) || isNaN(day_age)) {
            document.getElementById('tenure').value = 0;
        } else {
            document.getElementById('tenure').value = year_age + " Years " + month_age + " Months " + day_age + " Days";
        }

    }

    $(document).ready(function () {
        ageCalculate();
    });

    $('input[type="file"]').change(function (e) {
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });

    $(".alertme").click(function () {
        event.preventDefault();
        const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
        });

        swalWithBootstrapButtons({
            title: 'Are you sure?',
            text: "You have saved your current data!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, I have saved!',
            cancelButtonText: 'No, Not saved!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                window.location.href = this.href
            } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                    ) {
                swalWithBootstrapButtons(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                        );
            }
        });
    });


</script>
@stop
