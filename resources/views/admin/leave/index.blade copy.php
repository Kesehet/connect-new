<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
echo "errormadhuri";
?>
@extends('admin.layout.master')

@section('content')

    <div id="main-wrapper">
    @include('admin.includes.sidebar')
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Leave Management</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('leave')}}">Leave</a></li>
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

                            <form action="{{route('leave.search')}}" method="GET" class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title">Search</h4>
                                    <div class="form-group row">
                                        
                                        <div class="col-sm-3">
                                            <!--input type="text" name="leavetype" class="form-control" id="leavetype" placeholder="Leave Type" value="{{ Request::get('leavetype') }}" commented by Madhuri-->
                                            <select type="text" name="leavetype" class="form-control" id="leavetype" value="" required="required">
                                            <option value="Annual Leave">Annual Leave</option>
                                            <option value="Sick Leave">Sick Leave</option>
                                            <option value="Casual Leave">Casual Leave</option>
                                            <option value="Maternity Leave">Maternity Leave</option>
                                            <option value="Paternity Leave">Paternity Leave</option>
                                            <option value="Compensatory Leave">Compensatory Leave</option>
                                            <option value="Unpaid Leave">Unpaid Leave</option>
                                            <option value="Work From Home">Work From Home</option>
                                        </select>
                                        </div>

                                        @canany(['isAdmin', 'isManager']) 
                                        <div class="col-sm-3">
                                            <select type="text" name="userid" class="form-control" id="userid" placeholder="Select User">
                                                <option value="">-Select User-</option>
                                                <?php
                                                echo json_encode($userlist);
                                                ?>
                                                @foreach ($userlist as $key => $value)
                                                <option value="{{ $key }}" {{ (Request::get('userid') == $key)? 'selected' : '' }}> {{ $value }} </option>
                                                @endforeach    
                                            </select>
                                        </div>
                                        @endcanany
                                        <div class="col-sm-3">
                                            <!--input type="date" name="createddate" class="form-control" id="createddate" placeholder="Date filter" value="{{ Request::get('createddate') }}"commented by Madhuri-->
                                            <input type="date" min="{{date('Y-m-d'),strtotime("2013-01-19 01:23:42")}}" name="date_from" class="form-control" id="FromDate">
                                            
                                        </div>
                                        <div class="col-sm-3">
                                            <!--input type="date" name="createddate" class="form-control" id="createddate" placeholder="Date filter" value="{{ Request::get('createddate') }}"commented by Madhuri-->
                                            
                                            <input type="date" min="{{date('Y-m-d', strtotime("-90 days"))}}" name="date_to" class="form-control" id="ToDate" required="required">
                                            <script>
                                                document.getElementById("FromDate").min = "2010-10-10"
                                                document.getElementById("FromDate").max = new Date().toISOString().split("T")[0];
                                                document.getElementById("ToDate").max = new Date().toISOString().split("T")[0];
                                                </script>
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
                </div>

                <div class="row">
                    <div class="col-md-2">
                        @can('isEmployee')
                        <a class="btn btn-lg btn-dark" href="{{route('leave.create')}}">Apply leave</a>
                        @endcan
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Leave List</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            @canany(['isAdmin', 'isManager']) <th>Employee <br>name</th>@endcanany
                                            <th>Leave <br> type</th>
                                            <th>Date <br>from</th>
                                            <th>Date <br>to</th>
                                            <th>No. of <br>days</th>
                                            <th>Reason</th>
                                            <th>Comment</th>
                                            <th>Leave <br>status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($leaves as $leave)
                                            <tr>
                                                <td>{{$loop -> index+1 }}</td>
                                                @canany(['isAdmin', 'isManager'])<td>{{$leave->users->username }}</td>@endcanany
                                                <td>{{$leave->leave_type}}</td>
                                                <td>{{$leave->date_from}}</td>
                                                <td>{{$leave->date_to}}</td>
                                                <td>{{$leave->days}}</td>
                                                <td>{{$leave->reason}}</td>
                                                <td>{{$leave->manager_comment}}</td>
                                                
                                                <td>
                                                    @if($leave->is_approved==2)
                                                        <span class="badge badge-pill badge-danger">Rejected</span>
                                                    @elseif($leave->is_approved==1)
                                                        <span class="badge badge-pill badge-success">Approved</span>
                                                    @elseif($leave->is_approved==3)
                                                        <span class="badge badge-pill badge-info">Canceled</span>
                                                    @else
                                                        <span class="badge badge-pill badge-warning">Pending</span>
                                                    @endif
                                                </td>
                                                
                                                <!--<td>
                                                    @if(Auth::user()->role=='admin')
                                                        {{--{{$leave->is_approved}}--}}
                                                        @if($leave->leave_type_offer==0)
                                                            <form id="{{$leave->id}}" action="{{route('leave.paid',$leave->id)}}" method="POST">
                                                                @csrf
                                                                {{--<button type="button" onclick="approveLeave({{$leave->id}})" class="btn btn-sm btn-cyan" name="approve" value="1">Approve</button>--}}
                                                                <button type="submit" onclick="return confirm('Are you sure want to paid for leave?')" class="btn btn-sm btn-cyan" name="paid" value="1">Paid</button>
                                                            </form>
                                                            <form id="{{$leave->id}}" action="{{route('leave.paid',$leave->id)}}" method="POST">
                                                                @csrf
                                                                {{--<button type="button" onclick="rejectLeave({{$leave->id}})" class="btn btn-sm btn-danger" name="approve" value="2">Reject</button>--}}
                                                                <button type="submit" onclick="return confirm('Are you sure want to paid for leave?')" class="btn btn-sm btn-danger" name="paid" value="2">Unpaid</button>
                                                            </form>
                                                        @elseif($leave->leave_type_offer==1)

                                                            <form action="{{route('leave.paid',$leave->id)}}" method="POST">
                                                                @csrf
                                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to unpaid for leave?')" type="submit" name="paid" value="2">Unpaid</button>
                                                            </form>
                                                        @else
                                                            <form action="{{route('leave.paid',$leave->id)}}" method="POST">
                                                                @csrf
                                                                <button class="btn btn-sm btn-cyan" onclick="return confirm('Are you sure want to piad for leave?')" type="submit" name="paid" value="1">Paid</button>
                                                            </form>
                                                        @endif

                                                        {{--<a href="{{route('leave.approve',$leave->id)}}" class="btn btn-sm btn-cyan">Approve</a>--}}
                                                        {{--<a href="{{route('leave.pending',$leave->id)}}" class="btn btn-sm btn-warning">Pending</a>--}}
                                                        {{--<a href="{{route('leave.reject',$leave->id)}}" class="btn btn-sm btn-danger">Reject</a>--}}
                                                    @else
                                                        @if($leave->leave_type_offer==0)
                                                            <span class="badge badge-pill badge-warning">Pending</span>
                                                        @elseif($leave->leave_type_offer==1)
                                                            <span class="badge badge-pill badge-success">Paid</span>
                                                        @else
                                                            <span class="badge badge-pill badge-danger">Unpaid</span>
                                                        @endif
                                                    @endif
                                                </td>-->
                                                

                                                <td>
                                                    @if(Auth::user()->role=='admin' || (Auth::user()->role=='manager' && $leave->employee_id != Auth::id()))
                                                         <!--
                                                         {{--{{$leave->is_approved}}--}}
                                                         <button type="submit" onclick="return confirm('Are you sure want to approve leave?')" class="btn btn-sm btn-cyan" name="approve" value="1">Approve</button>
                                                         <button type="submit" onclick="return confirm('Are you sure want to reject leave?')" class="btn btn-sm btn-danger" name="approve" value="2">Reject</button>
                                                        {{--<a href="{{route('leave.approve',$leave->id)}}" class="btn btn-sm btn-cyan">Approve</a>--}}
                                                        {{--<a href="{{route('leave.pending',$leave->id)}}" class="btn btn-sm btn-warning">Pending</a>--}}
                                                        {{--<a href="{{route('leave.reject',$leave->id)}}" class="btn btn-sm btn-danger">Reject</a>--}}
                                                         -->
                                                         
                                                        @if($leave->is_approved==0)
                                                        <form id="approve-leave-{{$leave->id}}" action="{{route('leave.approve',$leave->id)}}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="approve"  value="1">
                                                            <input type="hidden" name="approve_comment" id="approve_comment" value="">
                                                            <button type="button" onclick="approveLeave({{$leave->id}})" class="btn btn-sm btn-cyan" name="approvebtn">Approve</button>
                                                        </form>
                                                        <form id="reject-leave-{{$leave->id}}" action="{{route('leave.approve',$leave->id)}}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="approve"  value="2">
                                                            <input type="hidden" name="approve_comment" id="reject_comment" value="">
                                                            <button type="button" onclick="rejectLeave({{$leave->id}})" class="btn btn-sm btn-danger" name="approve">Reject</button>
                                                        </form>
                                                        @elseif($leave->is_approved==1)
                                                        <form id="reject-leave-{{$leave->id}}" action="{{route('leave.approve',$leave->id)}}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="approve"  value="3">
                                                            <input type="hidden" name="approve_comment" id="reject_comment" value="">
                                                            <button type="button" onclick="rejectLeave({{$leave->id}})" class="btn btn-sm btn-danger" name="approve">Reject</button>
                                                        </form>
                                                        @else
                                                        <form id="approve-leave-{{$leave->id}}" action="{{route('leave.approve',$leave->id)}}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="approve"  value="1">
                                                            <input type="hidden" name="approve_comment" id="approve_comment" value="">
                                                            <button type="button" onclick="approveLeave({{$leave->id}})" class="btn btn-sm btn-cyan" name="approvebtn">Approve</button>
                                                        </form>
                                                        @endif
                                                        
                                                        @if($leave->up_file != "")
                                                        <a href="{{ asset('uploads/prescription/' . $leave->up_file) }}" class="btn btn-sm btn-info" target="_blank" >View File</a>
                                                        @endif
                                                        
                                                    @else
                                                        @if($leave->is_approved==0)
                                                        <a href="{{route('leave.edit',$leave->id)}}" class="btn btn-sm btn-dark">Edit</a>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                    {{ $leaves->links() }}
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
<!--{{--sweetalert box for deleting start--}}-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.8/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
    function rejectLeave(id)
    {
        const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
        });

        swalWithBootstrapButtons({
            title: 'Are you sure?',
            text: "You won't to reject leave!",
            type: 'warning',
            input: 'text',
            inputPlaceholder: "Write something",
            inputValidator: (value) => {
                if (!value) {
                  return 'You need to write something!'
                }
            },
            showCancelButton: true,
            confirmButtonText: 'Yes, reject it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('reject_comment').value = result.value;      
                document.getElementById('reject-leave-'+id).submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                    'Cancelled',
                    'You have not cancel yet ! Your are safe :)',
                    'error'
                )
            }
        })
    }

    function approveLeave(id)
    {
        const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
        });

        swalWithBootstrapButtons({
            title: 'Are you sure?',
            input: 'text',
            inputPlaceholder: "Write something",
            inputValidator: (value) => {
                if (!value) {
                  return 'You need to write something!'
                }
            },
            text: "You want to approve leave!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, approve leave!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('approve_comment').value = result.value;       
                document.getElementById('approve-leave-'+id).submit();
            } 
            else if (
                //Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                    'Cancelled',
                    'You are safe.You can approve later :)',
                    'error'
                );
            }
        });
    }
</script>
@endsection