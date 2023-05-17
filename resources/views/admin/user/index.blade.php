@extends('admin.layout.master')

@section('content')

<div id="main-wrapper">



<?php 

// echo json_encode(objToArr(get_defined_vars()));

$I_AM = objToArr(Auth::user());





$subOrdinates = getUsersUnderManager($I_AM["id"]);

if($I_AM["role"] == "manager"){
    $subOrdinates = searchByKeyQuery($subOrdinates,"username",getValueOrDefault("search"));
$users = json_decode(json_encode($subOrdinates));

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
    $sql = "SELECT users.*, userdetails.* FROM users LEFT JOIN userdetails ON users.id = userdetails.user_id WHERE users.last_working IS NULL;";
    $result = $conn->query($sql);
    
    // Create an array of user objects where each object is at the position of its ID
    $users = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            
            $row["id"] = $row["user_id"];
            $row["full_name"] = $row["first_name"]." ".$row["last_name"];
            $row = removeCommasFromAssocArrayValues($row);
            unset($row["password"]);
            $row = removeBase64($row,[
                "pancard",
                "bknumber",
                "bkname",
                "ifscode",
                "uanumber",
            ]);
    
            
            $row["approve_leave_count"]="0";
             array_push($users,$row);
        }
    }
    
    
    
    // Close connection
    $conn->close();

    // Return the array of users
    return $users;
}

function removeCommasFromAssocArrayValues($assocArray) {
    foreach ($assocArray as $key => $value) {
            $assocArray[$key] = str_replace(',', '', $value);
    }
    return $assocArray;
}

