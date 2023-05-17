@extends('admin.layout.master')

@section('content')

<?php 



$I_AM = objToArr(objToArr(get_defined_vars())["user"]);

$guess_FY = intval(explode("-",Session::get('CFY'))[0]);

//echo json_encode(objToArr(get_defined_vars()));




function getValueOrDefault($value) {
    if (isset($_GET[$value])) {
        return $_GET[$value];
    } else {
        return "";
    }
}

function objToArr($obj){
        return json_decode(json_encode( 
            $obj,true
        ),true);
}

function searchByKeyQuery($list, $key, $query) {
    $result = array();
    if (empty($query)) {
        return $list;
    }
    foreach ($list as $item) {
        if (isset($item[$key]) && stripos($item[$key], $query) !== false) {
            array_push($result,$item);
        }
    }
    return $result;
}

function getRow($dat){
    /*
    Description: This function returns tr tag string
    Returns: String
    */
    return "<tr>".$dat."</tr>";
}
function getDeff($dat,$pleaseNull = false,$nullWithDeff = true){
    /*
    Description: This function returns td tag string
    Returns: String
    */
    if($nullWithDeff == false){return "<td></td>";}
    if($pleaseNull){return "";}

    return "<td>".$dat."</td>";
}


function minutes_to_hours($minutes) {
    $hours = floor($minutes / 60);
    $remaining_minutes = $minutes % 60;
    return sprintf('%02d:%02d', $hours, $remaining_minutes);
}


function returnMButtons($id){
    return '<button data-toggle="modal" data-target="#view-modal" id="getUser" class="btn btn-sm btn-info" data-url="'.route('timesheet.ajaxindex',$id).'" style="float: left; margin-right: 5px;">View</button>
                                                 
    <form id="delete-form-'.$id.' " action="'.route('timesheet.delete',$id).'" method="delete">
    '.csrf_field().'
     <button type="submit" onclick="return confirm(\'Are you sure want to delete?\')" class="btn btn-sm btn-danger">Delete</button>
    </form>';
}

function userFromUserListById($id,$list){
    for ($i=0; $i < count($list); $i++) { 
        if(intval($list[$i]["id"]) == intval($id)){
            return $list[$i];
        }
    }
    return null;
}


function getUsersUnderManager( $managerID,$role=""){
    //we first get the manager from the list ....
    $usersList = fetch_users();
    
    $managerObj = userFromUserListById($managerID,$usersList);
    $ret = array();
    $Tsheets = array();
    // We then find users with manager name same as our manager
    for ($i=0; $i  < count($usersList) ; $i++) { 
        
        
            $managerName = $managerObj["full_name"];
        if($managerName == $usersList[$i]["manager"] || $role == "admin"){
            
            $sheets = getTimeSheetForUser($usersList[$i]["id"]);
            for ($j=0; $j < count($sheets) ; $j++) { 
                $sheet = $sheets[$j];
                $sheet["full_name"] = $usersList[$i]["full_name"];
                $sheet["user_id"] = $usersList[$i]["id"];
                array_push($Tsheets,$sheet);
            }
            array_push($ret,$usersList[$i]);
        }
    }

    //Returning a list of user objects
    return array(
        "t" => $Tsheets,
        "u" => $ret
    );

}

function getTimeSheetForUser($id){
    $conn = the_conn();
    $fy = intval(explode("-",Session::get('CFY'))[0]);
    
    $sql = "SELECT *    FROM `timesheetdetails`    JOIN `timesheets` ON `timesheetdetails`.`timesheet_id` = `timesheets`.`id` WHERE `timesheets`.`user_id` = '".$id."' AND year(`timesheets`.`timesheet_date`) = '".$fy."';";
    
    $ret = array();
    // Execute query
    $result = $conn->query($sql);
    //$allUser = fetch_users();
    // Check if any records were returned
    if ($result->num_rows > 0) {
        // Loop through each row and output the data
        while($row = $result->fetch_assoc()) {
      //      $user = userFromUserListById($row["user_id"],$allUser);
      //      $row["first_name"] = $user["first_name"];
      //      $row["last_name"] = $user["last_name"];
            array_push($ret,$row);
        }
    }

    // Close database connection
    $conn->close();
    return $ret;
}
function getTotalMinutesForDate($list, $date) {
    $totalMinutes = 0;

    foreach ($list as $item) {
        if ($item['timesheet_date'] == $date) {
            $totalMinutes += intval($item['working_mintus']);
        }
    }

    return $totalMinutes;
}

