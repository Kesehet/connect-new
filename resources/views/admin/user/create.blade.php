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
                <h4 class="page-title">Admin Manager</h4>
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <form action="{{route('user.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">Add User</h4>

                            <div class="form-group required row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Employee ID</label>
                                <div class="col-sm-9">
                                    <input type="text" name="emp_id" class="form-control" id="emp_id" placeholder="Enter a Employee Id"  value="{{ old('emp_id') }}" required="required">
                                </div>
                            </div>

                            <div class="form-group required row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" name="username" class="form-control" id="username" placeholder="Enter a Username" value="{{ old('username') }}" required="required">
                                </div>
                            </div>

                            <div class="form-group required row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">First name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="fname" class="form-control" id="fname" placeholder="Enter First Name" value="{{ old('fname') }}" required="required">
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">Last name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="lname" class="form-control" id="lname" placeholder="Enter Last Name" value="{{ old('lname') }}">
                                </div>
                            </div>

                            <div class="form-group required row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">Designation</label>
                                <div class="col-sm-9">
                                    <input type="text" name="designation" class="form-control" id="designation" placeholder="Enter Designation" value="{{ old('designation') }}" required>
                                </div>
                            </div>

                            <div class="form-group required row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">Manager</label>
                                <div class="col-sm-9">
                                    <input type="text" name="manager" class="form-control" id="manager" placeholder="Enter Manager" value="{{ old('manager') }}" required>
                                </div>
                            </div>

                            <div class="form-group required row">
                                <label for="city" class="col-sm-3 text-right control-label col-form-label">Department</label>
                                <div class="col-sm-9">
                                    <select type="text" name="department" class="form-control" id="department"  required>
                                        <option value="" disabled selected>Select Department</option>
                                        <option value="HR" {{ (old('department') == 'HR'?'selected':'') }}>HR</option>
                                        <option value="Finance" {{ (old('department') == 'Finance'?'selected':'') }}>Finance</option>
                                        <option value="Marketing" {{ (old('department') == 'Marketing'?'selected':'') }}>Marketing</option>
                                        <option value="Admin" {{ (old('department') == 'Admin'?'selected':'') }}>Admin</option>
                                        <option value="IT - Development" {{ (old('department') == 'IT - Development'?'selected':'') }}>IT - Development</option>
                                        <option value="IT - Infrastructure" {{ (old('department') == 'IT - Infrastructure'?'selected':'') }}>IT - Infrastructure</option>
                                        <option value="Trainings" {{ (old('department') == 'Trainings'?'selected':'') }}>Trainings</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group required row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email Id" value="{{ old('email') }}" required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                                </div>
                            </div>

                            <div class="form-group required row">
                                <label for="phone" class="col-sm-3 text-right control-label col-form-label">Phone number</label>
                                <div class="col-sm-9">
                                    <input type="number" name="phone" class="form-control" id="phone"  value="{{ old('phone') }}" required>
                                </div>
                            </div>

                            <div class="form-group required row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" class="form-control" id="lname" placeholder="Enter Password" required pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" title="Password must contain: Only Alphabets and Numbers Minimum 8 Characters Atleast 1 Alphabet and 1 Number">
                                    <div class="invalid-feedback" style="display: block;">Hints: Only Alphabets and Numbers Minimum 8 Characters like admin123 etc.</div>
                                </div>
                            </div>

                            <div class="form-group required row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">Role</label>
                                <div class="col-sm-9">
                                    <select type="text" name="role" class="form-control" id="lname" placeholder="Role" required>
                                        <option value="" disabled selected>Select Role</option>
                                        @can('isAdmin')
                                        <option value="admin" {{ (old('role') == 'admin' ? 'selected' : '') }}>Admin</option>
                                        <option value="manager" {{ (old('role') == 'manager' ? 'selected' : '') }}>Manager</option>
                                        @endcan
                                        <option value="employee" {{ (old('role') == 'employee' ? 'selected' : '') }}>Employee</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group required row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select type="text" name="status" class="form-control" id="status" placeholder="Status">
                                        <option value="1" {{ (old('status')== 1 ? 'selected' : '') }}>Active</option>
                                        <option value="0" {{ (old('status') == 0 ? 'selected' : '') }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-sm-3 text-right control-label col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <input type="text" name="address" class="form-control" id="address" value="{{ old('address') }}">
                                </div>
                            </div>

                            <div class="form-group required row">
                                <label for="gender" class="col-sm-3 text-right control-label col-form-label">Gender</label>
                                <div class="col-sm-9">
                                    <select type="text" name="gender" class="form-control" id="gender" value="{{ old('gender') }}" required>
                                        <option value="" disabled selected>Select Gender</option>
                                       <option value="Male" {{ (old('gender') == 'Male' ? 'selected' : '') }}>Male</option>
                                            <option value="Female" {{ (old('gender') == 'Female' ? 'selected' : '') }}>Female</option>
                                            <option value="Other" {{ (old('gender') == 'Other' ? 'selected' : '') }}>Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group required row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">Date of Birth</label>
                                <div class="col-sm-9">
                                    <input type="date" name="dob" class="form-control" id="dob" value="{{ old('dob') }}" onblur="ageCalculate()" required>
                                </div>
                            </div>

                            <div class="form-group required row">
                                <label for="joindate" class="col-sm-3 text-right control-label col-form-label">Joining date</label>
                                <div class="col-sm-9">
                                    <input type="date" name="join_date" class="form-control" id="join_date" value="{{ old('join_date') }}" required>
                                </div>
                            </div>

                            <div class="form-group required row">
                                <label for="job type" class="col-sm-3 text-right control-label col-form-label">Job type</label>
                                <div class="col-sm-9">
                                    <select type="text" name="job_type" class="form-control" id="job_type" value="{{ old('job_type') }}" required>
                                        <option value="" disabled selected>Select Job Type</option>
                                        <option value="Regular" {{ (old('job_type') == 'Regular'?'selected':'') }}>Regular</option>
                                            <option value="Contractual" {{ (old('job_type') == 'Contractual'?'selected':'') }}>Contractual</option>
                                            <option value="Part Time" {{ (old('job_type') == 'Part Time'?'selected':'') }}>Part Time</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group required row">
                                <label for="city" class="col-sm-3 text-right control-label col-form-label">Office</label>
                                <div class="col-sm-9">
                                    <select type="text" name="city" class="form-control" id="city" value="{{ old('city') }}" required>
                                        <option value="" disabled selected>Select Office</option>
                                        <option value="Faridabad" {{ (old('city') == 'Faridabad'?'selected':'') }}>Faridabad</option>
                                            <option value="Home Office" {{ (old('city') == 'Home Office'?'selected':'') }}>Home Office</option>
                                            <option value="London UK" {{ (old('city') == 'London UK'?'selected':'') }}>London UK</option>
                                            <option value="Other Location" {{ (old('city') == 'Other Location'?'selected':'') }}>Other Location</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="age" class="col-sm-3 text-right control-label col-form-label">Age</label>
                                <div class="col-sm-9">
                                    <input type="number" name="age" class="form-control" id="age" value="{{ old('age') }}">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Upload Profile Image</label>
                                <div class="col-md-9">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input">
                                        <label class="custom-file-label">Choose file...</label>
                                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                                        <div class="invalid-feedback" style="display: block;">Hints: Picture dimensions like (100x100) px.</div>
                                    </div>
                                </div>
                            </div>


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