function removeBase64($assocArray,$list){

    for ($i=0; $i < count($list) ; $i++) { 
        $key = $list[$i];
        if(isset($assocArray[$key])){
            $assocArray[$key] = base64_decode($assocArray[$key]);
        }
    }
    return $assocArray;

    
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
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('user.search')}}" method="GET" class="form-horizontal">
                            <div class="card-body">
                                <h4 class="card-title">Search</h4>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Search by employee name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="search" class="form-control" id="fname" placeholder="Employee name" value="<?php echo getValueOrDefault("search"); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-success">Search</button>
                                    <a href="{{route('user')}}" class="btn btn-md btn-danger">Clear</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-left float-left"><h5 class="card-title m-b-0">Admin</h5></div>
                             <div class="text-right"><a href="#" onclick="downloadCsv('users.csv')" class="btn btn-sm btn-info">Export</a>  </div>   
                        </div>
                        
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Username</th>
                                        <th>Image</th>
                                        <th>Role</th>
                                        <th>Email</th>
                                        <th>Leaves count</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <th>{{$loop->index+1}}</th>
                                        <td>{{$user->username}}</td>

                                        @if($user->image)
                                        <td><img src="{{ asset('uploads/gallery/' . $user->image) }}" width="50px" height="50px" alt="Image"> </td>
                                        @else
                                        <td><img src="{{asset('admin-panel/assets/images/users/d3.jpg')}}" width="50px" height="50px" alt="Image"> </td>
                                        @endif

                                        <td>{{$user->role}}</td>
                                        <td>{{$user->email}}</td>
                                        
                                        <td>
                                            {{$user->approve_leave_count}}
                                        </td>
                                        
                                        <td>
                                            <!--<button type="button"
                                                    username="{{$user->username}}"
                                                    role="{{$user->role}}"
                                                    email="{{$user->email}}"
                                                    salary="{{$user->salary}}"
                                                    phone="{{$user->phone}}"
                                                    address="{{$user->address}}"
                                                    gender="{{$user->gender}}"
                                                    dob="{{$user->dob}}"
                                                    join_date="{{$user->join_date}}"
                                                    job_type="{{$user->job_type}}"
                                                    city="{{$user->city}}"
                                                    age="{{$user->age}}"
                                                    class="view-data btn btn-sm btn-success">View</button>-->
                                            <a href="{{route('user.view',$user->id)}}" class="btn btn-sm btn-success">View</a>        
                                            <a href="{{route('user.edit',$user->id)}}" class="btn btn-sm btn-dark">Edit</a>
                                            <?php /* {{--<a href="{{route('managesalary.detail',$user->id)}}" class="btn btn-sm btn-warning">Payment</a>--}}
                                              <a href="{{route('managesalary.detail',$user->id)}}" class="btn btn-sm btn-warning">Payment</a> */ ?>
                                            <form id="delete-form-{{ $user->id }}" action="{{route('user.delete',$user->id)}}" method="put">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="deletePost({{ $user->id }})" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                            @canany(['isAdmin'])
                            {{ $users->links() }}
                            @endcanany 
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $('.view-data').click(function(){
                var username = $(this).attr('username');
                var role = $(this).attr('role');
                var email = $(this).attr('email');
                var salary = $(this).attr('salary');
                var phone = $(this).attr('phone');
                var address = $(this).attr('address');
                var gender = $(this).attr('gender');
                var dob = $(this).attr('dob');
                var join_date = $(this).attr('join_date');
                var job_type = $(this).attr('job_type');
                var city = $(this).attr('city');
                var age = $(this).attr('age');
                $('#username').text(username);
                $('#role').text(role);
                $('#email').text(email);
                $('#salary').text(salary);
                $('#phone').text(phone);
                $('#address').text(address);
                $('#gender').text(gender);
                $('#dob').text(dob);
                $('#join_date').text(join_date);
                $('#job_type').text(job_type);
                $('#city').text(city);
                $('#age').text(age);
                $('#show-data').modal();
                })
            </script>

            {{--sweetalert box for deleting start--}}
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.8/dist/sweetalert2.all.min.js"></script>

            <script type="text/javascript">
                function deletePost(id)
                {
                    const swalWithBootstrapButtons = swal.mixin({
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger',
                        buttonsStyling: false,
                    });

                   swalWithBootstrapButtons({
                        title: 'Are you sure?',
                                text: "You won't be able to revert this!",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes, delete it!',
                                cancelButtonText: 'No, cancel!',
                                reverseButtons: true
                   }).then((result) => {
                        if (result.value) {
                            event.preventDefault();
                            document.getElementById('delete-form-' + id).submit();
                        } else if (
                                // Read more about handling dismissals
                                result.dismiss === swal.DismissReason.cancel
                                ) {
                                swalWithBootstrapButtons(
                                'Cancelled',
                                'Your file is safe :)',
                                'error'
                                )
                        }
                    })
                }

            </script>
            {{--sweetalert box for deleting end--}}

            <div id="show-data" class="modal fade" id="view-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p id="username"></p>
                            <p id="role"></p>
                            <p id="email"></p>
                            <p id="salary"></p>
                            <p id="phone"></p>
                            <p id="address"></p>
                            <p id="gender"></p>
                            <p id="dob"></p>
                            <p id="join_date"></p>
                            <p id="job_type"></p>
                            <p id="city"></p>
                            <p id="age"></p>
                            <p id="phone"></p>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                    function downloadTableAsCsv(tableId, fileName) {
                        let table = document.getElementById(tableId);
                        let rows = table.querySelectorAll("tr");
                        let csvContent = "data:text/csv;charset=utf-8,";
                        for (let i = 0; i < rows.length; i++) {
                            let cells = rows[i].querySelectorAll("th, td");
                            let row = [];
                            for (let j = 0; j < cells.length; j++) {
                            row.push(cells[j].innerText);
                            }
                            csvContent += row.join(",") + "\n";
                        }
                        let encodedUri = encodeURI(csvContent);
                        let link = document.createElement("a");
                        link.setAttribute("href", encodedUri);
                        link.setAttribute("download", fileName);
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    }
                    function downloadCsv(filename) {
                        var ignoreColumns = [                          
                        ];
                        var jsonList = <?php echo json_encode(( $I_AM["role"] == "admin" ? fetch_users():getUsersUnderManager($I_AM["id"]) )); ?>;

                        // Convert JSON list to array of objects
                        const data = jsonList;//jsonList.map(JSON.parse);
                        
                        // Extract headers from first object
                        const headers = Object.keys(data[0]).filter(key => !ignoreColumns.includes(key));
                        
                        // Map objects to arrays of values and join with commas
                        const rows = data.map(obj => headers.map(header => obj[header]).join(','));
                        
                        // Combine headers and rows into CSV string
                        const csv = [headers.join(','), ...rows].join('\n');
                        
                        // Create download link
                        const link = document.createElement('a');
                        link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv));
                        link.setAttribute('download', filename);
                        link.style.display = 'none';
                        
                        // Add link to DOM and trigger download
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    }

            </script>

            {{--@section('js')--}}
            {{--@endsection--}}


        </div>
        @include('admin.includes.footer')   
    </div>
</div>

@endsection