function removeDuplicates($list, $key) {
    $result = [];

    foreach ($list as $item) {
        $value = $item[$key];

        if (!array_key_exists($value, $result)) {
            $result[$value] = $item;
        }
    }

    return array_values($result);
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

function fetch_users() {
    $ME = objToArr(Auth::user());
    $my_role = $ME["role"];
    $conn = the_conn();
    
    if($my_role == "admin"){
        $sql = "SELECT * FROM users WHERE last_working IS NULL;";
    }
    elseif($my_role == "manager"){
        $sql = "SELECT * FROM users WHERE last_working IS NULL AND `manager` like '%".$ME["first_name"]."%' OR `id` = ".$ME["id"].";";
    }
    else{
        $sql = "SELECT * FROM users WHERE last_working IS NULL AND `id` = ".$ME["id"].";";
    }
    // Retrieve data from the users table
    
    $result = $conn->query($sql);

    // Create an array of user objects where each object is at the position of its ID
    $users = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $id = $row["id"];
            array_push($users, array(
                "id" => $row["id"],
                "username" => $row["username"],
                "email" => $row["email"],
                "phone" => $row["phone"],
                "first_name"=>$row["first_name"],
                "last_name"=>$row["last_name"],
                "manager"=>$row["manager"],
                "full_name"=>$row["first_name"] . " " . $row["last_name"],
                "m_timesheet"=>getTimeSheetForUser($row["id"]),
                "m_leaves" =>searchByKeyQuery(fetch_leaves(),"employee_id",$row["id"])
                // Add any other fields you want to include
            ));
        }
    }

    // Close connection
    $conn->close();

    // Return the array of users
    return $users;
}
function fetch_leaves(){
    //if($y == ""){$y = date("Y");}
    $conn = the_conn();
    // Retrieve data from the leaves Table
    
    $sql = "SELECT * FROM leaves";
    $result = $conn->query($sql);
    $ret = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            array_push($ret,$row);
        }
    }
    $conn->close();
    return $ret;
}

