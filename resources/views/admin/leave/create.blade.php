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

    <?php 
    $I_AM = Auth::user();
    $guess_FY = intval(explode("-",Session::get('CFY'))[0]);
    $TotalLeaves = getTotalLeavesForYear($I_AM->id,$guess_FY);
    $TakenLeaves = leavesTaken($I_AM->id,intval(explode("-",Session::get('CFY'))[0]));


    
    $sick = leavesTaken($I_AM->id,intval(explode("-",Session::get('CFY'))[0]),"%ick%");
    $anual = leavesTaken($I_AM->id,intval(explode("-",Session::get('CFY'))[0]),"%nual%");
    $maternity = leavesTaken($I_AM->id,intval(explode("-",Session::get('CFY'))[0]),"%Mat%");
    $casual = leavesTaken($I_AM->id,intval(explode("-",Session::get('CFY'))[0]),"%Cas%");
    $paternity = leavesTaken($I_AM->id,intval(explode("-",Session::get('CFY'))[0]),"%Pat%");
    $Compensatory = leavesTaken($I_AM->id,intval(explode("-",Session::get('CFY'))[0]),"%Comp%");
    $Unpaid = leavesTaken($I_AM->id,intval(explode("-",Session::get('CFY'))[0]),"%Unp%");




    $BalanceLeaves = $TotalLeaves - $TakenLeaves;
    function getTotalLeavesForYear($uid,$y){
        $sql = "SELECT CASE WHEN users.join_date < '".$y."-01-15' THEN 18 WHEN users.join_date < '".$y."-02-15' THEN 16.WHEN users.join_date < '".$y."-03-15' THEN 15 WHEN users.join_date < '".$y."-04-15' THEN 13.5 WHEN users.join_date < '".$y."-05-15' THEN 12 WHEN users.join_date < '".$y."-06-15' THEN 10.5 WHEN users.join_date < '".$y."-07-15' THEN 9 WHEN users.join_date < '".$y."-08-15' THEN 7.5 WHEN users.join_date < '".$y."-09-15' THEN 6 WHEN users.join_date < '".$y."-10-15' THEN 4.5 WHEN users.join_date < '".$y."-11-15' THEN 3 WHEN users.join_date < '".$y."-12-15' THEN 1.5 ELSE 0 END AS total_leave FROM users WHERE users.id = ".$uid."; ";
        $conn = the_conn();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $conn->close();
                return intval($row["total_leave"]);
            }
        }
    }

    function getSickLeavesForYear($uid,$y){
        $sql = "SELECT CASE WHEN users.join_date < '".$y."-01-15' THEN 6 WHEN users.join_date < '".$y."-02-15' THEN 5.5 WHEN users.join_date < '".$y."-03-15' THEN 5 WHEN users.join_date < '".$y."-04-15' THEN 4.5 WHEN users.join_date < '".$y."-05-15' THEN 4 WHEN users.join_date < '".$y."-06-15' THEN 3.5 WHEN users.join_date < '".$y."-07-15' THEN 3 WHEN users.join_date < '".$y."-08-15' THEN 2.5 WHEN users.join_date < '".$y."-09-15' THEN 2 WHEN users.join_date < '".$y."-10-15' THEN 1.5 WHEN users.join_date < '".$y."-11-15' THEN 1 WHEN users.join_date < '".$y."-12-15' THEN 0.5 ELSE 0 END AS total_leave FROM users WHERE users.id = ".$uid."; ";
        $conn = the_conn();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $conn->close();
                return intval($row["total_leave"]);
            }
        }
    }

    function getAnnualLeavesForYear($uid,$y){
        $sql = "SELECT CASE WHEN users.join_date < '".$y."-01-15' THEN 12 WHEN users.join_date < '".$y."-02-15' THEN 11 WHEN users.join_date < '".$y."-03-15' THEN 10 WHEN users.join_date < '".$y."-04-15' THEN 9 WHEN users.join_date < '".$y."-05-15' THEN 8 WHEN users.join_date < '".$y."-06-15' THEN 7 WHEN users.join_date < '".$y."-07-15' THEN 6 WHEN users.join_date < '".$y."-08-15' THEN 5 WHEN users.join_date < '".$y."-09-15' THEN 4 WHEN users.join_date < '".$y."-10-15' THEN 3 WHEN users.join_date < '".$y."-11-15' THEN 2 WHEN users.join_date < '".$y."-12-15' THEN 1 ELSE 0 END AS total_leave FROM users WHERE users.id = ".$uid."; ";
        $conn = the_conn();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $conn->close();
                return intval($row["total_leave"]);
            }
        }
    }

    function leavesTaken($id,$y,$type="%"){
        $sql = "SELECT SUM(days) AS 'total_leave'
        FROM leaves
        WHERE YEAR(date_from) = ".$y."
        AND leave_type Like '".$type."'
        AND is_approved = 1
        AND employee_id = ".$id;
        $conn = the_conn();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $conn->close();
                return intval($row["total_leave"]);
            }
        }
        
        
    }

    function the_conn(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "thinknyx_connect";
    
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
    
    ?>

            <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Leave Management</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('leave.create')}}">Leave</a></li>
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
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label for="fname" class="col-sm-4 text-right control-label col-form-label">Total Leaves:</label>
                                            <div class="col-sm-4" style="line-height: 2.5;"><strong>{{$TotalLeaves}}</strong></div>
                                        </div>
                                        
                                        <div class="row">
                                            <label for="fname" class="col-sm-4 text-right control-label col-form-label">Total Annual Leaves:</label>
                                            <div class="col-sm-4" style="line-height: 2.5;"><strong><?php echo getAnnualLeavesForYear($I_AM["id"],$guess_FY);?></strong></div>
                                        </div>
                                        <div class="row">
                                            <label for="fname" class="col-sm-4 text-right control-label col-form-label">Total Sick Leaves:</label>
                                            <div class="col-sm-4" style="line-height: 2.5;"><strong><?php echo getSickLeavesForYear($I_AM["id"],$guess_FY);?></strong></div>
                                        </div>
                                        <div class="row">
                                            <label for="fname" class="col-sm-4 text-right control-label col-form-label">Availed Leaves:</label>
                                            <div class="col-sm-4" style="line-height: 2.5;"><strong>{{$TakenLeaves}}</strong></div>
                                        </div>
                                        <div class="row">
                                            <label for="fname" class="col-sm-4 text-right control-label col-form-label">Balance Leaves:</label>
                                            <div class="col-sm-4" style="line-height: 2.5;"><strong>{{$BalanceLeaves}}</strong></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row" style="display:<?php echo (intval($sick) > 0 ?"":"none"); ?>;">
                                            <label for="fname" class="col-sm-4 text-right control-label col-form-label">Availed Sick Leaves:</label>
                                            <div class="col-sm-4" style="line-height: 2.5;"><strong>{{ $sick }}</strong></div>
                                        </div>
                                        <div class="row" style="display:<?php echo (intval($anual) > 0 ?"":"none"); ?>;">
                                            <label for="fname" class="col-sm-4 text-right control-label col-form-label">Availed Annual Leaves:</label>
                                            <div class="col-sm-4" style="line-height: 2.5;"><strong>{{ $anual }}</strong></div>
                                        </div>
                                        <div class="row" style="display:<?php echo (intval($maternity) > 0 ?"":"none"); ?>;">
                                            <label for="fname" class="col-sm-4 text-right control-label col-form-label">Maternity Leaves:</label>
                                            <div class="col-sm-4" style="line-height: 2.5;"><strong>{{ $maternity }}</strong></div>
                                        </div>
                                        <div class="row" style="display:<?php echo (intval($casual) > 0 ?"":"none"); ?>;">
                                            <label for="fname" class="col-sm-4 text-right control-label col-form-label">Availed Casual Leaves:</label>
                                            <div class="col-sm-4" style="line-height: 2.5;"><strong>{{ $casual }}</strong></div>
                                        </div>
                                        <div class="row" style="display:<?php echo (intval($paternity) > 0 ?"":"none"); ?>;">
                                            <label for="fname" class="col-sm-4 text-right control-label col-form-label">Paternity Leaves:</label>
                                            <div class="col-sm-4" style="line-height: 2.5;"><strong>{{ $paternity }}</strong></div>
                                        </div>
                                        <div class="row" style="display:<?php echo (intval($Compensatory) > 0 ?"":"none"); ?>;">
                                            <label for="fname" class="col-sm-4 text-right control-label col-form-label">Compensatory Leaves:</label>
                                            <div class="col-sm-4" style="line-height: 2.5;"><strong>{{ $Compensatory }}</strong></div>
                                        </div>
                                        <div class="row" style="display:<?php echo (intval($Unpaid) > 0 ?"":"none"); ?>;">
                                            <label for="fname" class="col-sm-4 text-right control-label col-form-label">Unpaid Leaves:</label>
                                            <div class="col-sm-4" style="line-height: 2.5;"><strong>{{ $Unpaid }}</strong></div>
                                        </div>
                                    </div>
                                </div>

                                

                            </div>
                        
                    </div>
                </div>
            </div>
            
            
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <form action="{{route('leave.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <h4 class="card-title">Apply Leave</h4>
                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Leave type</label>
                                    <div class="col-sm-9">
                                        <select type="text" name="leave_type" class="form-control" id="leave_type" value="" required="required">
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
                                    <div class="col-sm-3">
                                        <input type="date" min="{{date('Y-m-d', strtotime("-120 days"))}}" name="date_from" class="form-control" id="FromDate" required="required">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="date" min="{{date('Y-m-d', strtotime("-120 days"))}}" name="date_to" class="form-control" id="ToDate" required="required">
                                    </div>
                                    <div id="half-day" class="col-sm-3" style="font-weight:bold;">
                                       Half Day 
                                        <input type="checkbox"  name="half-day">
                                    </div>
                                    <script>
                                        const date1Input = document.getElementById("FromDate");
                                        const date2Input = document.getElementById("ToDate");
                                        const checkboxInput = document.getElementById("half-day");

                                        function checkIfSameDate() {
                                        const date1 = new Date(date1Input.value);
                                        const date2 = new Date(date2Input.value);
                                        const timeDiff = Math.abs(date2.getTime() - date1.getTime());
                                        const diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                                        (checkboxInput.children[0].value == "on"? document.getElementById("TotalDays").value = "0.5":diffDays);
                                        if (date1.toDateString() === date2.toDateString()) {
                                            checkboxInput.style.display = "block";
                                            
                                        } else {
                                            checkboxInput.style.display = "none";
                                        }
                                        }

                                        date1Input.addEventListener("change", checkIfSameDate);
                                        date2Input.addEventListener("change", checkIfSameDate);
                                        checkboxInput.children[0].addEventListener("change", checkIfSameDate);

                                    </script>
                                </div>

                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Days</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="days" class="form-control" id="TotalDays" placeholder="Number of leave days" required="required" >
                                    </div>
                                </div>
                                
                                <div class="form-group required row" style="display:none;" id="drpdiv">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label"> Doctor Prescription</label>
                                    <div class="col-md-9">
                                        <div class="custom-file">
                                            <input type="file" name="drfile" class="custom-file-input" required="required" disabled="disabled" id="drfile">
                                            <label class="custom-file-label">Choose file...</label>
                                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Reason</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" name="reason" class="form-control" placeholder="Reason" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-dark" id="applyleave">Apply</button>
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
        
        // The holidays are stored as a JSON string
        var holidaysJSON = '["2020-07-21", "2020-07-18", "<?php echo $guess_FY; ?>-10-02", "2021-10-26", "2020-11-16","<?php echo $guess_FY; ?>-12-25"]';

        // Parse the holidays JSON string into an array
        var holidaysArr = JSON.parse(holidaysJSON);

        // Bind the change event of a date input field with ID 'ToDate' to a function
        $("#ToDate").change(function () {

            // Get the start and end dates from the date input fields
            var start = new Date($('#FromDate').val());
            var end = new Date($('#ToDate').val());

            // Calculate the number of working days between the start and end dates
            var days = workingDaysBetweenDates(start, end);

            // Subtract the number of holidays falling between the start and end dates
            for (i = 0; i < holidaysArr.length; i++) {
                var check = new Date(holidaysArr[i]);
                if (dateCheck(start, end, check) === true) {
                    if (days > 0) {
                        days = days - 1;
                    }
                }
            }

            // Subtract the second and fourth Saturdays falling between the start and end dates
            // var satArr = calcBusinessDays(start, end);
            // for (i = 0; i < satArr.length; i++) {
            //     var satno = Math.ceil(satArr[i].getDate() / 7);
            //     if (satno === 2 || satno === 4) {
            //         days = days - 1;
            //     }
            // }

            // Set the total number of days in a text input field with ID 'TotalDays'
            if (isNaN(days)) {
                $('#TotalDays').val(0);
            } else {
                $('#TotalDays').val(days);
            }

            // Show or hide a dropdown element and a file input element based on the leave type and number of days
            if ($('#leave_type').val() == "sick leave" && days > 2) {
                $("#drpdiv").show();
                $("#drfile").removeAttr("disabled");
            } else {
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