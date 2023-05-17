@extends('admin.layout.master')

@section('content')

    <div id="main-wrapper">
    @include('admin.includes.sidebar')
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Attendance Management</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('attendancelog')}}">Attendance</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
               
                <!--<div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="{{route('leave.search')}}" method="GET" class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title">Search</h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Search by leave type</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="search" class="form-control" id="fname" placeholder="Leave type">
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-success">Search</button>
                                        <a href="{{route('leave')}}" class="btn btn-md btn-danger">Clear</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>-->

                <div class="row">
                    
                    <!--<div class="col-md-2">
                        @can('isEmployee')
                        <a class="btn btn-lg btn-dark" href="{{route('leave.create')}}">Apply leave</a>
                        @endcan
                    </div>-->
                    
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Attendance Log</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>IP</th>
                                            <th>Login Time</th>
                                            <th>Logout Time</th>
                                            <th>Total Time</th>
                                            <th>Log Date</th>
                                            @if(Auth::user()->role=='admin')
                                            <th>User Name</th>
                                            @endif
                                            
                                            
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($userlogs as $userlog)
                                            <tr>
                                                <td>{{$loop -> index+1 }}</td>
                                                <td>{{$userlog->userip }}</td>
                                                <td>{{ \Carbon\Carbon::parse($userlog->logintime)->format('d/m/Y H:i') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($userlog->logouttime)->format('d/m/Y H:i') }}</td>
                                                <td>{{$userlog->totaltime}}</td>
                                                <td>{{ \Carbon\Carbon::parse($userlog->created_at)->format('d/m/Y') }}</td>
                                                @if(Auth::user()->role=='admin')
                                                <td>{{$userlog->first_name}}&nbsp;{{$userlog->last_name}}</td>
                                                @endif
                                                       
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
            
           @include('admin.includes.footer')   
        </div>
    </div>

@endsection