function sumWorkingMinutesByDate($data) {
    // Convert JSON string to array of objects
    $data = json_decode(json_encode($data));
    
    // Initialize array for storing sums by date
    $sums = array();
    
    // Loop through data and add up working_mintus by timesheet_date
    foreach ($data as $entry) {
        if(!isset($entry->working_mintus)){
            continue;
        }
      $date = $entry->timesheet_date;
      $workingMinutes = intval($entry->working_mintus);
      if (isset($sums[$date])) {
        $sums[$date] += $workingMinutes;
      } else {
        $sums[$date] = $workingMinutes;
      }
    }
    if(count(array_keys($sums)) == 0){
        return $sums;
    }
    // Check if there are any missing dates and set their sums to 0
    $startDate = min(array_keys($sums));
    $endDate = max(array_keys($sums));
    $currentDate = $startDate;
    while ($currentDate <= $endDate) {
      if (!isset($sums[$currentDate])) {
        $sums[$currentDate] = 0;
      }
      $currentDate = date('Y-m-d', strtotime("$currentDate +1 day"));
    }
  
    // Return associative array of timesheet_date and sum_of_working_mintus
    return $sums;
  }
  

  function sumWorkingMinutesByDateByUser($data, $userID) {
    // Convert JSON string to array of objects
    $data = json_decode(json_encode($data));
    
    // Initialize array for storing sums by date
    $sums = array();
    
    // Loop through data and add up working_mintus by timesheet_date
    foreach ($data as $entry) {
      if ($entry->user_id == $userID) {
        $date = $entry->timesheet_date;
        $workingMinutes = intval($entry->working_mintus);
        if (isset($sums[$date])) {
          $sums[$date] += $workingMinutes;
        } else {
          $sums[$date] = $workingMinutes;
        }
      }
    }
  
    // Check if there are any missing dates and set their sums to 0
    $startDate = min(array_keys($sums));
    $endDate = max(array_keys($sums));
    $currentDate = $startDate;
    while ($currentDate <= $endDate) {
      if (!isset($sums[$currentDate])) {
        $sums[$currentDate] = 0;
      }
      $currentDate = date('Y-m-d', strtotime("$currentDate +1 day"));
    }
  
    // Return associative array of timesheet_date and sum_of_working_mintus
    return $sums;
  }
  
  function searchByDateRange($list, $from_key, $to_key, $from_value, $to_value) {
    $result = array();
    $guess_FY = intval(explode("-",Session::get('CFY'))[0]);
    $from_timestamp = strtotime($guess_FY. '-01-01 00:00:00'); // Default value for date-from
    $to_timestamp = strtotime(($guess_FY+1) . '-01-01 00:00:00'); // Default value for date-to
    
    if (!empty($from_value)) {
        $from_timestamp = strtotime($from_value);
    }
    if (!empty($to_value)) {
        $to_timestamp = strtotime($to_value);
    }
    foreach ($list as $leave) {
        if (isset($leave[$from_key]) && isset($leave[$to_key])) {
            $leave_from = strtotime($leave[$from_key]);
            $leave_to = strtotime($leave[$to_key]);
            if ($leave_from >= $from_timestamp && $leave_to <= $to_timestamp) {
                
                array_push($result, $leave);
            }
        }
    }
    return $result;
}
  
function getWeekRange($date) { return array(date('Y-m-d', strtotime('last monday', strtotime($date))), date('Y-m-d', strtotime('next sunday', strtotime($date))), date('F j, Y', strtotime('last monday', strtotime($date))) . ' - ' . date('F j, Y', strtotime('next sunday', strtotime($date)))); }

/**
 * Generates an HTML table with a date range as column headers and employee names as row headers.
 * The table displays employees' work hours and leaves within the specified date range.
 * The user can navigate the date range using 'Prev' and 'Next' buttons.
 *
 * @param string $start_date Start date of the date range in 'Y-m-d' format.
 * @param string $end_date End date of the date range in 'Y-m-d' format.
 * @param int $jump Number of days to jump when navigating the date range using 'Prev' and 'Next' buttons (default: 7).
 * @return string HTML table with date range and employee work hours and leaves.
 */
