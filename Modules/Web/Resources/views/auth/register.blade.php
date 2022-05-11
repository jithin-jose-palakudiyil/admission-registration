@extends('web::wizard.layouts.master')  
@section('content')  


<!--<style>
    .malayalam-font-notification-title{
        font-family:'Noto Sans', sans-serif;
        font-size:28px;
        color:red
    }

    .malayalam-font-notification-content{
        font-size: 20px; 
        font-family:'Noto Sans', sans-serif;
    }

    .malayalam-font-notification-content span{
        font-size: 15px;
        font-family:'Noto Sans', sans-serif;

    }

    @media only screen and (max-width: 340px){
        .malayalam-font-notification-title{
        font-size:25px
        }

        .malayalam-font-notification-content{
            font-size: 18px; 
        }

        .malayalam-font-notification-content span{
            font-size: 14px;

        }
    }
</style>-->


<!--    <div class="modal fade" id="notification" tabindex="-1" role="dialog" aria-labelledby="notificationTitle" data-keyboard="false" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 style="" class="modal-title malayalam-font-notification-title" id="exampleModalLongTitle">ശ്രദ്ധിക്കുക !</h4>
            </div>
            <div style="" class="modal-body malayalam-font-notification-content">
            സ്കോളർഷിപ്പിന് രജിസ്റ്റർ ചെയ്തവർ താഴെ കാണുന്ന <span>Login Button</span>-ൽ ക്ലിക്ക് ചെയ്യുക. മറ്റുള്ളവർ <span>Close</span> ചെയ്തു രജിസ്റ്റർ ചെയ്യുക.
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary"  type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-danger" type="button" class="btn btn-secondary"><a style="color:white" href="{{route('loginView')}}">Login now</a></button>
            </div>
            </div>
        </div>
    </div>-->


        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">
                            <div class="card-body p-4">
                            <span class="logo-lg">
                                <img style="height: 45px; display: block; margin : auto; margin-bottom: 15px" src="{{asset('public/assets/images/mgm_btech.png')}}" alt="" height="24">
                                <!-- <span class="logo-lg-text-light">Upvex</span> -->
                            </span>
                                 
                                 

                                <h5 class="auth-title">Registration For Admission to B.Tech / M.Tech/ Polytechnic Diploma/ B.Pharm/ D.Pharm</h5>

                                <form action="{{route('RegisterStore')}}" method="post" id="register_form"> 
                                    @csrf

                                    <div class="form-group mb-3">
                                        <label for="name">Name of the candidate <span class="text-danger">*</span> </label>
                                        <input class="form-control" type="text" id="name" name="name"  placeholder="Enter your name">
                                        @error('name')
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

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
                                        <label for="mobile">Whatsapp number <span class="text-danger">*</span> </label>
                                        <input class="form-control" type="text" id="mobile" name="mobile"  placeholder="Enter your whatsapp number">
                                        @error('mobile')
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
                                        <button class="btn btn-danger btn-block" type="submit"> Submit</button>
                                    </div>

                                </form>


                                @if(Session::has('register_error'))
                                    <label class="invalid-feedback" style="font-size: 100%;display: block !important; text-align: center; margin-top: 10px">
                                        {!! Session::get('register_error') !!}
                                    </label>
                                @endif


                                <div class="row mt-3">
                                    <div class="col-12 text-center">
                                        <p class="text-muted">Already have account?  <a href="{{route('loginView')}}" class="text-muted ml-1"><b class="font-weight-semibold">Sign In</b></a></p>
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


@section('css')
<link href="{{asset('public/assets/libs/intlTelInput/intlTelInput.css')}}" rel="stylesheet" type="text/css">

@endsection

@section('js')
<script src="{{asset('Modules/Web/Resources/assets/js/register.js')}}" type="text/javascript"></script>
<script src="{{asset('public/assets/libs/intlTelInput/intlTelInput.js')}}"></script> 

<script>
    jQuery(document).ready(function () {
//        $('#notification').modal('show');
    });

    </script>


@endsection
 

