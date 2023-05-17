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
                            <a href="{{route('profile.important')}}" class="nav-link alertme">Important Details</a>
                        </li>
                        @can('isAdmin')
                        <li class="nav-item">
                            <a href="{{route('profile.exitdetails')}}" class="nav-link active">Exit Details</a>
                        </li>
                        @endcan
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="home">
                            
                            <p>
                             
                            <div class="card" style="margin-top: -15px;">
                        <form action="{{route('profile.updatexit',$user->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="card-body">
                                
                                

                                <div class="form-group required row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Last working Day</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="last_working" class="form-control" id="last_working" value="{{$user->last_working}}" required>
                                    </div>
                                </div>
                                
                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Reason for Exit</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" name="reason_exit" class="form-control" placeholder="Reason" required>{{$user->reason_exit}}</textarea>
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