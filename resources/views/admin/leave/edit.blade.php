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
                <div class="col-md-10">
                    <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Leave  Summary</h4>
                                <div class="row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Total Leaves:</label>
                                    <div class="col-sm-9" style="line-height: 2.5;"><strong>{{$TotalLeaves}}</strong></div>
                                </div>
                                <div class="row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Taken Leaves:</label>
                                    <div class="col-sm-9" style="line-height: 2.5;"><strong>{{$TakenLeaves}}</strong></div>
                                </div>
                                <div class="row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Balance Leaves:</label>
                                    <div class="col-sm-9" style="line-height: 2.5;"><strong>{{$BalanceLeaves}}</strong></div>
                                </div>
                                
                            </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <form action="{{route('leave.update',$leave->id)}}" method="post" class="form-horizontal">
                            @csrf
                            <div class="card-body">
                                <h4 class="card-title">Update Leave</h4>
                                 <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Leave type</label>
                                    <div class="col-sm-9">
                                       
                                        <select type="text" name="leave_type" class="form-control" id="leave_type" value="" required="required">
                                            <option>{{$leave->leave_type}}</option>
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
                                </div>
                                <div class="form-group required row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Date from</label>
                                    <div class="col-sm-4">
                                        <input value="{{$leave->date_from}}" type="date" min="{{date('Y-m-d')}}" name="date_from" class="form-control" id="FromDate" required="required">
                                    </div>
                                    <div class="col-sm-4">
                                        <input value="{{$leave->date_to}}" type="date" min="{{date('Y-m-d')}}" name="date_to" class="form-control" id="ToDate" required="required">
                                    </div>
                                </div>
                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Days</label>
                                    <div class="col-sm-9">
                                        <input value="{{$leave->days}}" type="text" name="days" class="form-control" id="TotalDays" placeholder="Number of leave days" required="required" pattern="[0-9]{1}">
                                    </div>
                                </div>
                                
                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Doctor Prescription</label>
                                    <div class="col-sm-9">
                                       <img src="{{ asset('uploads/prescription/' . $leave->up_file) }}" width="80px" height="80px" alt="Image"> 
                                    </div>
                                </div>
                                
                                
                                <div class="form-group row" style="display:none;" id="drpdiv">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label"> Doctor Prescription</label>
                                    <div class="col-md-9">
                                        <div class="custom-file">
                                            <input type="file" name="drfile" class="custom-file-input"  disabled="disabled" id="drfile">
                                            <label class="custom-file-label">Choose file...</label>
                                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Reason</label>
                                    <div class="col-sm-9">
                                        <textarea  type="text" name="reason" class="form-control" placeholder="Reason" required>{{$leave->reason}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-dark">Apply</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.includes.footer')   
    </div>

@endsection

@section('js')
    <script type="text/javascript">
        
        var holidaysJSON = '["2020-07-21", "2020-07-18", "2020-10-02", "2021-10-26", "2020-11-16","2020-12-25"]';
        var holidaysArr = JSON.parse(holidaysJSON);
        
        $("#ToDate").change(function () {
            
            var start = new Date($('#FromDate').val());
            var end = new Date($('#ToDate').val());
            
            var days = workingDaysBetweenDates(start, end);
            
            //less holidays
            for (i = 0; i < holidaysArr.length; i++) {
                var check = new Date(holidaysArr[i]);
                if(dateCheck(start,end,check) === true){
                    if(days > 0){
                      days = days-1;  
                    } 
                 }  
            }
             
            //less second forth saturday
            var satArr = calcBusinessDays(start,end);
            for (i = 0; i < satArr.length; i++) {
                var satno = Math.ceil(satArr[i].getDate()/7);
                if(satno === 2 || satno === 4){
                   days = days-1;    
                }
            }
            
            //var diff = new Date(end - start);
            //var days=1;
            //days = diff / 1000 / 60 / 60 / 24;

            // $('#TotalDays').val(days);
            if(isNaN(days)){
                $('#TotalDays').val(0);
            } else {
                //$('#TotalDays').val(days+1);
                $('#TotalDays').val(days);
            }
                        
            if($('#leave_type').val() == "sick leave" && days > 2){
                $("#drpdiv").show();
                $("#drfile").removeAttr("disabled");
            }else{
               $("#drpdiv").hide();
               $("#drfile").attr("disabled", "disabled");
            }
            
            
        });

        $("#FromDate").change(function () {
            var start = new Date($('#FromDate').val());
            var end = new Date($('#ToDate').val());

            //var diff = new Date(end - start);
            //var days=1;
            //days = diff / 1000 / 60 / 60 / 24;
            
            var days = workingDaysBetweenDates(start, end);
            
            for (i = 0; i < holidaysArr.length; i++) {
                var check = new Date(holidaysArr[i]);
                if(dateCheck(start,end,check) === true){
                    if(days > 0){
                      days = days-1;  
                    } 
                 }  
            }
            
            // $('#TotalDays').val(days);
            if(isNaN(days)){
                $('#TotalDays').val(0);
            } else {
                //$('#TotalDays').val(days+1);
                $('#TotalDays').val(days);
            }
           
        });
        
        function workingDaysBetweenDates(startDate, endDate) {
  
            // Validate input
            if (endDate < startDate)
                return 0;

            // Calculate days between dates
            var millisecondsPerDay = 86400 * 1000; // Day in milliseconds
            startDate.setHours(0,0,0,1);  // Start just after midnight
            endDate.setHours(23,59,59,999);  // End just before midnight
            var diff = endDate - startDate;  // Milliseconds between datetime objects    
            var days = Math.ceil(diff / millisecondsPerDay);
            
            // Subtract two weekend days for every week in between
            var weeks = Math.floor(days / 7);
            //days = days - (weeks * 2); //if saturday sunday off
            days = days - (weeks * 1);  //if sunday off
                        
            // Handle special cases
            var startDay = startDate.getDay();
            var endDay = endDate.getDay();
            
            //var endWeek = Math.ceil(endDate.getDate()/7); //get the week
            //var startWeek = Math.ceil(endDate.getDate()/7); //get the week
            
            //only sundays
            if (startDay - endDay > 1){
                days = days - 1;    
            } 
            if (startDay === 0 && endDay === 0){
                days = days - 1;  
            }
            
            // Remove weekend not previously removed.   
            //if (startDay - endDay > 1)         
                //days = days - 2;      

            // Remove start day if span starts on Sunday but ends before Saturday
            //if (startDay == 0 && endDay != 6)
                //days = days - 1  

            // Remove end day if span ends on Saturday but starts after Sunday
            //if (endDay == 6 && startDay != 0)
                //days = days - 1  
            
            return days;
            
        }
        
        function dateCheck(from,to,check) {
            
            var dayno = check.getDay();
            if(dayno !== 6 && dayno !== 0){
              if((check <= to && check >= from)) {
                return true;
              }else{
                return false;
              }    
            }else{
              return false;  
            }
            
            
        }
        
        
        function calcBusinessDays(dDate1, dDate2) {
            if (dDate1 > dDate2) return false;
            var date  = dDate1;
            var dates = [];

            while (date < dDate2) {
                //if (date.getDay() === 0 || date.getDay() === 6){
                  //dates.push(new Date(date));  
                //} 
                if (date.getDay() === 6){
                  dates.push(new Date(date));  
                } 
                date.setDate( date.getDate() + 1 );
            }

            return dates;
        }
  
    </script>
    @endsection