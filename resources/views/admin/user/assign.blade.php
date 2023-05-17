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
                    <a href="{{route('user.edit',$user->id)}}" class="nav-link">Basic Details</a>
                </li>
               
                @if($user->role == 'manager') 
                 <li class="nav-item">
                    <a href="{{route('user.assign',$user->id)}}" class="nav-link active">Assign Users</a>
                </li>
                @endif
            </ul>

            <div class="tab-content">

                <div class="tab-pane fade show active" id="home">

                    <div class="card">
                        <form action="{{route('user.assignupdate',$user->id)}}" method="post" class="form-horizontal">
                            @csrf
                            {{--@method('PUT')--}}
                            <div class="card-body">

                                <h4 class="card-title">Assign Users to {{$user->first_name}} {{$user->last_name}}</h4>



                                <div class="form-group required row">

                                    <div class="col-sm-12">
                                        <select type="text" multiple="multiple" name="assign_id[]" class="form-control" id="assign_id" required>
                                            <option value=""> --Select Users-- </option>
                                            @foreach ($userlist as $key => $value)
                                            <option value="{{ $key }}"  @if(in_array($key, $assignids)) {{'selected'}} @endif>{{ $value }}</option>
                                            @endforeach    
                                        </select>
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
