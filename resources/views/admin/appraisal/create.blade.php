@extends('admin.layout.master')

@section('content')

<div class="page-wrapper">

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Organizational Goals</h4>
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

<?php 

?>

    <div class="container-fluid">
        
        @if($fungoalcnt  >= 5 && isset($goal->order_no))

        <form action="{{route('appraisal.store')}}" method="post" class="form-horizontal">
            @csrf

            @if(Request::get('uid') > 0) 
            <input type="hidden" name="uid" class="form-control" id="uid" placeholder="Hidden" value="{{ Request::get('uid') }}">
            @endif

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

                                                    @if(Request::get('uid') > 0)

                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li role="presentation" class="{{ (in_array(1, $goalappcombArr) ? 'active' : 'disabled') }}">
                                                            <a href="{{route('appraisal.create','uid='.Request::get('uid'))}}" data-toggle="{{ ($goal->order_no == 1 ? 'tab' : '') }}" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">1 </span> <i>Goal 1</i></a>
                                                        </li>
                                                        <li role="presentation" class="{{ (in_array(2, $goalappcombArr) ? 'active' : 'disabled') }}" >
                                                            <a href="{{route('appraisal.createorone','uid='.Request::get('uid'))}}" data-toggle="{{ ($goal->order_no == 2 ? 'tab' : '') }}" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">2</span> <i>Goal 2</i></a>
                                                        </li>
                                                        <li role="presentation" class="{{ (in_array(3, $goalappcombArr) ? 'active' : 'disabled') }}">
                                                            <a href="{{route('appraisal.createortwo','uid='.Request::get('uid'))}}" data-toggle="{{ ($goal->order_no == 3 ? 'tab' : '') }}" aria-controls="step3" role="tab"><span class="round-tab">3</span> <i>Goal 3</i></a>
                                                        </li>
                                                        <li role="presentation" class="{{ (in_array(4, $goalappcombArr) ? 'active' : 'disabled') }}">
                                                            <a href="{{route('appraisal.createorthree','uid='.Request::get('uid'))}}" data-toggle="{{ ($goal->order_no == 4 ? 'tab' : '') }}" aria-controls="step4" role="tab"><span class="round-tab">4</span> <i>Goal 4</i></a>
                                                        </li>
                                                        <li role="presentation" class="{{ (in_array(5, $goalappcombArr) ? 'active' : 'disabled') }}">
                                                            <a href="{{route('appraisal.createorfour','uid='.Request::get('uid'))}}"  data-toggle="{{ ($goal->order_no == 5 ? 'tab' : '') }}" aria-controls="step5" role="tab"><span class="round-tab">5</span> <i>Goal 5</i></a>
                                                        </li>
                                                    </ul>

                                                    @else
                                                    
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li role="presentation" class="{{ (in_array(1, $goalappcombArr) ? 'active' : 'disabled') }}">
                                                            <a href="{{route('appraisal.create')}}" data-toggle="{{ ($goal->order_no == 1 ? 'tab' : '') }}" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">1 </span> <i>Goal 1</i></a>
                                                        </li>
                                                        <li role="presentation" class="{{ (in_array(2, $goalappcombArr) ? 'active' : 'disabled') }}" >
                                                            <a href="{{route('appraisal.createorone')}}" data-toggle="{{ ($goal->order_no == 2 ? 'tab' : '') }}" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">2</span> <i>Goal 2</i></a>
                                                        </li>
                                                        <li role="presentation" class="{{ (in_array(3, $goalappcombArr) ? 'active' : 'disabled') }}">
                                                            <a href="{{route('appraisal.createortwo')}}" data-toggle="{{ ($goal->order_no == 3 ? 'tab' : '') }}" aria-controls="step3" role="tab"><span class="round-tab">3</span> <i>Goal 3</i></a>
                                                        </li>
                                                        <li role="presentation" class="{{ (in_array(4, $goalappcombArr) ? 'active' : 'disabled') }}">
                                                            <a href="{{route('appraisal.createorthree')}}" data-toggle="{{ ($goal->order_no == 4 ? 'tab' : '') }}" aria-controls="step4" role="tab"><span class="round-tab">4</span> <i>Goal 4</i></a>
                                                        </li>
                                                        <li role="presentation" class="{{ (in_array(5, $goalappcombArr) ? 'active' : 'disabled') }}">
                                                            <a href="{{route('appraisal.createorfour')}}"  data-toggle="{{ ($goal->order_no == 5 ? 'tab' : '') }}" aria-controls="step5" role="tab"><span class="round-tab">5</span> <i>Goal 5</i></a>
                                                        </li>
                                                    </ul>
                                                    @endif


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
                                            
                                            @can('isAdmin') 
                                            @endcan
                                            @can('isEmployee')
                                            @endcan
                                            
                                            
                                        </div>
                                    </div>

                                </div>
                            </div>

                            @if(Request::get('uid') > 0)
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
                                            <textarea type="text" name="manager_comment" class="form-control" placeholder="Description" required>{{ $appraisal->manager_comment ?? '' }}</textarea>
                                            @endif
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

                                            @if(@$appraisal->status >= 3) 
                                            {{ $appraisal->rating ?? '' }}
                                            @else

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="rating" id="inlineRadio1" required value="1" {{ @$appraisal->rating == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">1</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="rating" id="inlineRadio2" required value="2" {{ @$appraisal->rating == 2 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">2</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="rating" id="inlineRadio2" required value="3" {{ @$appraisal->rating == 3 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">3</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="rating" id="inlineRadio2" required value="4" {{ @$appraisal->rating == 4 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">4</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="rating" id="inlineRadio2" required value="5" {{ @$appraisal->rating == 5 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">5</label>
                                            </div> 
                                            @endif
                                            <div class="invalid-feedback" style="display: block;">Hints: Outstanding - 5, Exceeds - 4, Meets Expectations - 3, Need Improvement - 2, Unsatisfactory - 1 </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endif


                            @if(Request::get('uid') > 0)
                            @if(@$appraisal->status >= 3) 
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
                            <div class="d-md-flex align-items-center">
                                <div>
                                    <h4 class="card-title">Ratings</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group required row">
                                        <div class="col-sm-11">
                                            {{ $appraisal->rating ?? '' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endif









                        </div>


                        <div class="border-top">

                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <div class="card-body">

                                            <!--<button type="submit" class="btn btn-dark" name="submit">Submit</button>-->
                                            <!-- Button trigger modal -->

                                            @canany(['isAdmin', 'isManager']) 
                                            @if($appraisalcnt >=10 && @$appraisal->status == 2) 
                                            <button type="button" class="btn btn-dark" name="button" data-toggle="modal" data-target="#ModalCenterTwo">Submit</button>
                                            @else
                                            <button type="button" class="btn btn-dark" name="button" data-toggle="modal" disabled="disabled">Submit</button>
                                            @endif
                                            @endcanany

                                            @canany(['isEmployee']) 
                                            
                                            @if($appraisalcnt >=10 && @$appraisal->status == 0) 
                                            <button type="button" class="btn btn-dark" name="button" data-toggle="modal" data-target="#ModalCenterOne">Submit</button>
                                            @else
                                             <button type="button" class="btn btn-dark" name="button" data-toggle="modal" disabled="disabled">Submit</button>
                                            @endif
                                            
                                            @if($appraisalcnt >=10 && @$appraisal->status == 3) 
                                            <button type="button" class="btn btn-dark" name="button" data-toggle="modal" data-target="#ModalCenterThree">Accept</button>
                                            <button type="button" class="btn btn-dark" name="button" data-toggle="modal" data-target="#ModalCenterFour">Return</button>
                                            @else
                                             <button type="button" class="btn btn-dark" name="button" data-toggle="modal" disabled="disabled">Accept</button>
                                             <button type="button" class="btn btn-dark" name="button" data-toggle="modal" disabled="disabled">Return</button>
                                            @endif
                                                       
                                            @endcanany




                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="card-body" style="float: right;">



                                            @if(Request::get('uid') > 0)

                                            <!--<a class="btn btn-success" type="button" style="float: right;" href="{{route('appraisal.createortwo','uid='.Request::get('uid'))}}"><i class="glyphicon glyphicon-plus"></i> Next</a>
                                            <a class="btn btn-success" type="button" style="float: right; margin-right: 7px;" href="{{route('appraisal.create','uid='.Request::get('uid'))}}"><i class="glyphicon glyphicon-plus"></i> Back</a>-->

                                            @if(@$appraisal->status == 3 || @$appraisal->status == 4 || @$appraisal->status == 2)
                                            @endif
                                            <a class="btn btn-success" type="button" style="float: right; margin-left: 5px;" href="{{route('appraisal.createfun','uid='.Request::get('uid'))}}"><i class="glyphicon glyphicon-plus"></i> Go to Functional</a>
                                            <a class="btn btn-success" type="button" style="float: right; margin-left: 5px;" href="{{route('appraisal.createpd','uid='.Request::get('uid'))}}"><i class="glyphicon glyphicon-plus"></i> Go to PDP</a>
                                            
                                            
                                            
                                            @if(@$appraisal->status == 1 || @$appraisal->status == 2 || @$appraisal->status == 0) 
                                            <button type="submit" class="btn btn-success"  name="submit" value="back">Back</button>
                                            <button type="submit" class="btn btn-success"  name="submit" value="next">Next</button>
                                            @endif
                                           
                                            
                                            @else
                                            <!--<a class="btn btn-success" type="button" style="float: right;" href="{{route('appraisal.createortwo')}}"><i class="glyphicon glyphicon-plus"></i> Next</a>
                                            <a class="btn btn-success" type="button" style="float: right; margin-right: 7px;" href="{{route('appraisal.create')}}"><i class="glyphicon glyphicon-plus"></i> Back</a>-->
                                            @if(@$appraisal->status != 0) 
                                            @endif
                                            <a class="btn btn-success" type="button" style="float: right; margin-left: 5px;" href="{{route('appraisal.createfun')}}"><i class="glyphicon glyphicon-plus"></i> Go to Functional</a>
                                            <a class="btn btn-success" type="button" style="float: right; margin-left: 5px;" href="{{route('appraisal.createpd')}}"><i class="glyphicon glyphicon-plus"></i> Go to PDP</a>
                                            
                                            
                                            @if(@$appraisal->status == 0) 
                                            @if($goal->order_no != 1)
                                            <button type="submit" class="btn btn-success"  name="submit" value="back">Back</button>
                                            @endif
                                            
                                            <button type="submit" class="btn btn-success"  name="submit" value="next">Next</button>
                                            @endif
                                            

                                            @endif

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
        <div class="modal fade" id="ModalCenterOne" tabindex="-1" role="dialog" aria-labelledby="ModalCenterOneTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Alert Box</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Please review your appraisals before submission. After submission you will not be able to amend it.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a  class="btn btn-primary" href="{{route('appraisal.finalappsubmit','sts=1')}}">Save Changes</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end here -->


        <!-- Modal ModalCenterTwo -->
        <div class="modal fade" id="ModalCenterTwo" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTwoTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Alert Box</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Please review appraisal before submission. After submission you will not be able to amend it.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a  class="btn btn-primary" href="{{route('appraisal.finalappsubmit','uid='.Request::get('uid').'&sts=3')}}">Save Changes</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end here -->
        
        
        <!-- Modal ModalCenterThree -->
        <div class="modal fade" id="ModalCenterThree" tabindex="-1" role="dialog" aria-labelledby="ModalCenterThreeTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Alert Box</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure, you want to accept the appraisal?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a  class="btn btn-primary" href="{{route('appraisal.finalappsubmit','uid='.Request::get('uid').'&sts=4')}}">Save Changes</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end here -->
        
        
        <!-- Modal ModalCenterFour -->
        <div class="modal fade" id="ModalCenterFour" tabindex="-1" role="dialog" aria-labelledby="ModalCenterFourTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Alert Box</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure, you want to return the appraisal?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a  class="btn btn-primary" href="{{route('appraisal.finalappsubmit','uid='.Request::get('uid').'&sts=2')}}">Save Changes</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end here -->
        
        
        @else

        <div class="row">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-body">

                        <div class="form-group  row">
                            <div class="col-12">
                                <h4 class="card-title">No goals have been added yet</h4> 
                            </div>
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

@section('js')



@endsection
