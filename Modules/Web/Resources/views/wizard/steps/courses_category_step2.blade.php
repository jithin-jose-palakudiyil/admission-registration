@extends('web::wizard.layouts.master')  
@section('content')  



<style>

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
                <div class="col-md-10 col-lg-8 col-xl-7">
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
                                Select the programs preferred
                                <p style="color: grey; font-size: 13.5px" class="step-active" style=""><em>Candidate can select one program.</em></p>
                                    <div class="step-container" style="">
                                            <div class="step-inactive-container" style=""><p class="step-inactive" style="">Step 1</p></div>
                                            <div class="step-active-container" style=""><p class="step-active" style="">Step 2</p></div>
                                            <div class="step-inactive-container" style=""><p class="step-inactive" style="">Step 3</p></div>
                                            <div class="step-inactive-container" style=""><p class="step-inactive" style="">Step 4</p></div>
                                    </div>
                                
                                </h5>

                                <form action="{{route('courses_category_step_store')}}" method="post" id="courses_category_form"> 
                                    @csrf

                                    <?php if(isset($CoursesCategory) && count($CoursesCategory)>0):
                                        $AssignUserCategoryCollegesCourses = \Modules\Web\Entities\AssignUserCategoryCollegesCourses::where('user_id', $web_user->id)->get();
                                        $pluckedUserCategoryCollgeCourses = $AssignUserCategoryCollegesCourses->pluck('courses_category_id');
                                        $i=1; foreach($CoursesCategory as $courseCategoryKey => $courseCategoryValue):
                                            $checked = null;
                                        foreach ($pluckedUserCategoryCollgeCourses as $pluckedUserCategoryKey => $pluckedUserCategoryValue):
                                            if($pluckedUserCategoryValue == $courseCategoryValue->id): $checked='checked'; endif;
                                        endforeach;
                                        // dd($checked);
                                        ?>
    
                                                    <div class="radio radio-primary mb-2">
                                                        <input type="radio" name="courses_category" id="courses_category_{{$i}}" value="{{$courseCategoryValue->id}}">
                                                        <label   for="courses_category_{{$i}}">
                                                           {{$courseCategoryValue->name}}
                                                        </label>
                                                    </div>
                                    
<!--                                            <div class="form-group mb-3">
                                                <div class="custom-control custom-checkbox checkbox-info">
                                                    <input type="radio"  @if($checked==null) unchecked @else checked @endif  name="courses_category" value="{{$courseCategoryValue->id}}" class="custom-control-input courses_category_class" id="courses_category_{{$i}}">
                                                    <label class="custom-control-label "  for="courses_category_{{$i}}">{{$courseCategoryValue->name}}</label>
                                                </div>
                                            </div>-->
                                    <?php $i++; endforeach; else: ?>  
                                            <img style="max-height:300px; margin:auto; display: block" src="{{asset('public/assets/images/no_list.png')}}" />
                                            <p style="text-align:center; font-weight:600"> Sorry ! No programs at the moment. </p>
                                    <?php endif; ?>


                                    <div style=" display: flex; justify-content: space-between">
                                        <div></div>
                                            <div class="form-group mb-0 text-center ">
                                                <button style="max-width: 100px; margin-bottom: 10px" class="btn btn-danger btn-block" type="submit"> Next </button>
                                                <!-- <code style=" text-align: center"> All marked (*) fields are required </code> -->
                                            </div>
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


@section('css')
    <link href="{{asset('public/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
<script src="{{asset('public/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('Modules/Web/Resources/assets/js/courses_category.js')}}" type="text/javascript"></script>
@endsection
