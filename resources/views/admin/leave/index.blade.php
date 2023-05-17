<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset(get_defined_vars()["user"])){
    $u = get_defined_vars()["user"];    
}
$u = objToArr(Auth::user());
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
$guess_FY = "";

try {
    $guess_FY = intval(explode("-",Session::get('CFY'))[0]);
} catch (\Throwable $th) {
    //echo "Unable to guess date.";
}




?>


@extends('admin.layout.master')

@section('content')

    <div id="main-wrapper">
    @include('admin.includes.sidebar')
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Leave Management - <?php echo $guess_FY ?> </h4>
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
               <script> 
            function submitFormByName(formName) {
  const form = document.forms[formName];
  const inputs = form.getElementsByTagName('input');
  const urlParams = new URLSearchParams();
  
  for (let i = 0; i < inputs.length; i++) {
    const input = inputs[i];
    const name = input.name;
    const value = input.value;
    
    if (name) {
      urlParams.append(name, value);
    }
  }

  window.location.href+=urlParams.toString();
}
  </script>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <form name='searchform'  action="<?php 
                            if(isset($u)){
                                if($u["role"] == "admin" ){
                                    echo "#";//route('leave.search');
                                }
                                else{
                                    echo "#";
                                }
    
                            }
                            else{
                                echo "#";
                            }
                            
                            ?>" method="GET" class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title">Search</h4>
                                    
                                    <div class="form-group row">
                                    
                                        <div class="col-sm-3">
                                            <!--input type="text" name="leavetype" class="form-control" id="leavetype" placeholder="Leave Type" value="{{ Request::get('leavetype') }}" commented by Madhuri-->
                                            <select type="text" name="leavetype" class="form-control" id="leavetype" value="" required="required">
                                            <option value="all">Show All</option>
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
                                        

                                        <?php
                                                /* 
                                                
                                                Some Library Style functions 
                                                
                                                */
                                                function isConcernedUser($id,$cList){
                                                    /*
                                                    Description: This function checks if user is of concern. 
                                                    Returns: Boolean
                                                    */
                                                    for ($i= 0; $i< count($cList); $i++) { 
                                                        if(intval($id) == intval($cList[$i])){
                                                            return true;
                                                        }
                                                    }
                                                    return false;
                                                }
                                                function getRow($dat){
                                                    /*
                                                    Description: This function returns tr tag string
                                                    Returns: String
                                                    */
                                                    
                                                    return "<tr  >".$dat."</tr>";
                                                }
                                                function getDeff($dat,$rowDat,$pleaseNull = false,$nullWithDeff = true){
                                                    /*
                                                    Description: This function returns td tag string
                                                    Returns: String
                                                    */
                                                    $t = $rowDat["total_leaves"];
                                                    $l = $rowDat["total_leaves_taken"];
                                                    $b = $rowDat["leaves_available"];
                                                    $n = $rowDat["name"]; 
                                                    $ret = array(
                                                        "n"=>$n,
                                                        "b"=> $b,
                                                        "l"=>$l,
                                                        "t"=>$t,
                                                        "total_annual_leaves"=>$rowDat["total_annual_leaves"],
                                                        "total_sick_leaves"=>$rowDat["total_sick_leaves"]
                                                    );
                                                    $leaveTypes = array('Annual Leave', 'Sick Leave', 'Casual Leave', 'Maternity Leave', 'Paternity Leave', 'Compensatory Leave', 'Unpaid Leave', 'Work From Home');

                                                    foreach ($leaveTypes as $type) {
                                                    $element = str_replace(' ', '_', $type); // remove spaces from the leave type and use it as the ID
                                                    $ret[$element] = $rowDat[$element];
                                                    }

                                                    if($nullWithDeff == false){return "<td></td>";}
                                                    if($pleaseNull){return "";}
                                                    $id  = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);
                                                    return "<td id='".$id."' onclick='addHoverToShowElement(\"".$id."\",\"leaveDisplay\",".json_encode($ret).");' >".$dat."</td>";
                                                }
                                                function isApprovedSpan($stat){
                                                    switch (intval($stat)) {
                                                        case 2:
                                                            return '<span class="badge badge-pill badge-danger">Rejected</span>';
                                                            break;
                                                        case 1:
                                                            return '<span class="badge badge-pill badge-success">Approved</span>';
                                                            break;
                                                        case 3:
                                                            return '<span class="badge badge-pill badge-info">Canceled</span>';
                                                            break;
                                                        default:
                                                            return '<span class="badge badge-pill badge-warning">Pending</span>';
                                                            break;
                                                    }
                                                }
                                                function leaveTypeToActionButton($stat,$leaveID,$isItMe){
                                                    $iam = objToArr(Auth::user());
                                                    switch (intval($stat)) {
                                                        
                                                        case 0: 
                                                            return 
                                                            ($iam["role"] == "admin" || $iam["role"] == "manager" ? '<form id="approve-leave-'.$leaveID.'" action="'.route('leave.approve',$leaveID).'" method="POST">
                                                            '.csrf_field().'
                                                            <input type="hidden" name="approve"  value="1">
                                                            <input type="hidden" name="approve_comment" id="approve_comment" value="">
                                                            <button type="button" onclick="approveLeave('.$leaveID.')" class="btn btn-sm btn-cyan" name="approvebtn">Approve</button>
                                                        </form>
                                                        <form id="reject-leave-'.$leaveID.'" action="'.route('leave.approve',$leaveID).'" method="POST">
                                                            '.csrf_field().'
                                                            <input type="hidden" name="approve"  value="2">
                                                            <input type="hidden" name="approve_comment" id="reject_comment" value="">
                                                            <button type="button" onclick="rejectLeave('.$leaveID.')" class="btn btn-sm btn-danger" name="approve">Reject</button>
                                                        </form>'
                                                        :
                                                        '<form id="reject-leave-'.$leaveID.'" action="'.route('leave.edit',$leaveID).'" method="POST">
                                                        '.csrf_field().'
                                                        <input type="hidden" name="approve"  value="0">
                                                        <input type="hidden" name="approve_comment" id="reject_comment" value="">
                                                        <button type="button" onclick="window.location.href=\''.route('leave.edit',$leaveID).'\'" class="btn btn-sm btn-dark" name="approve">Edit</button>
                                                        </form>')
                                                            ;
                                                            break;
                                                        case 1:
                                                            return '<form id="reject-leave-'.$leaveID.'" action="'.route('leave.approve',$leaveID).'" method="POST">
                                                            '.csrf_field().'
                                                            <input type="hidden" name="approve"  value="3">
                                                            <input type="hidden" name="approve_comment" id="reject_comment" value="">
                                                            <button type="button" onclick="rejectLeave('.$leaveID.')" class="btn btn-sm btn-danger" name="approve">
                                                            '.($iam["role"] == "admin" || $iam["role"] == "manager" ?"Reject":"Cancel").'
                                                            </button>
                                                            </form>';
                                                            break;
                                                        default:
                                                            return '<form id="approve-leave-'.$leaveID.'" action="'.route('leave.approve',$leaveID).'" method="POST">
                                                            '.csrf_field().'
                                                            <input type="hidden" name="approve"  value="1">
                                                            <input type="hidden" name="approve_comment" id="approve_comment" value="">
                                                            <button type="button" onclick="approveLeave('.$leaveID.')" class="btn btn-sm btn-cyan" name="approvebtn">Approve</button>
                                                        </form>';
                                                            break;
                                                    }
                                                }
                                                function userFromUserListById($id,$list){
                                                    for ($i=0; $i < count($list); $i++) {
                                                        
                                                        if(intval($list[$i]["id"]) == intval($id)){
                                                            return $list[$i];
                                                        }
                                                    }
                                                    //echo "User Not Found in list".$id.json_encode($list)."<br>";
                                                    return null;
                                                }

                                                function searchByKeyQuery($list, $key, $query) {
                                                    $result = array();
                                                    if (empty($query)) {
                                                        return $list;
                                                    }
                                                    foreach ($list as $leave) {
                                                        if (isset($leave[$key]) && stripos($leave[$key], $query) !== false) {
                                                            array_push($result,$leave);
                                                        }
                                                    }
                                                    return $result;
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
                                                
                                                
                                                
                                                function getUsersUnderManager( $managerID,$usersList){
                                                    //we first get the manager from the list ....
                                                    
                                                    $managerObj = userFromUserListById($managerID,$usersList);
                                                    $ret = array();
                                                    // We then find users with manager name same as our manager
                                                    for ($i=0; $i  < count($usersList) ; $i++) { 
                                                        
                                                        if (!isset($managerObj["full_name"])){continue;}
                                                            $managerName = $managerObj["full_name"];
                                                        if($managerName == $usersList[$i]["manager"]){
                                                            array_push($ret,$usersList[$i]);
                                                        }
                                                    }

                                                    //Returning a list of user objects
                                                    return $ret;

                                                }
                                                function fetch_users() {
                                                    
                                                    $conn = the_conn();
                                                
                                                    // Retrieve data from the users table
                                                    $sql = "SELECT * FROM users WHERE last_working IS NULL;";
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
                                                                // Add any other fields you want to include
                                                            ));
                                                        }
                                                    }
                                                
                                                    // Close connection
                                                    $conn->close();
                                                
                                                    // Return the array of users
                                                    return $users;
                                                }
                                                function getTotalLeavesForYear($uid,$y){
                                                    $sql = "SELECT `join_date` FROM `users` WHERE  users.id = ".$uid."; ";
                                                    $conn = the_conn();
                                                    $result = $conn->query($sql);
                                                    $joinDate = '';
                                                    if ($result->num_rows > 0) {
                                                        while($row = $result->fetch_assoc()) {
                                                            $conn->close();
                                                            $joinDate = $row["join_date"];
                                                        }
                                                    }
                                                    $joinDate = new DateTime($joinDate);
                                                    $jan15 = new DateTime('2023-01-15');
                                                    $feb15 = new DateTime('2023-02-15');
                                                    $mar15 = new DateTime('2023-03-15');
                                                    $apr15 = new DateTime('2023-04-15');
                                                    $may15 = new DateTime('2023-05-15');
                                                    $jun15 = new DateTime('2023-06-15');
                                                    $jul15 = new DateTime('2023-07-15');
                                                    $aug15 = new DateTime('2023-08-15');
                                                    $sep15 = new DateTime('2023-09-15');
                                                    $oct15 = new DateTime('2023-10-15');
                                                    $nov15 = new DateTime('2023-11-15');
                                                    $dec15 = new DateTime('2023-12-15');
                                                  
                                                    if ($joinDate < $jan15) {
                                                      return 18;
                                                    } elseif ($joinDate < $feb15) {
                                                      return 16;
                                                    } elseif ($joinDate < $mar15) {
                                                      return 15;
                                                    } elseif ($joinDate < $apr15) {
                                                      return 13.5;
                                                    } elseif ($joinDate < $may15) {
                                                      return 12;
                                                    } elseif ($joinDate < $jun15) {
                                                      return 10.5;
                                                    } elseif ($joinDate < $jul15) {
                                                      return 9;
                                                    } elseif ($joinDate < $aug15) {
                                                      return 7.5;
                                                    } elseif ($joinDate < $sep15) {
                                                      return 6;
                                                    } elseif ($joinDate < $oct15) {
                                                      return 4.5;
                                                    } elseif ($joinDate < $nov15) {
                                                      return 3;
                                                    } elseif ($joinDate < $dec15) {
                                                      return 1.5;
                                                    } else {
                                                      return 0;
                                                    }
                                                }

                                                function getSickLeavesForYear($uid,$y){
                                                    $sql = "SELECT `join_date` FROM `users` WHERE  users.id = ".$uid."; ";
                                                    $conn = the_conn();
                                                    $result = $conn->query($sql);
                                                    $joinDate = '';
                                                    if ($result->num_rows > 0) {
                                                        while($row = $result->fetch_assoc()) {
                                                            $conn->close();
                                                            $joinDate = $row["join_date"];
                                                        }
                                                    }
                                                    $joinDate = new DateTime($joinDate);
                                                    $jan15 = new DateTime('2023-01-15');
                                                    $feb15 = new DateTime('2023-02-15');
                                                    $mar15 = new DateTime('2023-03-15');
                                                    $apr15 = new DateTime('2023-04-15');
                                                    $may15 = new DateTime('2023-05-15');
                                                    $jun15 = new DateTime('2023-06-15');
                                                    $jul15 = new DateTime('2023-07-15');
                                                    $aug15 = new DateTime('2023-08-15');
                                                    $sep15 = new DateTime('2023-09-15');
                                                    $oct15 = new DateTime('2023-10-15');
                                                    $nov15 = new DateTime('2023-11-15');
                                                    $dec15 = new DateTime('2023-12-15');
                                                  
                                                    if ($joinDate < $jan15) {
                                                      return 6;
                                                    } elseif ($joinDate < $feb15) {
                                                      return 5.5;
                                                    } elseif ($joinDate < $mar15) {
                                                      return 5;
                                                    } elseif ($joinDate < $apr15) {
                                                      return 4.5;
                                                    } elseif ($joinDate < $may15) {
                                                      return 4;
                                                    } elseif ($joinDate < $jun15) {
                                                      return 3.5;
                                                    } elseif ($joinDate < $jul15) {
                                                      return 3;
                                                    } elseif ($joinDate < $aug15) {
                                                      return 2.5;
                                                    } elseif ($joinDate < $sep15) {
                                                      return 2;
                                                    } elseif ($joinDate < $oct15) {
                                                      return 1.5;
                                                    } elseif ($joinDate < $nov15) {
                                                      return 1;
                                                    } elseif ($joinDate < $dec15) {
                                                      return 0.5;
                                                    } else {
                                                      return 0;
                                                    }
                                                }
                                                function getAnnualLeavesForYear($uid,$y){
                                                    $sql = "SELECT `join_date` FROM `users` WHERE  users.id = ".$uid."; ";
                                                    $conn = the_conn();
                                                    $result = $conn->query($sql);
                                                    $joinDate = '';
                                                    if ($result->num_rows > 0) {
                                                        while($row = $result->fetch_assoc()) {
                                                            $conn->close();
                                                            $joinDate = $row["join_date"];
                                                        }
                                                    }
                                                    $joinDate = new DateTime($joinDate);
                                                    $jan15 = new DateTime('2023-01-15');
                                                    $feb15 = new DateTime('2023-02-15');
                                                    $mar15 = new DateTime('2023-03-15');
                                                    $apr15 = new DateTime('2023-04-15');
                                                    $may15 = new DateTime('2023-05-15');
                                                    $jun15 = new DateTime('2023-06-15');
                                                    $jul15 = new DateTime('2023-07-15');
                                                    $aug15 = new DateTime('2023-08-15');
                                                    $sep15 = new DateTime('2023-09-15');
                                                    $oct15 = new DateTime('2023-10-15');
                                                    $nov15 = new DateTime('2023-11-15');
                                                    $dec15 = new DateTime('2023-12-15');
                                                  
                                                    if ($joinDate < $jan15) {
                                                      return 12;
                                                    } elseif ($joinDate < $feb15) {
                                                      return 11;
                                                    } elseif ($joinDate < $mar15) {
                                                      return 10;
                                                    } elseif ($joinDate < $apr15) {
                                                      return 9;
                                                    } elseif ($joinDate < $may15) {
                                                      return 8;
                                                    } elseif ($joinDate < $jun15) {
                                                      return 7;
                                                    } elseif ($joinDate < $jul15) {
                                                      return 6;
                                                    } elseif ($joinDate < $aug15) {
                                                      return 5;
                                                    } elseif ($joinDate < $sep15) {
                                                      return 4;
                                                    } elseif ($joinDate < $oct15) {
                                                      return 3;
                                                    } elseif ($joinDate < $nov15) {
                                                      return 2;
                                                    } elseif ($joinDate < $dec15) {
                                                      return 1;
                                                    } else {
                                                      return 0;
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
                                                            return $row["total_leave"];
                                                        }
                                                    }
                                                    
                                                    
                                                }
                                            

                                                function fetch_leaves($y){
                                                    //if($y == ""){$y = date("Y");}
                                                    $conn = the_conn();
                                                    // Retrieve data from the leaves Table
                                                    
                                                    $sql = "SELECT leaves.*, users.join_date
                                                    FROM leaves
                                                    JOIN users ON leaves.employee_id = users.id
                                                    WHERE YEAR(leaves.date_from) = ".$y."
                                                    AND leaves.date_from > users.join_date;
                                                    ";
                                                    
                                                    $result = $conn->query($sql);
                                                    $allUsers = fetch_users();
                                                    $ret = array();
                                                    if ($result->num_rows > 0) {
                                                        while($row = $result->fetch_assoc()) {
                                                            $user = userFromUserListById($row["employee_id"],$allUsers);
                                                            if($user == null){continue;};
                                                            $row["employee_name"] = $user["full_name"];
                                                            $row["total_leaves"] = getTotalLeavesForYear($row["employee_id"],$y);
                                                            $row["total_annual_leaves"] = getAnnualLeavesForYear($row["employee_id"],$y);
                                                            $row["total_sick_leaves"] = getSickLeavesForYear($row["employee_id"],$y);
                                                            $row["total_leaves_taken"] = leavesTaken($row["employee_id"],$y);
                                                            $row["leaves_available"] =$row["total_leaves"] -  $row["total_leaves_taken"];
                                                            // $row["Sick_Leaves"] = leavesTaken($row["employee_id"],$y,"%ick%");
                                                            // $row["Annual_Leaves"] = leavesTaken($row["employee_id"],$y,"%nual");
                                                            $leaveTypes = array('Annual Leave', 'Sick Leave', 'Casual Leave', 'Maternity Leave', 'Paternity Leave', 'Compensatory Leave', 'Unpaid Leave', 'Work From Home');

                                                            foreach ($leaveTypes as $type) {
                                                            $element = str_replace(' ', '_', $type); // remove spaces from the leave type and use it as the ID
                                                            $row[$element] = leavesTaken($row["employee_id"],$y,"%".$element."%");
                                                            }
                                                            


                                                            array_push($ret,$row);
                                                        }
                                                    }
                                                    $conn->close();
                                                    
                                                    return $ret;

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
                                                


                                                //_________________________________________________________________________
                                                /*
                                                    
                                                    NOTE: The employee login lacks user role identifier only on the search page.
                                                */

                                                $open= '<div class="col-sm-3" UniqueStr ><select type="text" name="userid" class="form-control" id="userid" placeholder="Select User"  ><option value="">Show All</option>';
                                                $mid="";
                                                $close='</select></div>';
                                                try {
                                                    $leavesList = objToArr(objToArr(get_defined_vars()["leaves"])["data"]);


                                                    // Get All Users
                                                    $userLIST = (gettype(objToArr(get_defined_vars()["userlist"])) == "string" ? array():objToArr(get_defined_vars()["userlist"]) );
                                                    // Get a list (id) of only concerned users ... 
                                                    $concernedUsers = array();
                                                    $ids = array_keys($userLIST);
                                                    $leavesList = fetch_leaves( ($guess_FY == "" ? "":$guess_FY) );
                                                    
                                                    if($u['role']=='admin'){  
                                                        //Admin Logic
                                                        for ($i=0; $i < count($ids); $i++) { 
                                                            $id = (string)$ids[$i];
                                                            $name = $userLIST[$id];
                                                            array_push($concernedUsers,$id);
                                                            $opt='<option value="'.$id.'">'.$name.'</option>';
                                                            $mid=$mid.$opt;
                                                            }                               
                                                        }
                                                        elseif($u['role']=='manager') {
                                                            // Manager Logic
                                                            // Collect the leaves for users under this manager
                                                            
                                                            
                                                            $usersUnderManager = getUsersUnderManager(intval($u["id"]),fetch_users()); 
                                                            
                                                            
                                                            foreach($usersUnderManager as $userNow) {
                                                                $user = $userNow;
                                                                
                                                                $id = (string)$user['id'];
                                                                $name = $user['username'];
                                                                array_push($concernedUsers, $id);
                                                                $opt='<option value="'.$id.'">'.$name.'</option>';
                                                                $mid=$mid.$opt;
                                                            }
                                                        // Also display the leaves for the current user (manager)
                                                            array_push($concernedUsers,$u["id"]);
                                                            $opt='<option value="'.$u["id"].'">'.$u["username"].'</option>';
                                                            $mid=$mid.$opt;
                                                        } 
                                                    else {
                                                        //Employee Logic
                                                        array_push($concernedUsers,$u["id"]);
                                                        $opt='<option value="'.$u["id"].'">'.$u["username"].'</option>';
                                                        $mid=$mid.$opt;
                                                        $open = str_replace("UniqueStr",'style="display:none;"',$open);
                                                    }
                                                        echo $open.$mid.$close;                                            
                                                } catch (Exception $e) {
                                                    echo $e;
                                                }
                                                
                                                
                                                ?>
                                        <!--<label for="fromDate">From: </label>-->
                                        <div class="col-sm-3">
                                        
                                            <!--input type="date" name="createddate" class="form-control" id="createddate" placeholder="Date filter" value="{{ Request::get('createddate') }}"commented by Madhuri-->
                                            <input type="date" min="{{date('Y-m-d'),strtotime("2013-01-19 01:23:42")}}" name="date_from" class="form-control" id="FromDate">
                                            
                                        </div>
                                        <!--<label for="ToDate">To: </label>-->
                                        <div class="col-sm-3">
                                            <!--input type="date" name="createddate" class="form-control" id="createddate" placeholder="Date filter" value="{{ Request::get('createddate') }}"commented by Madhuri-->
                                            
                                            <input type="date" min="{{date('Y-m-d', strtotime("-90 days"))}}" name="date_to" class="form-control" id="ToDate" >
                                            <script>
                                                document.getElementById("FromDate").min = "2010-10-10"
                                               // document.getElementById("FromDate").max = new Date().toISOString().split("T")[0];
                                              //  document.getElementById("ToDate").max = new Date().toISOString().split("T")[0];

                                                document.getElementById("ToDate").value = "<?php echo getValueOrDefault("date_to"); ?>";
                                                document.getElementById("FromDate").value = "<?php echo getValueOrDefault("date_from"); ?>";
                                                </script>
                                        </div>                                       
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <?php 
                                    function getDateRangeUrl($range) {
                                        // Get start and end dates based on the time range
                                        switch ($range) {
                                          case 'today':
                                            $start = date('Y-m-d');
                                            $end = $start;
                                            break;
                                          case 'this week':
                                            $start = date('Y-m-d', strtotime('this week'));
                                            $end = date('Y-m-d', strtotime('this week +6 days'));
                                            break;
                                          case 'next week':
                                            $start = date('Y-m-d', strtotime('next week'));
                                            $end = date('Y-m-d', strtotime('next week +6 days'));
                                            break;
                                          case 'this month':
                                            $start = date('Y-m-01');
                                            $end = date('Y-m-t');
                                            break;
                                          case 'next month':
                                            $start = date('Y-m-01', strtotime('next month'));
                                            $end = date('Y-m-t', strtotime('next month'));
                                            break;
                                          default:
                                            return null;
                                        }
                                      return modify_url_params(array(
                                        'date_from'=> $start,
                                        'date_to'=> $end
                                      ));
                                        
                                        // Get current URL and check if it already contains the date range parameter
                                        
                                      }
                                      
                                      function modify_url_params($params) // Get the current URL
                                      {
$url = "http" . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 's' : '') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// Parse the URL and get the query string parameters
$parsed_url = parse_url($url);
parse_str($parsed_url['query'] ?? '', $query_params);

// Update the query string parameters with the given key-value pairs
foreach ($params as $key => $value) {
    $query_params[$key] = $value;
}

// Rebuild the query string and update the URL
$parsed_url['query'] = http_build_query($query_params);
$modified_url = $parsed_url['scheme'] . '://' . $parsed_url['host'] . $parsed_url['path'];
if (!empty($parsed_url['query'])) {
    $modified_url .= '?' . $parsed_url['query'];
} else {
    $modified_url .= '?' . http_build_query($params);
}

return $modified_url;

}
                                    
                                    ?>
                                        
                                        <a href="<?php echo getDateRangeUrl('today'); ?>" class="btn btn-md btn-success">Today</a>