function dateRangeTable($start_date, $end_date, $jump=7) {
    // Convert start and end dates to DateTime objects
    $start = new DateTime($start_date);
    $end = new DateTime($end_date);

    // Calculate previous and next date ranges for navigation
    $prev = new DateTime($start_date);
    $prev->modify("-". $jump ." Day");
    $next = new DateTime($end_date);
    $next->modify("+". $jump ." Day");

    //_________________________________________________________________________________________________________
    // Create the header row with dates as column headings
    $header_row = '<thead><tr>';
    // Add 'Prev' button to navigate to the previous date range
    $header_row .= '<th onclick="window.location.href=\'?date_from='.$prev->format('Y-m-d').'&date_to='.$start->format('Y-m-d').'\'" class="btn btn-success" >Prev</th>';
    // Add column header for employee names
    $header_row .= '<th>Employee Name</th>';
    // Add date column headers for the specified date range
    $current_date = $start;
    while ($current_date <= $end) {
      $header_row .= '<th>' . $current_date->format('jS F y') . '</th>';
      $current_date->modify('+1 day');
    }
    // Add 'Next' button to navigate to the next date range
    $header_row .= '<th onclick="window.location.href=\'?date_from='.$end->format('Y-m-d').'&date_to='.$next->format('Y-m-d').'\'" class="btn btn-success" >Next</th>';
    $header_row .= '</tr></thead>';
    //_________________________________________________________________________________________________________

    // Create the rows with employee names as the first column and work hours/leaves as the remaining columns
    $table_rows = "<tbody>";
    // Fetch all users (replace fetch_users() with your own function to get users from your database)
    $allUsers = fetch_users();
    
    // Loop through all users and create table rows for each user
    for($i = 0 ; $i < count($allUsers);$i++) {
        // Reset date range for each user
        $start = new DateTime($start_date);
        $end = new DateTime($end_date);
        $current_date = $start;
        $theUserNow = $allUsers[$i];
        $ret = '';

        // Add empty cell with white background and border (for styling purposes)
        $ret .= '<td style="background-color:white;border:white;"></td>';
        // Add employee name cell
        $ret .= '<td>' . $theUserNow["full_name"]  .'</td>';
        $loop_end = $end;
        $loop_date = $start;
        $timesheetCounter = 0;

        // Loop through the date range and populate work hours/leaves for each user
        while ($loop_date <= $loop_end) {
            // Check if the loop_date is the same as the current_date
            if ($loop_date->format('Y-m-d') == $current_date->format('Y-m-d')) {
            $buttons = '<a class="btn btn-danger" href="' . route('timesheet.create') . '">Add Timesheet</a>
                        <a class="btn btn-dark" href="'  . '">Edit</a>
                        ';

            // Search timesheets for the current user and date (replace searchByKeyQuery() with your own function)
            $times = searchByKeyQuery($theUserNow["m_timesheet"],"timesheet_date",$current_date->format('Y-m-d'));
                        // Calculate total working minutes for the current date
                        $totalMintu = 0;
                        for ($mAdderCtr = 0; $mAdderCtr < count($times); $mAdderCtr++) { 
                            $totalMintu += intval($times[$mAdderCtr]["working_mintus"]);
                        }
            
                        // Remove duplicate timesheets based on the "timesheet_date" key 
                        $times = removeDuplicates($times, "timesheet_date");
            
                        // Update the timesheet counter
                        $timesheetCounter += count($times);
            
                        // Generate buttons and display total work hours for each timesheet
                        for($ctr = 0; $ctr < count($times); $ctr++) {
                            $id = $times[$ctr]["id"];
                            $buttons .= '<p style="text-align:left;"><b>Today\'s work hours total:</b> ' . minutes_to_hours($totalMintu) . '</p>' . '<p style="text-align:center;">' . returnMButtons($id) . '</p>';
                        }
            
                        // If no timesheets are found, check for approved leaves on the current date
                        if (count($times) == 0) {
                            $myLeaves = searchByKeyQuery($theUserNow["m_leaves"], "is_approved", "1");
                            for ($leaveCtr = 0; $leaveCtr < count($myLeaves); $leaveCtr++) { 
                                if (!isset($myLeaves[$leaveCtr])) {
                                    $buttons .= "Error";
                                    continue;
                                }
                                $leaveToday = $myLeaves[$leaveCtr];
                                $leave_from = new DateTime($leaveToday["date_from"]);
                                $leave_to = new DateTime($leaveToday["date_to"]);
                                $check_date = $current_date;
            
                                // Check if the user is on leave for the current date
                                if (($check_date >= $leave_from) && ($check_date <= $leave_to)) {
                                    $buttons .= "User On Leave";
                                    $timesheetCounter += 1;
                                }
                            }
                        }
            
                        // Add cell with work hours or leaves 
                        $ret .= getDeff($buttons);
                    } else {
                        // Add a cell with a flag if loop_date and current_date don't match 
                        $ret .= getDeff('flag');
                    }
                    
                    // Move to the next date in the loop
                    $loop_date->modify('+1 day');
                }
            
                // Add the row for the current user only if the timesheetCounter is greater than 0
                $table_rows .= '<tr style="display:' . ($timesheetCounter > 0 ? "" : "") . ';">' . $ret . '</tr>';
            
                // Move to the next date for the current user
                $current_date->modify('+1 day');
            }
            $table_rows .= '</tbody>'; 
            
            // Combine header and row HTML into a complete table
            $table_html = '<table class="table table-striped table-bordered">' .$header_row . $table_rows . '</table>';
            // Return the complete HTML table
            return $table_html;
        }

            

  



 $f = getUsersUnderManager($I_AM["id"],$I_AM["role"]);
 $timeSheetsOfManagedUsers = $f["t"];
