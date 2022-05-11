<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php if (isset($page_title)){ echo $page_title; } ?></title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('public/assets/images/favicon.ico')}}">

        <!-- App css -->
        <link href="{{asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    
    </head>

    <body class="authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">

                            <div class="card-body p-4">
                                
                                
                                <h5 class="auth-title">Sign In</h5>

                                <form action="{{route('colleges_login')}}" method="post" autocomplete="off" id="login_admin">
                                {{ csrf_field() }}
                                    <div class="form-group mb-3">
                                        <label for="username">username</label>
                                        <input class="form-control" type="username" name="username"  id="username"   placeholder="Enter your username">
                                        @if($errors->has('username'))
                                        <div class="invalid-feedback" style="display: block">{{ $errors->first('username') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password"  id="password" name="password" placeholder="Enter your password">
                                        @if($errors->has('password'))
                                            <div class="invalid-feedback" style="display: block">{{ $errors->first('password') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="custom-control custom-checkbox checkbox-info">
                                            <input type="checkbox" name="remember"  class="custom-control-input" id="checkbox-signin">
                                            <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>
                                    @if($errors->has('message'))
                                        <div class="form-group">
                                            <label class="invalid-feedback" style="display: block">
                                                {{ $errors->first('message') }}
                                            </label> 
                                        </div>    
                                    @endif
                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-danger btn-block" type="submit"> Log In </button>
                                    </div>

                                </form>

                               

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

<!--                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p> <a href="pages-recoverpw.html" class="text-muted ml-1">Forgot your password?</a></p>
                                <p class="text-muted">Don't have an account? <a href="pages-register.html" class="text-muted ml-1"><b class="font-weight-semibold">Sign Up</b></a></p>
                            </div>  end col 
                        </div>-->
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <footer class="footer footer-alt">
               <?php echo date('Y'); ?> &copy; developed by <a href="https://inventivhub.com/" target="_blank">InventivHub</a>
                             
        </footer>

        <!-- Vendor js -->
        <script src="{{asset('public/assets/js/vendor.min.js')}}"></script> 
        <!-- App js -->
        <script src="{{asset('public/assets/js/app.min.js')}}"></script>
        <script src="{{asset('public/assets/libs/validation/validate.min.js')}}"></script>
	
        
    </body>
</html>
