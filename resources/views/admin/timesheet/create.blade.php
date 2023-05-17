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

            <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Timesheet Management</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('timesheet.create')}}">Timesheet</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">

            
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <form action="{{route('timesheet.store')}}" id="timesheet-form" method="post" class="form-horizontal">
                            @csrf
                            <div class="card-body">
                                <h4 class="card-title">Timesheet</h4>
                                
                                @can('isAdmin')
                                <div class="form-group required row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">User Id</label>
                                    <div class="col-sm-4">
                                        <select type="text" name="userid" class="form-control" id="userid" placeholder="Select User" required="required">
                                            <option value="">-Select User-</option>
                                            @foreach ($userlist as $key => $value)
                                            <option value="{{ $key }}" {{ (Request::get('userid') == $key)? 'selected' : '' }}> {{ $value }} </option>
                                            @endforeach    
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group required row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Timesheet Date</label>
                                    <div class="col-sm-4">
                                        <input type="date"  name="timesheet_date" class="form-control" id="timesheetdate" required="required">
                                    </div>
                                </div>
                                @endcan
                                
                                 @canany(['isEmployee', 'isManager']) 
                                <div class="form-group required row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Timesheet Date</label>
                                    <div class="col-sm-4">
                                        <input type="date" max="{{ date('Y-m-d') }}"  min="{{ now()->subDays(7)->format('Y-m-d') }}"  placeholder="yyyy-mm-dd"   data-date='{"startView": 2, "openOnMouseFocus": true}' name="timesheet_date" class="form-control" id="timesheetdate" required="required">
                                    </div>
                                </div>
                                @endcanany
                                
                                 
                                    <div class="form-group required row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Timesheet Time</label>
                                        <div class="col-sm-4">
                                            <input type="number" name="hours[]" class="form-control hr" id="hours" placeholder="Hours" step="1" min="0" max="12" required="required">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="number" name="mintus[]" class="form-control min" id="mintus" placeholder="Minutes" step="10" min="0" max="50" required="required">
                                        </div>
                                    </div>
                                    <div class="form-group required row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Description</label>
                                        <div class="col-sm-6">
                                            <textarea type="text" name="comments[]" class="form-control" placeholder="Description" required></textarea>
                                        </div>
                                    </div> 
                                   <div class="after-add-more"></div>
                            </div>
                            
                            <div class="border-top">
                                <div class="card-body">
                                    
                                    <button type="submit" id="submit_handle"  style="display: none" class="btn btn-dark">Not Show</button>
                                    
                                    <button type="button" onclick="submitTimesheet()" class="btn btn-dark">Submit</button>
                                    
                                    
                                    <button class="btn btn-success add-more" type="button" style="float: right;"><i class="glyphicon glyphicon-plus"></i> Add More</button>
                                </div>
                            </div>
                        </form>
                        
                        <div class="copy hide">
                            <div class="control-group-only"><hr>
                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Timesheet Time</label>
                                    <div class="col-sm-4">
                                        <input type="number" name="hours[]" class="form-control hr" id="hours" placeholder="Hours" step="1" min="0" max="12" required="required">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="number" name="mintus[]" class="form-control min" id="mintus" placeholder="Minutes" step="10" min="0" max="50" required="required">
                                    </div>
                                </div>
                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Description</label>
                                    <div class="col-sm-6">
                                        <textarea type="text" name="comments[]" class="form-control" placeholder="Description" required></textarea>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group-btn" style="margin-top: 22px;"> 
                                            <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                         </div>
                                    </div>
                                </div> 

                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            
            
        </div>
          
            
        @include('admin.includes.footer')   
        

    </div>

@endsection

@section('js')

<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.8/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

      $(".add-more").click(function(){ 
          var html = $(".copy").html();
          $(".after-add-more").before(html);
      });

      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group-only").remove();
      });
      
       webshims.setOptions('forms-ext', {types: 'date'});
       webshims.polyfill('forms forms-ext');
        $.webshims.formcfg = {
        en: {
            dFormat: '-',
            dateSigns: '-',
            patterns: {
                d: "dd-mm-yy"
            }
        }
        };

    });

        function submitTimesheet()
        {
           
            const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-lg btn-warning',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            });
            
            var totalmin = 0;
            $('.hr').each(function() {
                if($(this).val() > 0){
                  totalmin = (parseInt(totalmin) +  parseInt($(this).val()*60));  
                }
            });
            
            $('.min').each(function() {
                if($(this).val() > 0){
                  totalmin = (parseInt(totalmin) + parseInt($(this).val()));  
                }
            });
            if(totalmin > 1440){
                swalWithBootstrapButtons("Alert!", "Total Time should not more then 24 hours!","warning","warning"); 
            }else{
                event.preventDefault();
                $('#submit_handle').click();
            }
           
        }


</script>

@endsection