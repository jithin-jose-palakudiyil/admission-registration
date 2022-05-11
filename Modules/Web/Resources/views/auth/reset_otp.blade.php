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
                        <div class="card">

                            <div class="card-body p-4">
                                
                            <span class="logo-lg">
                                <img style="height: 45px; display: block; margin : auto; margin-bottom: 15px" src="{{asset('public/assets/images/mgm_btech.png')}}" alt="" height="24">
                                <!-- <span class="logo-lg-text-light">Upvex</span> -->
                            </span>
                                 

                                <h5 class="auth-title"> Please Enter the OTP
                                
                                        <p style="text-align: center; font-weight: 300;font-size: 13px; text-transform: none; margin-bottom: 0!important; margin-top:5px" for="mobile">OTP has been sent to <span style="color:#04c1a7; font-weight: bold">+91 {{$user->mobile}}</span></p>
                                </h5>

                                <form action="{{route('forgotOtpVerify', [\Crypt::encryptString($user->id)])}}" method="post" id="forgot_otp_form"> 
                                    @csrf

  

                                    <div class="form-group mb-3">
                                        <input style="letter-spacing: 15px; text-align: center; font-weight: bold; font-size: 15px" class="form-control" type="text" id="otp" name="otp" >
                                        @error('otp')
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="row mt-3" >
                                        <div class="col-12 text-center"> 
                                            <p class="text-muted">Not received your code?  <span id="some_div"></span>
                                                <a style="display: none" id="ResendCode" href="javascript:void(0)" class="text-muted ml-1"><b class="font-weight-semibold">Resend code</b></a>
                                            </p>
                                            <div class="text-center" id="otp_message"></div>    
                                            
                                        </div>  
                                    </div>


                                    @if($errors->has('message'))
                                            <div class="form-group">
                                                <label class="invalid-feedback" style="font-size: 100%;display: block !important">
                                                    {{ $errors->first('message') }}
                                                </label> 
                                            </div>    
                                        @endif
                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-danger btn-block" type="submit"> Verify OTP </button>
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


@stop


@section('js')
<script src="{{asset('Modules/Web/Resources/assets/js/forgot_otp.js')}}" type="text/javascript"></script>

@endsection
