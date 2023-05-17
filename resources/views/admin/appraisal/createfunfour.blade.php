@extends('admin.layout.master')

@section('content')

<div class="page-wrapper">

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Functional Goals</h4>
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

        <form action="{{route('appraisal.storefun')}}" method="post" class="form-horizontal">
            @csrf
            <input type="hidden" name="uid" class="form-control" id="uid" placeholder="Hidden" value="{{ Request::get('uid') }}">
            <input type="hidden" name="order_no" class="form-control" id="order_no" placeholder="Hidden" value="{{  $goal->order_no }}">
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-body">
                            <section class="signup-step-container">
                                <div class="container">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-12">
                                            <div class="wizard">
                                                <div class="wizard-inner">
                                                    <div class="connecting-line"></div>
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li role="presentation" class="{{ (in_array(1, $goalappcombArr) ? 'active' : 'disabled') }}">
                                                            <a href="{{route('appraisal.createfun')}}"  aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">1 </span> <i>Goal 1</i></a>
                                                        </li>
                                                        <li role="presentation" class="{{ (in_array(2, $goalappcombArr) ? 'active' : 'disabled') }}" >
                                                            <a href="{{route('appraisal.createfunone')}}"  aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">2</span> <i>Goal 2</i></a>
                                                        </li>
                                                        <li role="presentation" class="{{ (in_array(3, $goalappcombArr) ? 'active' : 'disabled') }}">
                                                            <a href="{{route('appraisal.createfuntwo')}}"  aria-controls="step3" role="tab"><span class="round-tab">3</span> <i>Goal 3</i></a>
                                                        </li>
                                                        <li role="presentation" class="{{ (in_array(4, $goalappcombArr) ? 'active' : 'disabled') }}">
                                                            <a href="{{route('appraisal.createfunthree')}}"  aria-controls="step4" role="tab"><span class="round-tab">4</span> <i>Goal 4</i></a>
                                                        </li>
                                                        <li role="presentation" class="{{ (in_array(5, $goalappcombArr) ? 'active' : 'disabled') }}">
                                                            <a href="{{route('appraisal.createfunfour')}}" data-toggle="tab" aria-controls="step5" role="tab"><span class="round-tab">5</span> <i>Goal 5</i></a>
                                                        </li>
                                                    </ul>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

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
                                            <input type="hidden" name="goal_id" class="form-control" id="goal_id" placeholder="Hidden" value="{{ $goal->id }}">
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
                                            @can('isAdmin') 
                                            <textarea type="text" name="user_comment" class="form-control" placeholder="Description" disabled="" >{{ $appraisal->user_comment ?? '' }}</textarea>
                                            @endcan
                                            @can('isEmployee')
                                            <textarea type="text" name="user_comment" class="form-control" placeholder="Description" required="">{{ $appraisal->user_comment ?? '' }}</textarea>
                                            @endcan
                                        </div>
                                    </div>

                                </div>


                            </div>


                            @can('isAdmin') 
                            <div class="d-md-flex align-items-center">
                                <div>
                                    <h4 class="card-title">Manager Comments</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group required row">
                                        <div class="col-sm-11">
                                            <textarea type="text" name="manager_comment" class="form-control" placeholder="Description" required="">{{ $appraisal->manager_comment ?? '' }}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="d-md-flex align-items-center">
                                <div>
                                    <h4 class="card-title">Ratings</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group required row">
                                        <div class="col-sm-11">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="rating" id="inlineRadio1" value="1" {{ $appraisal->rating == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">1</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="rating" id="inlineRadio2" value="2" {{ $appraisal->rating == 2 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">2</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="rating" id="inlineRadio2" value="3" {{ $appraisal->rating == 3 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">3</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="rating" id="inlineRadio2" value="4" {{ $appraisal->rating == 4 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">4</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="rating" id="inlineRadio2" value="5" {{ $appraisal->rating == 5 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">5</label>
                                            </div>  

                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endcan



                        </div>

                        <div class="border-top">
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="card-body">
                                            <!--<button type="submit" class="btn btn-dark" name="submit">Submit</button>-->
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-dark" name="button" data-toggle="modal" data-target="#exampleModalCenter">Submit</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card-body" style="float: right;">
                                            @can('isAdmin')
                                            <a class="btn btn-success" type="button" style="float: right; margin-right: 7px;" href="{{route('appraisal.createfunthree','uid='.Request::get('uid'))}}"><i class="glyphicon glyphicon-plus"></i> Back</a>
                                            @endcan
                                            @can('isEmployee')
                                            <!--<a class="btn btn-success" type="button" style="float: right; margin-right: 7px;" href="{{route('appraisal.createfunthree')}}"><i class="glyphicon glyphicon-plus"></i> Back</a>-->
                                            <button type="submit" class="btn btn-success"  name="submit" value="back">Back</button>
                                            <button type="submit" class="btn btn-success"  name="submit" value="next">Save</button>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </form>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Alert Box</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Please review your data before submit. After submit you will not able to change it ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a  class="btn btn-primary" href="{{route('appraisal.finalappsubmit')}}">Save Changes</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end here -->



    </div> 

    @include('admin.includes.footer')   
</div>

@endsection

@section('js')

<script src="{{asset('admin-panel/assets/libs/flot/excanvas.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/flot/jquery.flot.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/flot/jquery.flot.pie.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/flot/jquery.flot.time.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/flot/jquery.flot.stack.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/flot/jquery.flot.crosshair.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script>
<script src="{{asset('admin-panel/dist/js/pages/chart/chart-page-init.js')}}"></script>

<script src="{{asset('admin-panel/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('admin-panel/dist/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin-panel/dist/js/custom.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/moment/min/moment.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<script src="{{asset('admin-panel/dist/js/pages/calendar/cal-init.js')}}"></script>

@endsection