<a href="<?php echo getDateRangeUrl('this week'); ?>" class="btn btn-md btn-success">This Week</a>
<a href="<?php echo getDateRangeUrl('next week'); ?>" class="btn btn-md btn-success">Next Week</a>
<a href="<?php echo getDateRangeUrl('this month'); ?>" class="btn btn-md btn-success">This Month</a>
<a href="<?php echo getDateRangeUrl('next month'); ?>" class="btn btn-md btn-success">Next Month</a>
<button type="submit" class="btn btn-success">Search</button>
                                        <a href="{{route('leave')}}" class="btn btn-md btn-danger">Clear</a>

                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row" id="leaveDisplay" style="display:none;">
                <div class="col-md-12">
                    <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Leave  Summary</h4>
                                <div class="row">
                                    <div class = "col-md-6">
                                        <div class="row">
                                        @canany(['isAdmin', 'isManager']) <label for="fname" class="col-sm-4 text-right control-label col-form-label">Employee Name</label>@endcanany
                                            <div class="col-sm-4" style="line-height: 2.5;"><strong id="n">Name</strong></div>
                                        </div>
                                        <div class="row">
                                            <label for="fname" class="col-sm-4 text-right control-label col-form-label">Total Leaves:</label>
                                            <div class="col-sm-4" style="line-height: 2.5;"><strong id="t">TotalLeaves</strong></div>
                                        </div>
                                        
                                        <div class="row">
                                            <label for="fname" class="col-sm-4 text-right control-label col-form-label">Total Annual Leaves:</label>
                                            <div class="col-sm-4" style="line-height: 2.5;"><strong id="total_annual_leaves">AnnualLeaves</strong></div>
                                        </div>
                                        <div class="row">
                                            <label for="fname" class="col-sm-4 text-right control-label col-form-label">Total Sick Leaves:</label>
                                            <div class="col-sm-4" style="line-height: 2.5;"><strong id="total_sick_leaves">SickLeaves</strong></div>
                                        </div>
                                        <div class="row">
                                            <label for="fname" class="col-sm-4 text-right control-label col-form-label">Leaves Availed:</label>
                                            <div class="col-sm-4" style="line-height: 2.5;"><strong id="l">TakenLeave</strong></div>
                                        </div>
                                        <div class="row">
                                            <label for="fname" class="col-sm-4 text-right control-label col-form-label">Balance Leaves:</label>
                                            <div class="col-sm-4" style="line-height: 2.5;"><strong id="b">BalanceLeave</strong></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        




                                    <div class="row">
                                        <label for="sickleaves" class="col-sm-4 text-right control-label col-form-label">Sick Leaves Availed:</label>
                                        <div class="col-sm-4" style="line-height: 2.5;"><strong id="Sick_Leave">Sick Leaves</strong></div>
                                        </div>
                                        <div class="row">
                                        <label for="annualleaves" class="col-sm-4 text-right control-label col-form-label">Annual Leaves Availed:</label>
                                        <div class="col-sm-4" style="line-height: 2.5;"><strong id="Annual_Leave">Annual Leaves</strong></div>
                                        </div>
                                        <div class="row">
                                        <label for="casualleave" class="col-sm-4 text-right control-label col-form-label">Casual Leave Availed:</label>
                                        <div class="col-sm-4" style="line-height: 2.5;"><strong id="Casual_Leave">Casual Leave</strong></div>
                                        </div>
                                        <div class="row">
                                        <label for="maternityleave" class="col-sm-4 text-right control-label col-form-label">Maternity Leave:</label>
                                        <div class="col-sm-4" style="line-height: 2.5;"><strong id="Maternity_Leave">Maternity Leave</strong></div>
                                        </div>
                                        <div class="row">
                                        <label for="paternityleave" class="col-sm-4 text-right control-label col-form-label">Paternity Leave:</label>
                                        <div class="col-sm-9" style="line-height: 2.5;"><strong id="Paternity_Leave">Paternity Leave</strong></div>
                                        </div>
                                        <div class="row">
                                        <label for="compensatoryleave" class="col-sm-4 text-right control-label col-form-label">Compensatory Leave:</label>
                                        <div class="col-sm-4" style="line-height: 2.5;"><strong id="Compensatory_Leave">Compensatory Leave</strong></div>
                                        </div>
                                        <div class="row">
                                        <label for="unpaidleave" class="col-sm-4 text-right control-label col-form-label">Unpaid Leave:</label>
                                        <div class="col-sm-4" style="line-height: 2.5;"><strong id="Unpaid_Leave">Unpaid Leave</strong></div>
                                    </div>




                                    
                                    </div>
                                </div>


                            </div>
                        
                    </div>
                </div>
            </div>
