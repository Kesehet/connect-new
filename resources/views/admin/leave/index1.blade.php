<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset(get_defined_vars()["user"])){
    $u = get_defined_vars()["user"];    
}

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

?>


@extends('admin.layout.master')

@section('content')

    <div id="main-wrapper">
    @include('admin.includes.sidebar')
        <div class="page-wrapper">
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
                    <div class="col-md-12">
                        <div class="card">

                            <form action="<?php 
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
                                                function leaveTypeToActionButton($stat,$leaveID){
                                                    switch (intval($stat)) {
                                                        case 0:
                                                            return '<form id="approve-leave-'.$leaveID.'" action="'.route('leave.approve',$leaveID).'" method="POST">
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
                                                        </form>';
                                                            break;
                                                        case 1:
                                                            return '<form id="reject-leave-'.$leaveID.'" action="'.route('leave.approve',$leaveID).'" method="POST">
                                                            '.csrf_field().'
                                                            <input type="hidden" name="approve"  value="3">
                                                            <input type="hidden" name="approve_comment" id="reject_comment" value="">
                                                            <button type="button" onclick="rejectLeave('.$leaveID.')" class="btn btn-sm btn-danger" name="approve">Reject</button>
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
                                                    $from_timestamp = strtotime("-365 days"); // Default value for date-from
                                                    $to_timestamp = time(); // Default value for date-to
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
                                                

                                                //_________________________________________________________________________
                                                /*
                                                    
                                                    NOTE: The employee login lacks user role identifier only on the search page.
                                                */

                                                $open= '<div class="col-sm-3" UniqueStr ><select type="text" name="userid" class="form-control" id="userid" placeholder="Select User"  ><option value="">-Select User-</option>';
                                                $mid="";
                                                $close='</select></div>';
                                                try {
                                                    $leavesList = objToArr(objToArr(get_defined_vars()["leaves"])["data"]);
                                                    

                                                    // Get All Users
                                                    $userLIST = (gettype(objToArr(get_defined_vars()["userlist"])) == "string" ? array():objToArr(get_defined_vars()["userlist"]) );
                                                    // Get a list (id) of only concerned users ... 
                                                    $concernedUsers = array();
                                                    $ids = array_keys($userLIST);
                                                    
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
                                                document.getElementById("FromDate").max = new Date().toISOString().split("T")[0];
                                                document.getElementById("ToDate").max = new Date().toISOString().split("T")[0];

                                                document.getElementById("ToDate").value = "<?php echo getValueOrDefault("date_to"); ?>";
                                                document.getElementById("FromDate").value = "<?php echo getValueOrDefault("date_from"); ?>";
                                                </script>
                                        </div>                                       
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-success">Search</button>
                                        <a href="{{route('leave')}}" class="btn btn-md btn-danger">Clear</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2">
                        @can('isEmployee')
                        <a class="btn btn-lg btn-dark" href="{{route('leave.create')}}">Apply leave</a>
                        @endcan
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Leave List</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            @canany(['isAdmin', 'isManager']) <th>Employee <br>name</th>@endcanany
                                            <th>Leave <br> type</th>
                                            <th>Date <br>from</th>
                                            <th>Date <br>to</th>
                                            <th>No. of <br>days</th>
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
                                                        // If the user whose leave has to be printed, is not a concerned user ... just ignore
                                                        continue;
                                                    }
                                                    $leaveNow = $leavesList[$i];
                                                    $rows = $rows.getRow(
                                                                        getDeff(
                                                                            ($i+1) // Just passing the index ... +1 to make sure it starts from 1
                                                                        ).
                                                                        getDeff(
                                                                            (isset($userLIST[$leaveNow["employee_id"]]) ? $userLIST[$leaveNow["employee_id"]]:"" ),
                                                                            ($u["role"] != "admin")
                                                                        ).
                                                                        getDeff(
                                                                            $leaveNow["leave_type"]
                                                                        ).
                                                                        getDeff(
                                                                            $leaveNow["date_from"]
                                                                        ).
                                                                        getDeff(
                                                                            $leaveNow["date_to"]
                                                                        ).
                                                                        getDeff(
                                                                            $leaveNow["days"]
                                                                        ).
                                                                        getDeff(
                                                                            $leaveNow["reason"]
                                                                        ).
                                                                        getDeff(
                                                                            $leaveNow["manager_comment"]
                                                                        ).
                                                                        getDeff(
                                                                            isApprovedSpan($leaveNow["is_approved"])
                                                                        ).
                                                                        getDeff(
                                                                            ($u["role"] == "admin" ?
                                                                            leaveTypeToActionButton($leaveNow["is_approved"],$leaveNow["id"]):
                                                                            "")
                                                                            
                                                                            
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
<!--{{--alert box for deleting start--}}-->
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
@endsection