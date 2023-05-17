@extends('admin.layout.master')
@section('content')

<?php 

//echo json_encode(objToArr(get_defined_vars()));


$I_AM = objToArr(objToArr(get_defined_vars())["user"]);

$subOrdinates = getUsersUnderManager($I_AM["id"]);
//echo json_encode($subOrdinates);
//echo json_encode(searchByKeyQuery($subOrdinates,"id",getValueOrDefault("uid")));


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

function userFromUserListById($id,$list){
    for ($i=0; $i < count($list); $i++) { 
        if(intval($list[$i]["id"]) == intval($id)){
            return $list[$i];
        }
    }
    return null;
}


function getUsersUnderManager($managerID){
    //we first get the manager from the list ....
    $usersList = fetch_users();
    $managerObj = userFromUserListById($managerID,$usersList);
    $ret = array();
    // We then find users with manager name same as our manager
    for ($i=0; $i  < count($usersList) ; $i++) { 
        
        
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
    $sql = "SELECT * FROM users";
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



<div id="main-wrapper">
    @include('admin.includes.sidebar')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <!--<h4 class="page-title">Goal Management</h4>-->
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('goal')}}">Goal</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
          <form action="{{route('goal.storemutiple')}}" method="post" class="form-horizontal">
            @csrf
            @if(Request::get('uid') > 0) 
            <input type="hidden" name="uid" class="form-control" id="uid" placeholder="Hidden" value="{{ Request::get('uid') }}">
            @endif
            
                <div class="row">
                                        
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Organizational Goals</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S.N.</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orgoals as $goal)
                                            <tr>
                                                <td>{{$loop -> index+1 }}</td>
                                                 <td title="{{$goal->title}}">{!! Str::words($goal->title, 5, '..') !!}</td>
                                                 <td title="{!!strip_tags(htmlspecialchars_decode($goal->description))!!}">{!! Str::words($goal->description, 6, '..') !!}</td>
                                                 <td>Approved</td>
                                                <td>
                                                    <a href="{{route('goal.view',$goal->id)}}" class="btn btn-sm btn-dark" style="float: left;margin-right: 5px;">View</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                    
                    <div class="col-md-5">
                        @canany(['isEmployee', 'isManager']) 
                        @if($goalcnt >= 5)
                        <button type="button" name="submit" class="btn btn-dark" disabled>Add Functional  Goal</button>
                        @else
                        <a class="btn btn btn-dark" href="{{route('goal.create')}}">Add Functional Goal</a>
                        @endif
                        @endcanany

                        @canany(['isEmployee', 'isManager']) 
                        @if($goalcntpd >= 1 || $goalcntZero == 0)
                        <button type="button" name="submit" class="btn btn-dark" disabled>Add PDP Goal</button>
                        @else
                        <a class="btn btn btn-dark" href="{{route('goal.createpd')}}">Add PDP Goal</a>
                        @endif
                        @endcanany
                    </div>
                    
                    
                    
                    
                    
                    

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Functional Goals</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <!--@can('isAdmin')
                                                <th><div class="checkbox select-all">
                                                        <input id="all" type="checkbox" />
                                                    </div>
                                                </th>
                                                @endcan-->
                                                <th>S.N.</th>
                                                 <th>Title</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Options</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($goals as $goal)

                                            <tr>
                                                <!--@can('isAdmin')
                                                <td>
                                                    <div class="checkbox rows">
                                                        @if($goal->status != 2)
                                                        <input name="selected[]" type="checkbox" value="{{ $goal->id }}" />
                                                        @endif
                                                    </div>
                                                </td>
                                                @endcan-->
                                                <td>{{$loop -> index+1 }}</td>
                                                 <td>{{$goal->title}}</td>
                                                <!--<td>{{$goal->users->username }}</td>-->
                                                 <td title="{!!strip_tags(htmlspecialchars_decode($goal->description))!!}">{!! Str::words($goal->description, 20, ' ...') !!}</td>
                                                
                                                <td>
                                                    @if($goal->status == 0)
                                                    Pending
                                                    @elseif($goal->status == 1)
                                                    Submitted
                                                    @elseif($goal->status == 2)
                                                    Approved
                                                    @elseif($goal->status == 3)
                                                    Returned
                                                    @endif
                                                </td>
                                                <td>
                                                    @canany(['isEmployee', 'isManager']) 
                                                    @if($goal->status == 0 || $goal->status == 3)
                                                    <a href="{{route('goal.edit',$goal->id)}}" class="btn btn-sm btn-dark" style="float: left;margin-right: 5px;">Edit</a>
                                                    @endif
                                                    @endcanany

                                                    <a href="{{route('goal.view',$goal->id)}}" class="btn btn-sm btn-dark" style="float: left;margin-right: 5px;">View</a>

                                                    <!--<form id="delete-form-{{ $goal->id }}" action="{{route('goal.delete',$goal->id)}}" method="put">
                                                     @csrf
                                                     @method('DELETE')
                                                     <button type="submit" onclick="return confirm('Are you sure want to delete?')" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>-->
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                    {{ $goals->links() }}
                                </div>
                               
                            </div>
                            
                            
                            <div class="card-body">
                                <h5 class="card-title">Professional Development Plan Goal</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>

                                                <th>S.N.</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Options</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($goalspd as $goal)

                                            <tr>
                                                <td>{{$loop -> index+1 }}</td>
                                                <!--<td>{{$goal->users->username }}</td>-->
                                                 <td>{{$goal->title}}</td>
                                                <td title="{!!strip_tags(htmlspecialchars_decode($goal->description))!!}">{!! Str::words($goal->description, 20, ' ...') !!}</td>
                                                <td>
                                                    @if($goal->status == 0)
                                                    Pending
                                                    @elseif($goal->status == 1)
                                                    Submitted
                                                    @elseif($goal->status == 2)
                                                    Approved
                                                    @elseif($goal->status == 3)
                                                    Returned
                                                    @endif
                                                </td>
                                                <td>

                                                
                                                    @canany(['isEmployee', 'isManager']) 
                                                    @if($goal->status == 0 || $goal->status == 3)
                                                    <a href="{{route('goal.edit',$goal->id)}}" class="btn btn-sm btn-dark" style="float: left;margin-right: 5px;">Edit</a>
                                                    @endif
                                                    @endcanany
                                                    @can('isAdmin')
                                                    @endcan
                                                    <a href="{{route('goal.view',$goal->id)}}" class="btn btn-sm btn-dark" style="float: left;margin-right: 5px;">View</a>
                                                    <!--<form id="delete-form-{{ $goal->id }}" action="{{route('goal.delete',$goal->id)}}" method="put">
                                                     @csrf
                                                     @method('DELETE')
                                                     <button type="submit" onclick="return confirm('Are you sure want to delete?')" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>-->
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                    {{ $goals->links() }}
                                </div>
                                
                                
                                <div class="border-top" style="padding-top: 5px;">
                                    @canany(['isEmployee', 'isManager']) 
                                    @if($goalcntZero == 6)
                                    <!--<button type="submit" name="submit_x" class="btn btn-dark" value="submitted">Submit</button>-->
                                    <button type="button" class="btn btn-dark" name="button" data-toggle="modal" data-target="#ModalCenterOne">Submit</button>
                                    @else
                                    <button type="button" name="submit_x" onclick="submitWasClicked()" class="btn btn-dark" value="submitted" >Submit</button>
                                    @endif
                                    @endcanany

                                    @canany(['isAdmin']) 
                                    
                                    @if($goalcntThree >= 5 && Request::get('uid') > 0)
                                    <button type="button" class="btn btn-dark" name="button" data-toggle="modal" data-target="#ModalCenterTwo">Approve</button>&nbsp;&nbsp;
                                    <button type="button" class="btn btn-dark" name="button" data-toggle="modal" data-target="#ModalCenterThree">Return</button>
                                    @else
                                    <button type="button" class="btn btn-dark" name="button" data-toggle="modal"  disabled="disabled">Approve</button>&nbsp;&nbsp;
                                    <button type="button" class="btn btn-dark" name="button" data-toggle="modal" disabled="disabled">Return</button>
                                    @endif
                                                                        
                                    <!--<button type="submit" name="submit_x" class="btn btn-dark" value="approved">Approve</button>&nbsp;&nbsp;
                                    <button type="submit" name="submit_x" class="btn btn-dark" value="returned">Return</button>-->
                                    @endcanany
                                    <?php 
                                    $idAskedFor = getValueOrDefault("uid");
                                    if($idAskedFor == ""){
                                        $idAskedFor = $I_AM["id"];
                                    }  
                                    if ($goalcntThree >= 5 && Request::get('uid') > 0 && $I_AM["role"] == "manager" && $I_AM["id"] != $idAskedFor ){
                                        echo '<button type="button" class="btn btn-dark" name="button" data-toggle="modal" data-target="#ModalCenterTwo">Approve</button>&nbsp;&nbsp;';
                                        echo '<button type="button" class="btn btn-dark" name="button" data-toggle="modal" data-target="#ModalCenterThree">Return</button>';
                                    }
                                    
                                    ?>

                                    <!--<button class="btn btn-success add-more" type="button" style="float: right;"><i class="glyphicon glyphicon-plus"></i> Add More</button>-->
                               </div>
                             
                            </div>
                            



                        </div>
                    </div>

                </div>
            
           </form>
        </div>

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
                        Please review your goals before submission. After submission you will not be able to amend it.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a  class="btn btn-primary" href="{{route('goal.storemutiple','submit_x=submitted')}}">Save Changes</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end here -->
        
        <!-- Modal -->
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
                        Are you sure, you want to approve the goals?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a  class="btn btn-primary" href="{{route('goal.storemutiple','submit_x=approved&uid='.Request::get('uid'))}}">Save Changes</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end here -->
        
        <!-- Modal -->
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
                        Are you sure, you want to return the goals?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a  class="btn btn-primary" href="{{route('goal.storemutiple','submit_x=returned&uid='.Request::get('uid'))}}">Save Changes</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end here -->


        <script type="text/javascript">
            $('#all').change(function (e) {
                if (e.currentTarget.checked) {
                    $('.rows').find('input[type="checkbox"]').prop('checked', true);
                } else {
                    $('.rows').find('input[type="checkbox"]').prop('checked', false);
                }
            });
        </script> 
        <script>
            function submitWasClicked(){
                if(document.getElementsByName("submit_x").length  > 0){
                
                    alert("Complete all 5 functional and 1 professional goals before submission.")
                }
            }
        </script>







        @include('admin.includes.footer')   
    </div>
</div>

@endsection