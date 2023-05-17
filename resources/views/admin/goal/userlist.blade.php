@extends('admin.layout.master')

@section('content')



<?php 


//echo json_encode(objToArr(get_defined_vars()));




$I_AM = objToArr(objToArr(get_defined_vars())["user"]);




    $subOrdinates = getUsersUnderManager($I_AM["id"] , ($I_AM["role"] == "admin"));

    $tempUsers =  $subOrdinates;
    $users = json_decode(json_encode($tempUsers));


//


//echo json_encode($appraisalcnt);
//echo json_encode(searchByKeyQuery($subOrdinates,"id",getValueOrDefault("uid")));

function arrayToObject($array) {
    if (is_array($array)) {
        return (object) array_map(__FUNCTION__, $array);
    } else {
        return $array;
    }
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

function getValueOrDefault($value,$default="") {
    if (isset($_GET[$value])) {
        return $_GET[$value];
    } else {
        return $default;
    }
}


function objToArr($obj){
        return json_decode(json_encode( 
            $obj,true
        ),true);
}

function userFromUserListById($id,$list){
    for ($i=0; $i < count($list); $i++) { 
        if(intval($list[$i]["id"]) == intval($id)){
            return $list[$i];
        }
    }
    return null;
}
function getRow($dat){
    return "<tr>".$dat."</tr>";
}
function getDeff($dat,$pleaseNull = false,$nullWithDeff = true){
    if($nullWithDeff == false){return "<td></td>";}
    if($pleaseNull){return "";}

    return "<td>".$dat."</td>";
}

function getUsersUnderManager($managerID, $showAll = false){
    //we first get the manager from the list ....
    $usersList = fetch_users();
    $managerObj = userFromUserListById($managerID,$usersList);
    $ret = array();
    // We then find users with manager name same as our manager
    for ($i=0; $i  < count($usersList) ; $i++) { 
        
        
            $managerName = $managerObj["full_name"];
        if($managerName == $usersList[$i]["manager"]  || $showAll){
            $uNow = $usersList[$i];
            

            
            array_push($ret,$uNow);
        }
    }
    //$ret = arrayToObject($ret);
  
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

function get_goal_count($user_id, $goal_type="func") {
    $GOALS = array(
        "func"=>2,
        "prof"=>3
    );
    $goal_type = $GOALS[$goal_type];
    $status = 2;
    $fy = getValueOrDefault("fy",(intval(date("Y"))-1)."-".date("y"));
    $conn = the_conn();
    $sql = "SELECT COUNT(*) AS g_Count FROM goals WHERE user_id = ".$user_id." AND (status = 1 OR status = 2) AND fy = '".$fy."' AND goal_type = ". $goal_type;
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $count = intval($row["g_Count"]);
        }
    }


    $conn->close();
    return $count;
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
function getButton($userID){
    $ret = "";
    if (get_goal_count($userID,"func") == 5 ) {
        $ret .= '<a href="' . route('goal', 'uid=' . $userID) . '" class="btn btn-sm btn-success">View Goals</a>';
      } else {
        $ret .= '<button type="button" name="button_x" class="btn btn-sm btn-dark" disabled="disabled">View Goals</button>';
      }
      
       if (get_goal_count($userID,"prof") == 1) {
        $ret .= '<a href="' . route('appraisal.createfun', 'uid=' . $userID) . '" class="btn btn-sm btn-success" style="margin-left:8px;">View Personal Goal</a>';
       }
       return $ret;
}

?>

    <div id="main-wrapper">

        @include('admin.includes.sidebar')

        <div class="page-wrapper">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Admin Manager</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('user')}}">User</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-b-0">Admin</h5>
                            </div>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Name</th>
                                    <th>Functional Goals Submitted</th>
                                    <th>Professional Goals Submitted</th>
                                    
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php 
                                        for ($i=0; $i < count($users) ; $i++) { 
                                            $user = $users[$i];
                                            echo getRow(
                                                getDeff(
                                                    ($i+1)
                                                )
                                                .getDeff(
                                                    $user->full_name
                                                )
                                                .getDeff(
                                                    get_goal_count($user->id,"func")
                                                )
                                                .getDeff(
                                                    get_goal_count($user->id,"prof")
                                                )
                                                .getDeff(
                                                    getButton($user->id)
                                                )
                                            );
                                        }     
                                                

                                ?>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function addOnClickToElementsWithName(name) {
    
                let elements = document.getElementsByName(name);
                
                for (let i = 0; i < elements.length; i++) {
                    elements[i].disabled = false;
                elements[i].addEventListener("click", function() {
                    alert("The User has not yet completed the goals.");
                });
                }
            }
            

            function setYear(y){

                    fetch("http://localhost/Connect/public/user/changefy", {
                    "headers": {
                        "accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
                        "accept-language": "en-US,en;q=0.9",
                        "cache-control": "max-age=0",
                        "content-type": "application/x-www-form-urlencoded",
                        "sec-ch-ua": "\"Google Chrome\";v=\"111\", \"Not(A:Brand\";v=\"8\", \"Chromium\";v=\"111\"",
                        "sec-ch-ua-mobile": "?0",
                        "sec-ch-ua-platform": "\"Windows\"",
                        "sec-fetch-dest": "document",
                        "sec-fetch-mode": "navigate",
                        "sec-fetch-site": "same-origin",
                        "sec-fetch-user": "?1",
                        "upgrade-insecure-requests": "1"
                    },
                    "referrer": "http://localhost/Connect/public/goal/userlist",
                    "referrerPolicy": "strict-origin-when-cross-origin",
                    "body": "_token="+document.getElementsByClassName("form-horizontal")[0].children[0].value+"&fy_year="+y,
                    "method": "POST",
                    "mode": "cors",
                    "credentials": "include"
                    });
            }
            addOnClickToElementsWithName("button_x");
            document.getElementById("fy_year").onchange = ()=>{
                var yearToSet = document.getElementById("fy_year").value;
                console.log(yearToSet);
                
                setYear(yearToSet);
                document.location.href = addGetParamToUrl(document.location.href,"fy",yearToSet)
                
            }

            function addGetParamToUrl(url, paramName, paramValue) {
                let param = encodeURIComponent(paramName) + "=" + encodeURIComponent(paramValue);
                if (url.indexOf("?") === -1) {
                    // URL doesn't have any GET parameters yet
                    return url + "?" + param;
                } else {
                    // URL already has GET parameters
                    let parts = url.split("?");
                    let base = parts[0];
                    let query = parts[1];
                    if (query.indexOf(paramName) === -1) {
                    // The parameter doesn't exist in the URL yet
                    return url + "&" + param;
                    } else {
                    // The parameter already exists in the URL
                    let params = query.split("&");
                    for (let i = 0; i < params.length; i++) {
                        let parts = params[i].split("=");
                        let name = decodeURIComponent(parts[0]);
                        if (name === paramName) {
                        // Replace the existing parameter value
                        parts[1] = encodeURIComponent(paramValue);
                        params[i] = parts.join("=");
                        break;
                        }
                    }
                    return base + "?" + params.join("&");
                    }
                }
            }
            function getGetParamFromUrl(paramName, url) {
                if (!url) {
                    url = window.location.href;
                }
                paramName = paramName.replace(/[\[\]]/g, "\\$&");
                let regex = new RegExp("[?&]" + paramName + "(=([^&#]*)|&|#|$)");
                let results = regex.exec(url);
                if (!results) {
                    return null;
                }
                if (!results[2]) {
                    return "";
                }
                return decodeURIComponent(results[2].replace(/\+/g, " "));
            }

            document.getElementById("fy_year").value = getGetParamFromUrl("fy");
                </script>
        </div>
            @include('admin.includes.footer')   
        </div>
    </div>

    @endsection