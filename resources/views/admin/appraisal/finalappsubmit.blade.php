@extends('admin.layout.master')

@section('content')

<div class="page-wrapper">

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Summary FY {{ $fy_year }}</h4>
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


        <div class="row">
            <div class="col-md-12">


                @if($appraisalcnt >= 10)

                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Final Performance Rating</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-10">
                                <div id="calendar">
                                    <div class="table-responsive">
                                        {!!  $avgRating ?? '' !!}
                                        <div class="invalid-feedback" style="display: block;">Hints: Outstanding - 5, Exceeds - 4, Meets Expectations - 3, Need Improvement - 2, Unsatisfactory - 1 </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-2">
                                @if(Request::get('uid') > 0)
                                <a class="btn btn-success downloadData"  type="button" style="float: right; margin-left: 5px;" href="{{route('appraisal.generatepdf','uid='.Request::get('uid'))}}"><i class="glyphicon glyphicon-plus"></i>Print pdf</a>
                                @else
                                <a class="btn btn-success downloadData"  type="button" style="float: right; margin-left: 5px;" href="{{route('appraisal.generatepdf')}}"><i class="glyphicon glyphicon-plus"></i>Print pdf</a>
                                @endif
                            </div>
                        </div>
                       
                    </div>
                    
                    <div class="border-top">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <div class="card-body">
                                       @canany(['isAdmin', 'isManager', 'isEmployee']) 
                                        @if($appraisalcnt >=10 && @$appraisals[0]->status == 3) 
                                        <button type="button" class="btn btn-dark" name="button" data-toggle="modal" data-target="#ModalCenterThree">Accept</button>
                                        <button type="button" class="btn btn-dark" name="button" data-toggle="modal" data-target="#ModalCenterFour">Return</button>
                                        @else
                                        <button type="button" class="btn btn-dark" name="button" data-toggle="modal" disabled="disabled">Accept</button>
                                        <button type="button" class="btn btn-dark" name="button" data-toggle="modal" disabled="disabled">Return</button>
                                        @endif
                                        @endcanany
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>


                <div class="card">
                    <div class="card-body">

                        @foreach($appraisals as $appraisal)
                        <div class="d-md-flex align-items-center" style="margin-top: 10px;">
                            <div>
                                <h4 class="card-title">{{ $appraisal->title ?? '' }}</h4>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <b>DESCRIPTION :</b> {!!  @nl2br($appraisal->description ?? '') !!}
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <b>USER COMMENTS :</b>
                                    {{ $appraisal->user_comment ?? '' }}
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-lg-12">

                                <div class="table-responsive">
                                    <b>MANAGER COMMENTS :</b>
                                    {{ $appraisal->manager_comment ?? '' }}
                                </div>


                            </div>
                        </div>
                        @if($appraisal->goal_type != 3) 
                        <div class="row border-bottom">
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <div class="col-sm-11">
                                        <b>RATING :</b>
                                        {{ $appraisal->rating ?? '' }}
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endif


                        @endforeach
                        

                    </div>
                </div>
                
                
                
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

                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                @if(session()->has('sts'))
                                @if(Session::get('sts') == 2)
                                <h4 class="card-title"> Your appraisal has been returned</h4>
                                @elseif(Session::get('sts') == 4)
                                <h4 class="card-title">Thank you for accepting your appraisal</h4>
                                @else
                                <h4 class="card-title">Thank you for submitting your appraisal</h4>
                                @endif
                                @else 
                                <script>window.location = "create";</script>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @endif
                {{Session::forget('sts') }}


            </div>
        </div>



    </div> 

    @include('admin.includes.footer')   
</div>

@endsection

@section('js')
<script type="text/javascript">
    $(function(){
        $('.downloadData').on('click', function () {
             setInterval(function(){
               $('.downloadData').text("Print pdf").removeClass('disabled');  
             }, 10000);
        });
    });
</script>
@endsection
