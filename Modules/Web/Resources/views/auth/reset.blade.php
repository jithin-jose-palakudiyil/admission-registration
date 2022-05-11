@extends('web::wizard.layouts.master')  

@section('content')

<style>
    .step-active{
        padding: 15px 30px 0px 30px; color: white; text-transform: none; font-weight: 500; font-size: 14px
    }
</style>


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

                        <div class="card">

                            <div class="card-body p-4">
                            <span class="logo-lg">
                                <img style="height: 45px; display: block; margin : auto; margin-bottom: 15px" src="{{asset('public/assets/images/mgm_btech.png')}}" alt="" height="24">
                                <!-- <span class="logo-lg-text-light">Upvex</span> -->
                            </span>
                                 
                                 

                                <h5 class="auth-title">Reset your account
                                    <p style="color: grey; font-size: 13px; margin-bottom:0px!important" class="step-active" style="">Enter new password</p>
                                </h5>

                                <form action="{{route('UpdatePassword')}}" method="post" id="reset_form"> 
                                    @csrf


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
                                        <label for="confirm_password">Confirm Password <span class="text-danger">*</span> </label>
                                        <input class="form-control" type="password" name="confirm_password"  id="confirm_password" placeholder="Enter your password">
                                        @error('confirm_password')
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
                                        <button class="btn btn-danger btn-block" type="submit"> Reset password </button>
                                    </div>

                                </form>


                                @if(Session::has('register_error'))
                                    <label class="invalid-feedback" style="font-size: 100%;display: block !important; text-align: center; margin-top: 10px">
                                        {!! Session::get('register_error') !!}
                                    </label>
                                @endif


                                <div class="row mt-3">
                                    <div class="col-12 text-center">
                                        <p class="text-muted">Know your password?  <a href="{{route('loginView')}}" class="text-muted ml-1"><b class="font-weight-semibold">Sign In</b></a></p>
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
<script src="{{asset('Modules/Web/Resources/assets/js/reset.js')}}" type="text/javascript"></script>

@endsection
 

