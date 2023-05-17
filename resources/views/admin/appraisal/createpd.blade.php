@extends('admin.layout.master')

@section('content')

<div class="page-wrapper">

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Professional Development Plan Goal</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Appraisal</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        
        @if(@$goal->id  > 0)

        <form action="{{route('appraisal.storefun')}}" method="post" class="form-horizontal">
            @csrf
            <input type="hidden" name="uid" class="form-control" id="uid" placeholder="Hidden" value="{{ Request::get('uid') }}">
            <input type="hidden" name="order_no" class="form-control" id="order_no" placeholder="Hidden" value="{{  $goal->order_no }}">
            <div class="row">
                <div class="col-md-12">
                    

                    <div class="card">
                        <div class="card-body">
                            <div class="d-md-flex align-items-center">
                                <div>
                                    <h4 class="card-title">{{ $goal->title ?? '' }}</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="calendar">
                                        <div class="table-responsive">
                                            {!!  @nl2br($goal->description ?? '') !!}
                                            <input type="hidden" name="goal_id" class="form-control" id="goal_id" placeholder="Hidden" value="{{  $goal->id }}">
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>



                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-md-flex align-items-center">
                                <div>
                                    <h4 class="card-title">User Comments</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group required row">

                                        <div class="col-sm-11">
                                            @if(Request::get('uid') > 0)
                                            {{ $appraisal->user_comment ?? '' }}
                                            @else
                                            @if(@$appraisal->status == 0) 
                                            <textarea type="text" name="user_comment" class="form-control" placeholder="Description" required="">{{ $appraisal->user_comment ?? '' }}</textarea>
                                            @else
                                            {{ $appraisal->user_comment ?? '' }}
                                            @endif
                                            @endif
                                        </div>
                                    </div>

                                </div>


                            </div>


                           @if(Request::get('uid') > 0)
                            @if(@$appraisal->id > 0)
                            <div class="d-md-flex align-items-center">
                                <div>
                                    <h4 class="card-title">Manager Comments</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group required row">
                                        <div class="col-sm-11">
                                            @if(@$appraisal->status >= 3) 
                                            {{ $appraisal->manager_comment ?? '' }}
                                            @else
                                            <textarea type="text" name="manager_comment" class="form-control" placeholder="Description" required="">{{ $appraisal->manager_comment ?? '' }}</textarea>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <input class="form-check-input" type="hidden" name="rating" id="rating"  value="0">
                            @endif
                            @else
                            @if(@$appraisal->status >= 2) 
                            <div class="d-md-flex align-items-center">
                                <div>
                                    <h4 class="card-title">Manager Comments</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group required row">
                                        <div class="col-sm-11">
                                            {{ $appraisal->manager_comment ?? '' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @endif
                            @endif



                        </div>

                        <div class="border-top">
                            <div class="card-body" style="float: right;">
                                
                                @if(@$appraisal->status < 2 && @$goal->id > 0)
                                 <input type="hidden" name="submit" value="submitpd">
                                <button type="submit" class="btn btn-success"  name="submit"  value="submitpd">Save</button>
                                @endif

                                @if(Request::get('uid') > 0)
                                <!--<a class="btn btn-success" type="button" style="float: right;" href="{{route('appraisal.createfunthree','uid='.Request::get('uid'))}}"><i class="glyphicon glyphicon-plus"></i> Next</a>
                                <a class="btn btn-success" type="button" style="float: right; margin-right: 7px;" href="{{route('appraisal.createfunone','uid='.Request::get('uid'))}}"><i class="glyphicon glyphicon-plus"></i> Back</a>-->
                                
                                @if(@$appraisal->status != 0) 
                                @endif
                                <a class="btn btn-success" type="button" style="float: right; margin-left: 5px;" href="{{route('appraisal.createfun','uid='.Request::get('uid'))}}"><i class="glyphicon glyphicon-plus"></i> Go to functional</a>
                                <a class="btn btn-success" type="button" style="float: right; margin-left: 5px;" href="{{route('appraisal.create','uid='.Request::get('uid'))}}"><i class="glyphicon glyphicon-plus"></i> Go to organizational</a>
                                
                                
                                @else
                                <!--<a class="btn btn-success" type="button" style="float: right;" href="{{route('appraisal.createfunthree')}}"><i class="glyphicon glyphicon-plus"></i> Next</a>
                                <a class="btn btn-success" type="button" style="float: right; margin-right: 7px;" href="{{route('appraisal.createfunone')}}"><i class="glyphicon glyphicon-plus"></i> Back</a>-->
                                
                                @if(@$appraisal->status != 0) 
                                @endif
                                <a class="btn btn-success" type="button" style="float: right; margin-left: 5px;" href="{{route('appraisal.createfun')}}"><i class="glyphicon glyphicon-plus"></i> Go to functional</a>
                                <a class="btn btn-success" type="button" style="float: right; margin-left: 5px;" href="{{route('appraisal.create')}}"><i class="glyphicon glyphicon-plus"></i> Go to organizational</a>
                                
                                
                                @endif

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </form>
        

       @else

        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">

                        <div class="form-group  row">
                            <div class="col-12">
                                <h4 class="card-title">No PDP goal have been added yet</h4> 
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-top" style="margin-bottom: 10px;">
                        <div class="card-body">
                            <a class="btn btn-success" type="button" style="float: right; margin-left: 5px;" href="{{ URL::previous() }}"><i class="glyphicon glyphicon-plus"></i> Back</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @endif




    </div> 

    @include('admin.includes.footer')   
</div>

@endsection


