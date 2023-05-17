<!DOCTYPE html>
<html>
    <head>
        <title>Thinknyx Connect</title>
    </head>
    <body>
        <table cellpadding="0" cellspacing="0" style="max-width: 602px; width: 100%;" align="center">
            <tr>
                <td style="padding: 15px;" align="center" valign="middle">
                    <a href="#"><img src="https://thinknyx.com/wp-content/uploads/2020/03/logo_thinknyx.png" width="200px" height="48px"></a>
                </td>
            </tr>
        </table>
        
        <h1>{{ $title }} FY {{ $fy_year }}</h1>
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
                                <div class="col-lg-12">
                                    <div id="calendar">
                                        <div class="table-responsive">
                                            {!!  $avgRating ?? '' !!}
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
                            <div class="row border-bottom" style="border-bottom: 1px solid #dee2e6!important;">
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <div class="col-sm-11">
                                            <b>RATING :</b>
                                            {{ $appraisal->rating ?? '' }}
                                        </div>
                                    </div>

                                </div><br>
                            </div>
                            @endif
                          @endforeach

                        </div>
                    </div>

                    @else

                    <div class="card">
                        <div class="card-body">
                            <div class="d-md-flex align-items-center">
                                <div>
                                    <h4 class="card-title">Thank you for submitting your appraisal</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif

                </div>
            </div>

        </div> 
        
        
        

    </body>
</html>