<script>
    
    function addHoverToShowElement(elementId, showElementId, dat) {
  var element = document.getElementById(elementId);
  var showElement = document.getElementById(showElementId);

  document.getElementById("n").innerHTML = dat.n;
  document.getElementById("t").innerHTML = dat.t;
  document.getElementById("l").innerHTML = dat.l;
  document.getElementById("b").innerHTML = dat.b;
  document.getElementById("total_annual_leaves").innerHTML = dat.total_annual_leaves;
  document.getElementById("total_sick_leaves").innerHTML = dat.total_sick_leaves;
  const leaveTypes = ['Annual Leave', 'Sick Leave', 'Casual Leave', 'Maternity Leave', 'Paternity Leave', 'Compensatory Leave', 'Unpaid Leave', 'Work From Home'];

leaveTypes.forEach((type) => {
   var leaveType = type.split(' ').join('_');
  const element = document.getElementById(leaveType);
  try {
    console.log(dat[leaveType] + " - " + leaveType) ;
    if(parseFloat(dat[leaveType]) > 0 ){
        element.innerHTML = dat[leaveType];
        element.parentElement.parentElement.style.display = "";
    }
    else{
        element.parentElement.parentElement.style.display = "none";
    }
  } catch (error) {
    console.error(error + "leave Type missing" + leaveType)
  }
  
});

    showElement.style.display = "block";


}


