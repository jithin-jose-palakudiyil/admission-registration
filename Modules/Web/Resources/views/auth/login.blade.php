@extends('web::wizard.layouts.master')  
@section('content')  
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                    @if(Session::has('reset-error')) 
                        <div style="text-align: center" class="alert bg-danger text-white alert-styled-left alert-dismissible font-weight-semibold">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                            {!! Session::get('reset-error') !!}
                        </div>
                        @endif

                        @if(Session::has('reset-success'))
                        <div style="text-align: center" class="alert bg-success text-white alert-styled-left alert-dismissible font-weight-semibold" style="background-color: #009688 !important;">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                            {!! Session::get('reset-success') !!}
                        </div> 
                        @endif


                        <div class="card">
                            <div class="card-body p-4">
                                
                            <span class="logo-lg">
                                <img style="height: 45px; display: block; margin : auto; margin-bottom: 15px" src="{{asset('public/assets/images/mgm_btech.png')}}" alt="" height="24">
                                <!-- <span class="logo-lg-text-light">Upvex</span> -->
                            </span>
                                 

                                <h5 class="auth-title">Sign In</h5>

                                <form action="{{route('loginStore')}}" method="post" id="login_form"> 
                                    @csrf

  

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">Email address <span class="text-danger">*</span> </label>
                                        <input class="form-control" type="text" id="email" name="email"  placeholder="Enter your email">
                                        @error('email')
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="form-group mb-3">
                                        <label for="password">Password <span class="text-danger">*</span> </label>
                                        <input class="form-control" type="password" name="password"  id="password" placeholder="Enter your password">
                                        @error('password')
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="form-group mb-3">
                                        <div class="custom-control custom-checkbox checkbox-info">
                                            <input type="checkbox" name="remember" class="custom-control-input" id="checkbox-signin">
                                            <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>

                                    
                                    @if($errors->has('message'))
                                            <div class="form-group">
                                                <label class="invalid-feedback" style="font-size: 100%;display: block !important">
                                                    {{ $errors->first('message') }}
                                                </label> 
                                            </div>    
                                        @endif

                                        <div style="margin-bottom: 10px">
                                            <code style=" text-align: center"> All marked (*) fields are required </code>
                                        </div>


                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-danger btn-block" type="submit"> Log In </button>
                                    </div>

                                </form>

                                @if(Session::has('login_error'))
                                    <label class="invalid-feedback" style="font-size: 100%;display: block !important; text-align: center; margin-top: 10px">
                                        {!! Session::get('login_error') !!}
                                    </label>
                                @endif

                                <div class="row mt-3">
                                    <div class="col-12 text-center">
                                        <p> <a href="{{route('forgot')}}" class="text-muted ml-1">Forgot your password?</a></p>
                                        <p class="text-muted">Don't have an account? <a href="{{route('RegisterView')}}" class="text-muted ml-1"><b class="font-weight-semibold">Register Now</b></a></p>
                                    </div> <!-- end col -->
                                 </div>
                                

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


@stop


@section('js')
<script src="{{asset('Modules/Web/Resources/assets/js/login.js')}}" type="text/javascript"></script>

@endsection
 

