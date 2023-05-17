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
                            <a href="{{route('profile.personal')}}" class="nav-link alertme">Personal Details</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('profile.education')}}" class="nav-link alertme">Educational Details</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('profile.important')}}" class="nav-link active">Important Details</a>
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
                        <form action="{{route('profile.updateimportant',$userdetail->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="card-body">
                                                                

                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">PAN Card Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="pancard" class="form-control" id="pancard" value="{{  $userdetail->pancard }}" required>
                                    </div>
                                </div>
                                
                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">UAN  Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="uanumber" class="form-control" id="uanumber" value="{{$userdetail->uanumber}}" required>
                                    </div>
                                </div>
                                
                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Aadhar Card Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="aadharcard" class="form-control" id="aadharcard" value="{{$userdetail->aadharcard}}" required>
                                    </div>
                                </div>
                                
                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Bank A/C Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="bknumber" class="form-control" id="bknumber" value="{{$userdetail->bknumber}}" required>
                                    </div>
                                </div>
                                
                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Bank Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="bkname" class="form-control" id="bkname" value="{{$userdetail->bkname}}" required>
                                    </div>
                                </div>
                                
                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">IFSC Code</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="ifscode" class="form-control" id="ifscode" value="{{$userdetail->ifscode}}" required>
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