</script>


                <div class="row">
                    <div class="col-md-2">
                        @can('isEmployee')
                        <a class="btn btn-lg btn-dark" href="{{route('leave.create')}}">Apply leave</a>
                        @endcan
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                      
                                <!--<table>
                                    <tr> @can('isadmin') 
                                        <td style="width: 95%;"><h5 class="card-title">Leave List</h5></td>
                                        <td><button type="button" onclick="downloadCsv(LEAVES_DATA,'Leaves'+getCurrentDateTime()+'.csv');" class="btn" style="background: skyblue;">Export</button></td>@endcan
                                    <tr>
                                </table> -->
                                

<?php 

if($u["role"] == "admin" ){

	echo '<table>
                                    <tr>
                                        <td style="width: 95%;"><h5 class="card-title">Leave List</h5></td>
                                        <td><button type="button" onclick="downloadCsv(LEAVES_DATA,\'Leaves\'+getCurrentDateTime()+\'.csv\');" class="btn" style="background: skyblue;">Export</button></td>
                                    <tr>
                                </table>';
}


?>
                                
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            @canany(['isAdmin', 'isManager']) <th>Employee name</th>@endcanany
                                            <th>Leave type</th>
                                            <th>Date from</th>
                                            <th>Date to</th>
                                            <th>No. of days</th>
                                            
                                            <th>Reason</th>
                                            <th>Comment</th>
                                            <th>Leave <br>status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $rows = "";
                                            
                                                $leavesList = searchByKeyQuery($leavesList,"employee_id",getValueOrDefault("userid"));
                                                
                                                $leavesList = searchByKeyQuery($leavesList,"leave_type",(getValueOrDefault("leavetype")=="all"?"":getValueOrDefault("leavetype")));
                                                
                                                $leavesList = searchByDateRange($leavesList, "date_from", "date_to", getValueOrDefault("date_from"), getValueOrDefault("date_to"));
                                                
                                                
                                                
                                                
                                                for ($i=0; $i < count($leavesList); $i++) { 
                                                    if(!isConcernedUser($leavesList[$i]["employee_id"],$concernedUsers)){
                                                        // If the user jiski leave print hone waali he is not a concerned user ... just ignore
                                                        continue;
                                                    }
                                                    
                                                    $leaveNow = $leavesList[$i];
                                                    $employeeName = "";
                                                    if($u["role"] == "admin"){
                                                        $employeeName = $userLIST[$leaveNow["employee_id"]];
                                                        
                                                    }
                                                    
                                                    if($u["role"] == "manager"){
                                                        //echo json_encode(userFromUserListById($leaveNow["employee_id"],fetch_users()));
                                                        //exit(); 
                                                        $employeeName = userFromUserListById($leaveNow["employee_id"],fetch_users())["full_name"];
                                                        
                                                    }
                                                    
                                                    $leaveNow["name"] = $employeeName;
                                                    
                                                    $rows = $rows.getRow(
                                                                        getDeff(
                                                                            ($i+1),
                                                                            $leaveNow // Just passing the index ... +1 to make sure it starts from 1
                                                                        ).
                                                                        getDeff(
                                                                            ($employeeName),
                                                                            $leaveNow,
                                                                            ($u["role"] == "employee")
                                                                        ).
                                                                        getDeff(
                                                                 
                                                                 
                                                                            $leaveNow["leave_type"],
                                                                            $leaveNow
                                                                        ).
                                                                        getDeff(
                                                                            $leaveNow["date_from"],
                                                                            $leaveNow
                                                                        ).
                                                                        getDeff(
                                                                            $leaveNow["date_to"],
                                                                            $leaveNow
                                                                        ).
                                                                        getDeff(
                                                                            $leaveNow["days"],
                                                                            $leaveNow
                                                                        ).
                                                                        getDeff(
                                                                            $leaveNow["reason"],
                                                                            $leaveNow
                                                                        ).
                                                                        getDeff(
                                                                            $leaveNow["manager_comment"],
                                                                            $leaveNow
                                                                        ).
                                                                        getDeff(
                                                                            isApprovedSpan($leaveNow["is_approved"]),
                                                                            $leaveNow
                                                                        ).
                                                                        getDeff(
                                                                            
                                                                            ((strtotime($leaveNow["date_to"]) < time()) ? "" : leaveTypeToActionButton($leaveNow["is_approved"],$leaveNow["id"],($leaveNow["employee_id"]==$u["id"])))
                                                                            
                                                                            ,
                                                                            $leaveNow
                                                                            
                                                                            
                                                                        )
                                                                    );
                                                                
                                                }
                                                echo $rows;
                                            ?>
                                        </tbody>
                                    </table>
                                    <script>
                                        function setSelectedValue(selectId, valueName) {
                                            const selectElement = document.getElementById(selectId);
                                            const options = selectElement.options;
                                            
                                                for (let i = 0; i < options.length; i++) {
                                                    if (options[i].value === valueName) {
                                                    selectElement.selectedIndex = i;
                                                    break;
                                                    }
                                                }
                                            }
                                            setSelectedValue("leavetype","<?php echo getValueOrDefault("leavetype"); ?>");
                                            setSelectedValue("userid","<?php echo getValueOrDefault("userid"); ?>");
                                    </script>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @include('admin.includes.footer')   
        </div>
    </div>
