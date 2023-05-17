@extends('admin.layout.master')

@section('content')

<div id="main-wrapper">
    @include('admin.includes.sidebar')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('profile')}}">Profile</a></li>
                            </ol>
                        </nav>
                    </div>
                    
                    
                </div>
            </div>
        </div>

        <div class="col-12 d-flex no-block align-items-center">
            
            <div class="bs-example" style="width: 98%">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="{{route('profile.edit')}}" class="nav-link alertme">Basic Details</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('profile.personal')}}" class="nav-link active">Personal Details</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('profile.education')}}" class="nav-link alertme">Educational Details</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('profile.important')}}" class="nav-link alertme">Important Details</a>
                        </li>
                         @can('isAdmin')
                        <li class="nav-item">
                            <a href="{{route('profile.exitdetails')}}" class="nav-link alertme">Exit Details</a>
                        </li>
                        @endcan
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="home">
                            
                            <p>
                             
                            <div class="card" style="margin-top: -15px;">
                        <form action="{{route('profile.updatepersonal',$user->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="card-body">
                                                              
                               
                                <div class="form-group required row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Skills</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="skills" class="form-control" id="skills" value="{{$user->skills}}" required>
                                    </div>
                                </div>
                               
                                 <div class="form-group required row">
                                    <label for="phone" class="col-sm-3 text-right control-label col-form-label">Mobile number</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="phone" class="form-control" id="phone" value="{{$user->phone}}" required>
                                    </div>
                                </div>
                                
                                <div class="form-group required row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Date of Birth</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="dob" class="form-control" id="dob" value="{{$user->dob}}" onblur="ageCalculate()" required>
                                    </div>
                                </div>


                                <div class="form-group required row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="email" class="form-control" id="lname" value="{{$user->email}}" required>
                                    </div>
                                </div>
                                
                                 <div class="form-group  required row">
                                    <label for="age" class="col-sm-3 text-right control-label col-form-label">Age (Years)</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="age" class="form-control" id="age" value="{{$user->age}}" required>
                                    </div>
                                </div>

                               

                                <div class="form-group required row">
                                    <label for="address" class="col-sm-3 text-right control-label col-form-label">Permanent Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="address" class="form-control" id="address" value="{{$user->address}}" required>
                                    </div>
                                </div>
                                
                                <div class="form-group required row">
                                    <label for="address" class="col-sm-3 text-right control-label col-form-label">Current Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="current_address" class="form-control" id="current_address" value="{{$user->current_address}}" required>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group  required row">
                                    <label for="phone" class="col-sm-3 text-right control-label col-form-label">Previous Org</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="pre_org" class="form-control" id="pre_org" value="{{$user->pre_org}}" required>
                                    </div>
                                </div>
                                
                                <div class="form-group required row">
                                    <label for="phone" class="col-sm-3 text-right control-label col-form-label">Total Experience (yrs.) before joining Thinknyx</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="exp_bfjoin" class="form-control" id="exp_bfjoin" value="{{$user->exp_bfjoin}}" required>
                                    </div>
                                </div>
                                
                                <div class="form-group  required row">
                                    <label for="phone" class="col-sm-3 text-right control-label col-form-label">Emergency Contact Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="emr_contact_no" class="form-control" id="emr_contact_no" value="{{$user->emr_contact_no}}" required>
                                    </div>
                                </div>
                                
                                <div class="form-group required row">
                                    <label for="phone" class="col-sm-3 text-right control-label col-form-label">Emergency Contact Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="emr_contact_name" class="form-control" id="emr_contact_name" value="{{$user->emr_contact_name}}" required>
                                    </div>
                                </div>
                                
                                <div class="form-group required row">
                                    <label for="phone" class="col-sm-3 text-right control-label col-form-label">Relationship with emergency contact</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="rel_emr_contact" class="form-control" id="rel_emr_contact" value="{{$user->rel_emr_contact}}" required>
                                    </div>
                                </div>
                                
                                 <div class="form-group required row">
                                    <label for="phone" class="col-sm-3 text-right control-label col-form-label">Personal Mail ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="email_personal" class="form-control" id="email_personal" value="{{$user->email_personal}}" required>
                                    </div>
                                </div>
                                
                                <div class="form-group  required row">
                                    <label for="phone" class="col-sm-3 text-right control-label col-form-label">Father's Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="father_name" class="form-control" id="father_name" value="{{$user->father_name}}" required>
                                    </div>
                                </div>
                                
                                <div class="form-group required row">
                                    <label for="phone" class="col-sm-3 text-right control-label col-form-label">Marital Status</label>
                                    <div class="col-sm-9">
                                        <select type="text" name="mrtl_status" class="form-control" id="mrtl_status" value="{{$user->mrtl_status}}" required>
                                            <option value="" disabled selected>Select Marital Status</option>
                                            <option value="Single" {{ ($user->mrtl_status == 'Single'?'selected':'') }}>Single</option>
                                            <option value="Married" {{ ($user->mrtl_status == 'Married'?'selected':'') }}>Married</option>
                                            <option value="Widowed" {{ ($user->mrtl_status == 'Widowed'?'selected':'') }}>Widowed</option>
                                            <option value="Separated" {{ ($user->mrtl_status == 'Separated'?'selected':'') }}>Separated</option>
                                            <option value="Divorced" {{ ($user->mrtl_status == 'Divorced'?'selected':'') }}>Divorced</option>
                                        </select>
                                    
                                    </div>
                                </div>
                                
                                <div class="form-group  required row">
                                    <label for="phone" class="col-sm-3 text-right control-label col-form-label">Spouse Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="spous_name" class="form-control" id="spous_name" value="{{$user->spous_name}}" required>
                                    </div>
                                </div>
                                
                                <div class="form-group required row">
                                    <label for="phone" class="col-sm-3 text-right control-label col-form-label">Blood Group</label>
                                    <div class="col-sm-9">
                                        <select type="text" name="blood_group" class="form-control" id="blood_group" value="{{$user->blood_group}}" required>
                                            <option value="" disabled selected>Select Your Blood Group</option>
                                            <option value="A+" {{ ($user->blood_group == 'A+')? 'selected' : '' }}>A+</option>
                                            <option value="A-" {{ ($user->blood_group == 'A-')? 'selected' : '' }}>A-</option>
                                            <option value="B+" {{ ($user->blood_group == 'B+')? 'selected' : '' }}>B+</option>
                                            <option value="B-" {{ ($user->blood_group == 'B-')? 'selected' : '' }}>B-</option>
                                            <option value="O+" {{ ($user->blood_group == 'O+')? 'selected' : '' }}>O+</option>
                                            <option value="O-" {{ ($user->blood_group == 'O-')? 'selected' : '' }}>O-</option>
                                            <option value="AB+" {{ ($user->blood_group == 'AB+')? 'selected' : '' }}>AB+</option>
                                            <option value="AB-" {{ ($user->blood_group == 'AB-')? 'selected' : '' }}>AB-</option>
                                            <option value="Unknown" {{ ($user->blood_group == 'Unknown')? 'selected' : '' }}>Unknown</option>
                                        </select>
                                        
                                    </div>
                                </div>
                                

                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-dark">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
               
                            </p>
                        </div>
                        <div class="tab-pane fade" id="profile">
                            <h4 class="mt-2">Profile tab content</h4>
                            <p>Vestibulum nec erat eu nulla rhoncus fringilla ut non neque. Vivamus nibh urna, ornare id gravida ut, mollis a magna. Aliquam porttitor condimentum nisi, eu viverra ipsum porta ut. Nam hendrerit bibendum turpis, sed molestie mi fermentum id. Aenean volutpat velit sem. Sed consequat ante in rutrum convallis. Nunc facilisis leo at faucibus adipiscing.</p>
                        </div>
                        <div class="tab-pane fade" id="messages">
                            <h4 class="mt-2">Messages tab content</h4>
                            <p>Donec vel placerat quam, ut euismod risus. Sed a mi suscipit, elementum sem a, hendrerit velit. Donec at erat magna. Sed dignissim orci nec eleifend egestas. Donec eget mi consequat massa vestibulum laoreet. Mauris et ultrices nulla, malesuada volutpat ante. Fusce ut orci lorem. Donec molestie libero in tempus imperdiet. Cum sociis natoque penatibus et magnis.</p>
                        </div>
                    </div>
                </div>
            
        </div>

       @include('admin.includes.footer')   
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.8/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
    function ageCalculate() {
       
        var birthDate = document.getElementById('dob').value;

        var mdate = birthDate.toString();
        var yearThen = parseInt(mdate.substring(0, 4), 10);
        var monthThen = parseInt(mdate.substring(5, 7), 10);
        var dayThen = parseInt(mdate.substring(8, 10), 10);

        var today = new Date();
        var birthday = new Date(yearThen, monthThen - 1, dayThen);
        //   alert(today.valueOf() + " " + birthday.valueOf());
        var differenceInMilisecond = today.valueOf() - birthday.valueOf();
        //  alert(differenceInMilisecond);

        var year_age = Math.floor(differenceInMilisecond / 31536000000);
                
        if (isNaN(year_age)){
           document.getElementById('age').value =  0; 
        }else{
           document.getElementById('age').value =  year_age; 
        }     
               
       
        
    }
    
    $(".alertme").click(function () {
        event.preventDefault();
        const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
        });

        swalWithBootstrapButtons({
            title: 'Are you sure?',
            text: "You have saved your current data!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, I have saved!',
            cancelButtonText: 'No, Not saved!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                window.location.href = this.href
            } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                    ) {
                swalWithBootstrapButtons(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                        );
            }
        });
    });
    
</script>
@stop
