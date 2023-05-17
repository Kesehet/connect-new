@extends('admin.layout.master')

@section('content')

    <div id="main-wrapper">

        @include('admin.includes.sidebar')

        <div class="page-wrapper">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Holiday List</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('download.holidaylist')}}">Holiday List</a></li>
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
                            <embed src="{{ url(asset($holiday_list)) }}" style="width:1070px; height:600px;" frameborder="0">
                            @endif
                            @if ($fileshowflag == 'NO')
                            <h4 class="card-title" style="text-align: center;height: 200px; padding-top: 103px;">No Holiday List Found</h4>
                            @endif
                            <!--<style type="text/css">
                            #myiframe {width:1070px; height:480px;} 
                            </style>
                            <iframe name="myiframe" id="myiframe" src="{{ asset('uploads/holidaylist/Thinknyx_India_Holiday List_2020.pdf') }}">-->
                            
                             
                        </div>
                    </div>
                </div>
              
            </div>


           @include('admin.includes.footer')   
        </div>
        </div>
    </div>

    @endsection