@endsection
@section('js')
<!--{{--sweetalert box for deleting start--}}-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.8/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
    function rejectLeave(id)
    {
        const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
        });

        swalWithBootstrapButtons({
            title: 'Are you sure?',
            text: "You won't to reject leave!",
            type: 'warning',
            input: 'text',
            inputPlaceholder: "Write something",
            inputValidator: (value) => {
                if (!value) {
                  return 'You need to write something!'
                }
            },
            showCancelButton: true,
            confirmButtonText: 'Yes, reject it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('reject_comment').value = result.value;      
                document.getElementById('reject-leave-'+id).submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                    'Cancelled',
                    'You have not cancel yet ! Your are safe :)',
                    'error'
                )
            }
        })
    }

    function approveLeave(id)
    {
        const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
        });

        swalWithBootstrapButtons({
            title: 'Are you sure?',
            input: 'text',
            inputPlaceholder: "Write something",
            inputValidator: (value) => {
                if (!value) {
                  return 'You need to write something!'
                }
            },
            text: "You want to approve leave!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, approve leave!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('approve_comment').value = result.value;       
                document.getElementById('approve-leave-'+id).submit();
            } 
            else if (
                //Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                    'Cancelled',
                    'You are safe.You can approve later :)',
                    'error'
                );
            }
        });
    }
