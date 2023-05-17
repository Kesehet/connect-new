@extends('admin.layout.master')

@section('content')

    <div id="main-wrapper">

        @include('admin.includes.sidebar')

        <div class="page-wrapper">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Company Policy</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('download.companypolicy')}}">Company Policy</a></li>
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
                             @if ($fileshowflag == 'YES')
                             - Company Policy
                            <embed src="{{ url(asset($company_policy)) }}" style="width:1070px; height:600px;" frameborder="0">
                            - Exit Policy
                            <embed src="https://connect.thinknyx.com/public/uploads/companypolicy/Thinknyx_Employee Handbook_Exit_Policy_2022_V1.2.pdf#navpanes=0" style="width:1070px; height:600px;" frameborder="0">
                            - Employee Referral Policy
                            <embed src="https://connect.thinknyx.com/public/uploads/companypolicy/Thinknyx_Employee Handbook_Employee Referral Policy 2022.pdf" style="width:1070px; height:600px;" frameborder="0">
                            @endif
                            @if ($fileshowflag == 'NO')
                            <h4 class="card-title" style="text-align: center;height: 200px; padding-top: 103px;">No Company Policy Found</h4>
                            @endif
                            <!--<style type="text/css">
                            #myiframenew {width:1070px; height:480px;} 
                            </style>
                            <iframe name="myiframenew" id="myiframe" src="{{ asset('uploads/companypolicy/Thinknyx_Employee Handbook_Leave_Policy_2020_v1.pdf') }}">-->
                             
                        </div>
                    </div>
                </div>

                
            </div>

                

               

            @include('admin.includes.footer')   
        </div>
        </div>
    </div>

    @endsection