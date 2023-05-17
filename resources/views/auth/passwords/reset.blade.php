<!DOCTYPE html>
<html dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin-panel/assets/images/favicon.png')}}">
        <title>Thinknyx Connect</title>
        <!-- Custom CSS -->
        <link href="{{asset('admin-panel/dist/css/style.min.css')}}" rel="stylesheet">

        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <div class="main-wrapper">
            <div class="preloader">
                <div class="lds-ripple">
                    <div class="lds-pos"></div>
                    <div class="lds-pos"></div>
                </div>
            </div>
            
            <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
        <div class="auth-box bg-dark border-top border-secondary">
            <div id="loginform">
                <div class="text-center p-t-20 p-b-20">
                    <!--<span class="db"><img src="{{asset('admin-panel/assets/images/logo.png')}}" alt="logo" /></span>-->
                    <span class="db"><img src="{{asset('admin-panel/assets/images/logo_thinknyx.png')}}" alt="logo" /></span>
                </div>
                
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    
                    <div class="row p-b-30">
                        <div class="col-12">
                            
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white" id="basic-addon1"><i class="ti-pencil"></i></span>
                                </div>
                                <input id="email" type="email" class="form-control form-control-lg{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="E-Mail Address" aria-label="Username" aria-describedby="basic-addon1" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                </div>
                                <input id="password" type="password" class="form-control form-control-lg{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="password" required pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" title="Password must contain: Only Alphabets and Numbers Minimum 8 characters atleast 1 Alphabet and 1 Number">
                                
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                
                            </div>
                                                        
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                </div>
                                <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="Confirm Password" aria-label="Password" aria-describedby="basic-addon1" required>
                            </div>
                            
                            
                            
                            
                        </div>
                    </div>
                    <div class="row border-top border-secondary">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="p-t-20">
                                    
                                    <button type="submit" class="btn btn-primary">
                                       <i class="fa fa-lock m-r-5"></i>  {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
            
            
        </div>
        <script src="{{asset('admin-panel/assets/libs/jquery/dist/jquery.min.js')}}"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="{{asset('admin-panel/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
        <script src="{{asset('admin-panel/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>

        <script>

$('[data-toggle="tooltip"]').tooltip();
$(".preloader").fadeOut();

$('#to-recover').on("click", function () {
    $("#loginform").slideUp();
    $("#recoverform").fadeIn();
});
$('#to-login').click(function () {

    $("#recoverform").hide();
    $("#loginform").fadeIn();
});
        </script>

    </body>

</html>