</script>
<script>

function isInList(value, list) {
  return list.indexOf(value) !== -1;
}


var dontPrint = [
    "up_file",
    "leave_type","date_from","date_to","days","reason","manager_comment","leave_type_offer","is_approved","created_at","updated_at","fy","join_date"
]



function jsonToCsv(json) {
  const rows = [];

  var headers = Object.keys(json[0]);
  var ret = [];
  for (let i = 0; i < headers.length; i++) {
    const element = headers[i];
    if (isInList(element,dontPrint)){
        continue;
    }
    ret.push(element);
  }
  headers = ret;
  // Add headers to the CSV
  rows.push(headers.join(','));
  
  // Loop through the rows of the JSON and add them to the CSV
  for (const row of json) {
    const values = headers.map(header => row[header]);
    rows.push(values.join(','));
  }
  
  return rows.join('\n');
}

var LEAVES_DATA = <?php 
echo json_encode($leavesList);
?>;


function downloadCsv(json, fileName) {
  // Create a new object to store the data with unique "id" values
  const uniqueData = {};

  // Loop through each object in the original JSON
  json.forEach((item) => {
    // Check if the "id" value of the current object already exists in the new object
    if (!uniqueData.hasOwnProperty(item.id)) {
      // If the "id" value does not exist, add the current object to the new object with the "id" value as the key
      uniqueData[item.id] = item;
    } else {
      // If the "id" value already exists, update the existing object with the values of the current object
      uniqueData[item.id] = Object.assign(uniqueData[item.id], item);
    }
  });

  // Convert unique JSON to CSV
  const csv = jsonToCsv(Object.values(uniqueData));

  // Create a new blob object
  const blob = new Blob([csv], { type: 'text/csv' });

  // Create a temporary anchor element
  const a = document.createElement('a');
  a.download = `${fileName}.csv`;
  a.href = window.URL.createObjectURL(blob);

  // Trigger download
  a.click();

  // Release the URL object
  window.URL.revokeObjectURL(a.href);
}


function getCurrentDateTime() {
  const now = new Date();
  return now.toLocaleString(); // returns date and time in the user's local time zone
}


            </script>
@endsection