$temp =  $f["u"];
$selectPrinter = array();
for ($i=0; $i < count($temp); $i++) { 
    array_push($selectPrinter, array(
        "name" => $temp[$i]["full_name"],
        "id" => $temp[$i]["id"]
    ));
}
array_push($selectPrinter, array(
    "name" => $I_AM["first_name"],
    "id" => $I_AM["id"]
));


?>


    <div id="main-wrapper">
    @include('admin.includes.sidebar')
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Timesheet Management - <?php echo $guess_FY ?></h4>  
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('timesheet')}}">Timesheet</a></li>
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
                            <form action="#" method="GET" class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title">Search</h4>
                                    <div class="form-group row">
                                       
                                         @canany(['isAdmin', 'isManager']) 
                                        <div class="col-sm-3">
                                            <select type="text" name="userid" class="form-control" id="userid" placeholder="Select User">
                                                <option value="">-Select User-</option>
                                                <?php
                                                for ($i=0; $i < count($selectPrinter); $i++) { 
                                                    $x = $selectPrinter[$i];
                                                    echo '<option value="'.$x["id"].'"'.(getValueOrDefault("userid") == $x["id"] ? "selected":"").' > '.$x["name"].' </option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        @endcanany
                                        <div class="col-sm-3">
                                            <input type="date" name="createddate" class="form-control" id="createddate" placeholder="Date filter" value="{{ Request::get('createddate') }}">
                                        </div>
                                        <div class="col-sm-3"></div>
                                        
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-success">Search</button>
                                        <a href="{{route('timesheet')}}" class="btn btn-md btn-danger">Clear</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
               

                <div class="row">
                    <div class="col-md-2">
                        @can('isEmployee')
                        <a class="btn btn-lg btn-dark" href="{{route('timesheet.create')}}">Add Timesheet</a>
                        @endcan
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Timesheet List</h5>
                                <div class="table-responsive">
                                            <?php echo dateRangeTable(getValueOrDefault("date_from"),getValueOrDefault("date_to")); ?>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Timesheet List</h5>
                                <div class="table-responsive">
                                    
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            
            
    <div id="view-modal" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog"> 
             <div class="modal-content"> 

                  <div class="modal-header"> 
                      <h4 class="modal-title">
                           <i class="glyphicon glyphicon-user"></i> Timesheet Details
                       </h4> 
                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> 
                  </div> 
                  <div class="modal-body"> 

                      <div id="modal-loader" 
                           style="display: none; text-align: center;">
                           <img src="{{ asset('admin-panel/assets/images/ajax-loader.gif') }}" width="50px">
                      </div>

                      <!-- content will be load here -->                          
                      <div id="dynamic-content"></div>

                   </div> 
                   <div class="modal-footer"> 
                         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                   </div> 
            </div> 
         </div>
    </div><!-- /.modal --> 
            @include('admin.includes.footer')   
        </div>
    </div>

@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function(){
    
    $(document).on('click', '#deleteTeetdet', function(e){
        
      e.preventDefault(); 
       
      if (confirm("Are you sure want to delete?")) {
           var url = $(this).data('url');
           $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data){
                console.log(data); 

               // delete the row from the DOM
               $('tr#row' + data).fadeOut('slow').remove();
               $('#modal-loader').hide();  // hide ajax loader  

            })
            .fail(function(){
                $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                $('#modal-loader').hide();
            });
      } else {
         return false;
      }
     
    });

    $(document).on('click', '#getUser', function(e){

        e.preventDefault();

        var url = $(this).data('url');

        $('#dynamic-content').html(''); // leave it blank before ajax call
        $('#modal-loader').show();      // load ajax loader

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data){
            console.log(data);  
            $('#dynamic-content').html('');    
            $('#dynamic-content').html(data); // load response 
            $('#modal-loader').hide();        // hide ajax loader   
        })
        .fail(function(){
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
        });

    });

});

</script>
@endsection