@extends('web::wizard.layouts.master')  
@section('content')  



<style>

    .malayalam-font-notification-title{
        font-family:'Noto Sans', sans-serif;
        font-size:28px;
        color: red;
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

    .step-container{
        display: flex; 
        align-item: center; 
        justify-content: center; 
        margin-top: 10px;
        overflow: auto;
        white-space: nowrap;
    }

    .step-active-container{
        background-color: #f0643b; 
        border-radius: 5px; margin: 0 5px;
    }

    .step-inactive-container{
        border: 1px solid #f0643b; border-radius: 5px; margin: 0 5px;
    }

    .step-active{
        padding: 15px 30px 0px 30px; color: white; text-transform: none; font-weight: 500; font-size: 14px
    }

    .step-inactive{
        padding: 15px 30px 0px 30px; color: #f0643b; text-transform: none; font-weight: 500; font-size: 14px
    }

    .datepicker-dropdown {
        top: 298px!important
    }

    @media only screen and (max-width: 1091px){
        .datepicker-dropdown {
        top: 470px!important
    }
    }

</style>

    <?php 
        $web_user = null;
        if(Auth::guard(web_guard) && Auth::guard(web_guard)->user()):
            $web_user = Auth::guard(web_guard)->user();
        endif;
    ?>


       
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-12 col-xl-12">

                    @if(Session::has('store_error')) 
                        <div style="text-align: center" class="alert bg-danger text-white alert-styled-left alert-dismissible font-weight-semibold">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                            {!! Session::get('store_error') !!}
                        </div>
                        @endif


                        <div class="card">

                            <div class="card-body p-4">
                            <span class="logo-lg">
                                <img style="height: 45px; display: block; margin : auto; margin-bottom: 15px" src="{{asset('public/assets/images/mgm_btech.png')}}" alt="" height="24">
                                <!-- <span class="logo-lg-text-light">Upvex</span> -->
                            </span>
                                 

                                <h5 class="auth-title"> 
                                Personal Information
                                    <div class="step-container" style="">
                                            <div class="step-active-container" style=""><p class="step-active" style="">Step 1</p></div>
                                            <div class="step-inactive-container" style=""><p class="step-inactive" style="">Step 2</p></div>
                                            <div class="step-inactive-container" style=""><p class="step-inactive" style="">Step 3</p></div>
                                            <div class="step-inactive-container" style=""><p class="step-inactive" style="">Step 4</p></div>
                                    </div>
                                
                                </h5>

                                <form action="{{route('personal_info_store')}}" method="post" id="personal_info_form" enctype="multipart/form-data"> 
                                    @csrf

  
                                    <div class="row">

                                         <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                            <label for="address">Address <span class="text-danger">*</span> </label>
                                            <textarea class="form-control" style="resize: none" type="text" id="address" name="address" row="5" placeholder="Enter your address">{{isset($web_user) ? $web_user->address : old('address')}}</textarea>
                                                @error('address')
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="district">District <span class="text-danger">*</span> </label>
                                            <select class="form-control" id="district" name="district">
                                                <option value="">select</option>
                                                <?php
                                                    $districts = \Modules\Web\Entities\District::all();
                                                    foreach ($districts as $districtKey => $districtValue):
                                                    ?>
                                                        <option @if(isset($web_user) && $web_user->district == $districtValue->name) selected @endif value="{{$districtValue->name}}">{{$districtValue->name}}</option>
                                                    <?php endforeach;?>
                                            </select>
                                                @error('district')
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">


               
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                <label for="pin">Pin <span class="text-danger">*</span> </label>
                                                <input value="{{isset($web_user) ? $web_user->pincode : old('pincode')}}" class="form-control" type="text" id="pin" name="pin" row="5" placeholder="Enter your pin"></input>
                                                    @error('pin')
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                            <label for="gender">Gender <span class="text-danger">*</span> </label>
                                            <select class="form-control" id="gender" name="gender">
                                                <option value="">select</option>
                                                <option  @if(isset($web_user) && $web_user->gender == "m") selected @endif value="m">Male</option>
                                                <option  @if(isset($web_user) && $web_user->gender == "f")  selected @endif value="f">Female</option>

                                            </select>
                                                @error('gender')
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                     </div>


                                    <div class="row">
                                        <div id="dob_col" class="col-lg-6">
                                            <div class="form-group mb-3">
                                            <label for="date_of_birth">Date of Birth <span class="text-danger">*</span> </label>
                                            <input value="{{isset($web_user) ? $web_user->date_of_birth : old('date_of_birth')}}" type="text" class="form-control datepicker" name="date_of_birth"  placeholder="DD/MM/YYYY, eg: 22/06/1998" />
                                                @error('date_of_birth')
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                         
                                        <div id="caste_category_col" class="col-lg-6">
                                        <div  class="form-group mb-3">
                                            <label for="caste_category">Caste category <span class="text-danger">*</span> </label>
                                            <select class="form-control" id="caste_category" name="caste_category">
                                                <option value="">select</option>
                                                <?php
                                                    $CasteCategory = \Modules\Web\Entities\CasteCategory::all();
                                                    foreach ($CasteCategory as $CasteCategoryKey => $CasteCategoryValue):
                                                    ?>
                                                        <option @if(isset($web_user) && $web_user->caste_category == $CasteCategoryValue->name) selected @endif value="{{$CasteCategoryValue->name}}">{{$CasteCategoryValue->name}}</option>
                                                    <?php endforeach;?>
                                            </select>
                                                @error('caste_category')
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div style="display: none" id="caste_category_other_col"  class="col-lg-4">
                                            <div class="form-group mb-3">
                                            <label for="caste_category_other">Specify the caste <span class="text-danger">*</span> </label>
                                            <input value="{{isset($web_user)  ? $web_user->caste_category_other : old('caste_category_other')}}" type="text" class="form-control" name="caste_category_other"  placeholder="Specify the caste" />
                                                @error('caste_category_other')
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="mobile">Mobile number <span class="text-danger">*</span> </label>
                                                <input class="form-control" type="text" id="mobile" name="mobile" row="5" placeholder="Enter your mobile" value="{{\Auth::guard(web_guard)->user()->mobile}}" readonly=""></input>
                                                    @error('mobile')
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="whatsapp">Whatsapp number <span class="text-danger">*</span> </label>
                                                <input value="{{isset($web_user) ? $web_user->whatsapp : old('whatsapp')}}" class="form-control" type="text" id="whatsapp" name="whatsapp" row="5" placeholder="Enter your whatsapp"></input>
                                                    @error('whatsapp')
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>

                                    </div>



                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="parent_name">Name of parent <span class="text-danger">*</span> </label>
                                                <input value="{{isset($web_user) ? $web_user->parent_name : old('parent_name')}}" class="form-control" type="text" id="parent_name" name="parent_name" row="5" placeholder="Enter your parent name"></input>
                                                    @error('parent_name')
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="parent_contact">Contact number of the parent <span class="text-danger">*</span> </label>
                                                <input value="{{isset($web_user) ? $web_user->parent_contact : old('parent_contact')}}" class="form-control" type="text" id="parent_contact" name="parent_contact" row="5" placeholder="Enter your parent contact"></input>
                                                    @error('parent_contact')
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>

                                    </div>

 
                           
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <div style=" display: flex; justify-content: space-between">
                                        <div></div>
                                            <div class="form-group mb-0 text-center ">
                                                <button style="max-width: 100px; margin-bottom: 10px" class="btn btn-danger btn-block" type="submit"> Next </button>
                                                <code style=" text-align: center"> All marked (*) fields are required </code>
                                            </div>
                                    </div>

                
                                        

                                </form>

                                

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

 
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
    <link href="{{asset('public/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
@endsection

@section('js')
<script src="{{asset('public/assets/libs/validation/jquery.validate.file.js')}}" type="text/javascript"></script>
<script src="{{asset('public/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('Modules/Web/Resources/assets/js/personal_info.js')}}" type="text/javascript"></script>

<?php if(isset($web_user) && $web_user->current_step == "step_2"):  ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.0/jquery.cookie.js"></script>
<!--    <script>
    jQuery(document).ready(function () {
        function openModal() {
            setTimeout(function () {
                $('#notification').modal('show');
            }, 500);
        };
        var visited = jQuery.cookie('visited');
        if (visited == 'yes') {
            $('#notification').modal('close');
        } else {
            openModal(); // first page load, launch fancybox
        }
        var date = new Date();
        var minutes = 2;
        date.setTime(date.getTime() + (minutes * 60 * 1000));
        jQuery.cookie('visited', 'yes', {
            expires: date // the number of days cookie  will be effective
        });
        $('#notification').modal('show');
    });

    </script>-->
<?php endif;  ?>


<script type="text/javascript">
        $("#gender").select2();
    </script>

    <!-- <script type="text/javascript">
if($('.datepicker').length)
    {
         jQuery('.datepicker').datepicker({
            format: "dd-mm-yyyy", 
        });
    }

    </script> -->

@endsection
