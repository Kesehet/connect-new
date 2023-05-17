@extends('admin.layout.master')

@section('content')

    @include('admin.includes.sidebar')

    <div class="page-wrapper">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
    @endif

        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Password Settings</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('change.password')}}">Password</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <form action="{{route('update.password')}}" method="post" class="form-horizontal">
                            @csrf
                            <div class="card-body">
                                <h4 class="card-title">Change password</h4>
                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Current password</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="current_password" class="form-control" id="current_password" placeholder="Enter your current password" required>
                                    </div>
                                </div>
                                <div class="form-group required row">
                                    <label for="new_password" class="col-sm-3 text-right control-label col-form-label">New Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Enter a new password" required pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" title="Password must contain: Only Alphabets and Numbers Minimum 8 characters atleast 1 Alphabet and 1 Number">
                                        <div class="invalid-feedback" style="display: block;">Hints: Only Alphabets and Numbers Minimum 8 Characters like admin123 etc.</div>
                                    </div>
                                </div>
                                <div class="form-group required row">
                                    <label for="confirm_password" class="col-sm-3 text-right control-label col-form-label">Confirm Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Enter confirm your password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary float-right">Change</button>
                                </div>
                                <br><br>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.includes.footer')   
    </div>
    <script type="text/javascript">
        window.onload = function () {
            var txtPassword = document.getElementById("new_password");
            var txtConfirmPassword = document.getElementById("confirm_password");
            txtPassword.onchange = ConfirmPassword;
            txtConfirmPassword.onkeyup = ConfirmPassword;
            function ConfirmPassword() {
                txtConfirmPassword.setCustomValidity("");
                if (txtPassword.value != txtConfirmPassword.value) {
                    txtConfirmPassword.setCustomValidity("Passwords do not match.");
                }
            }
        }
    </script>

@endsection