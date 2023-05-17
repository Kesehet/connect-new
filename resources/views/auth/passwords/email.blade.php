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


                        <div class="text-center">
                            <span class="text-white">Enter your e-mail address below and we will send you instructions how to recover a password.</span>
                        </div>
                        <div class="row m-t-20">

                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif

                            <!-- Form -->
                            <form class="col-12" action="{{ route('password.email') }}" role="form" method="POST">
                                <!-- email -->
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                    </div>
                                    <!--<input type="text" class="form-control form-control-lg" placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1">-->
                                    <input id="email" type="email" placeholder="Email Address"  class="form-control form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif

                                </div>
                                <!-- pwd -->
                                <div class="row m-t-20 p-t-20 border-top border-secondary">
                                    <div class="col-12">
                                        <a class="btn btn-success" href="{{ route('login') }}" id="to-login" name="action">Back To Login</a>
                                        <!--<button class="btn btn-info float-right" type="submit" name="action">Recover</button>-->
                                        <input type="submit" class="btn btn-primary float-right" value="{{ __('Send Password Reset Link') }}" />
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>

                </div>
            </div>
        </div>
        <script src="{{asset('admin-panel/assets/libs/jquery/dist/jquery.min.js')}}"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="{{asset('admin-panel/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
        <script src="{{asset('admin-panel/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>

        <script type="text/javascript">

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

          $(function(){
             $('form').submit(function(){ 
                $("input[type='submit']", this).val("Please Wait...").attr('disabled', 'disabled');
                return true;
              });
          });
        </script>

    </body>

</html>