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
                            <a href="{{route('profile.education')}}" class="nav-link active">Educational Details</a>
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
                        <form action="{{route('profile.updateducation',$user->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="card-body">
                                
                                
                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Certifications</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="certification" class="form-control" id="certification" value="{{$userdetail->certification}}" required>
                                        <div class="invalid-feedback" style="display: block;">Hints: Add your technical certifications like AWS, Docker, Kubernetes, Redhat Linux etc.</div>
                                    </div>
                                    
                                </div>
                               
                               <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Graduation/Diploma</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="grd_diploma" class="form-control" id="grd_diploma" value="{{$userdetail->grd_diploma}}" required>
                                        <div class="invalid-feedback" style="display: block;">Hints: Your Btech/BCA/Diploma or equilvant degree name.</div>
                                    </div>
                                </div>
                                
                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">University (for Graduation)</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="uni_grd" class="form-control" id="uni_grd" value="{{$userdetail->uni_grd}}" required>
                                        <div class="invalid-feedback" style="display: block;">Hints: Name of your University like Anna University, Punjab University etc.</div>
                                    </div>
                                </div>
                                
                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Institute (for Graduation)</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="inst_grd" class="form-control" id="inst_grd" value="{{$userdetail->inst_grd}}" required>
                                    </div>
                                </div>
                                
                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Year of Passing Graduation</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="year_pass_grd" class="form-control" id="year_pass_grd" value="{{$userdetail->year_pass_grd}}" required>
                                    </div>
                                </div>
                               
                                
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Post Graduation</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="post_grd" class="form-control" id="post_grd" value="{{$userdetail->post_grd}}">
                                    </div>
                                </div>
                               
                               <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">University (for PG)</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="uni_pg" class="form-control" id="uni_pg" value="{{$userdetail->uni_pg}}">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Institute (for PG)</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="inst_pg" class="form-control" id="inst_pg" value="{{$userdetail->inst_pg}}">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Year of Passing PG</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="year_pass_pg" class="form-control" id="year_pass_pg" value="{{$userdetail->year_pass_pg}}">
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