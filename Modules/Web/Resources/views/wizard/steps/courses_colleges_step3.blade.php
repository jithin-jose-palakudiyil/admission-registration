@extends('web::wizard.layouts.master')  
@section('content')  



<style>

.tabsToggler{
    padding: 4px 10px;
    border-radius: 5px;
    border: none;
    background: #5a5454;
    margin-bottom: 10px;
    display: none
}

@media only screen and (max-width: 768px) {

    .tabsToggler{
        display: block
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
    .st > .tab-content {
        position: relative;
        overflow: hidden;
        height: auto!important;
    }

.st-theme-default.st-vertical > .nav {
    box-shadow: 0.125rem 0 0.25rem rgb(0 0 0 / 10%) !important;
    min-width: 150px!important;
}


.st.st-vertical > .nav > li, .st.st-vertical > .nav .nav-link {
    flex-grow: unset !important;
    border-bottom: 0.5px solid #e9ecef;
}

/* 

    .st.st-justified > .nav > li, .st.st-justified > .nav .nav-link {
        flex-basis: 0;
        flex-grow: 1;
        text-align: center;
        color: grey!important;
    }


    .st.st-justified > .nav > li, .st.st-justified > .nav .nav-link.active {
        flex-basis: 0;
        flex-grow: 1;
        text-align: center;
        color: #5bc0de!important;
    }

    /* for chaning tab color */

    .st-theme-default > .nav .nav-link {
    color: #6f6f6f!important;
    cursor: pointer;
    font-size: 14px !important;
    font-weight: 500 !important;
}

    .st-theme-default > .nav .nav-link.active {
    color: #f0643b !important;
    cursor: pointer;
    font-size: 14px !important;
    font-weight: 500 !important;
}

    .st-theme-default > .nav .nav-link.active::after {
        background: #f0643b !important;
        transform: scale(1);
    } 

    .tab-content {
    padding: 0px 0 0 0!important;
}


.college-category{
    margin-right: 10px; 
    margin-left: 10px; 
    font-size: 18px; 
    letter-spacing: 1px
}


@media only screen and (max-width:580px){
    .college-category{
        margin-right: 0px; 
        margin-left: 0px; 
    }

}

</style>

<?php $AssignColleges = null;
    $AssignCategoryCollege = null;
    $web_user = null;
    if(Auth::guard(web_guard) && Auth::guard(web_guard)->user()):
        $web_user = Auth::guard(web_guard)->user();
    endif;

?>

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-12">

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
                                Select the college and courses preferred
                                <p style="color: grey; font-size: 13.5px" class="step-active" style=""><em>Candidates can select multiple courses of choice from their preferred colleges listed below.</em></p>
                                    <div class="step-container" style="">
                                            <div class="step-inactive-container" style=""><p class="step-inactive" style="">Step 1</p></div>
                                            <div class="step-inactive-container" style=""><p class="step-inactive" style="">Step 2</p></div>
                                            <div class="step-active-container" style=""><p class="step-active" style="">Step 3</p></div>
                                            <div class="step-inactive-container" style=""><p class="step-inactive" style="">Step 4</p></div>
                                    </div>
                                
                                </h5>
                                <?php  if(\Auth::guard(web_guard)->user()->current_step != 'step_5'):  ?> 
                                    <div class="col-md-12 " align='center'>
                                        <a href="{{URL('/courses-category')}}">  <button style="margin-bottom: 10px;" class="btn lg btn-primary btn-block " type="button"> Back to programs  </button></a>
                                    </div>
                                 <?php endif;  ?>
                                <form action="{{route('courses_colleges_step_store')}}" method="post" id="courses_colleges_form"> 
                                    @csrf

                                    <button  id="navClose" class="tabsToggler"><i style="color: white" class="fas fa-times"></i></button> 
                                    <button style="display: none;" class="tabsToggler"   id="navOpen" class="tabsToggler"><i style="color: white" class="fas fa-bars"></i></button> 

                                    <div id="smarttab">
                                        <ul id="nav" class="nav">
                                        <?php $i=1;  $myarray=[$selected_categories]; foreach ($myarray as $key => $value):
                                            $CoursesCategory = \Modules\Web\Entities\CoursesCategory::where('id', $value)->first();
                                            ?>
                                            <li>
                                                <a class="nav-link"  href="#tab-{{$i}}">
                                                    {{$CoursesCategory->name}}
                                                </a>
                                            </li>
            
                                      <?php $i++;  endforeach;  ?>
                                        </ul>
                                    
                                        <div class="tab-content">
                                        <?php $j=1; foreach ($myarray as $key => $value):
                                            
                                            $CoursesCategory = \Modules\Web\Entities\CoursesCategory::where('id', $value)->first();
                                            $AssignColleges = \Modules\Web\Entities\AssignColleges::with(array('GetColleges'=> function($query){
                                                $query->where('status', 1);
                                            }))->where('courses_category_id', $CoursesCategory->id)->get();
                                 
                                            
                                            
                                            $AssignCollegeCategory = Modules\Web\Entities\AssignCollegeCategory::where('course_category_id',$CoursesCategory->id)->first();
                                            $CollegeCategory = null;
                                            if($AssignCollegeCategory):
                                                $CollegeCategory =\Modules\Web\Entities\CollegeCategory::find($AssignCollegeCategory->category_id);
                                            endif;
                                             
                                            ?>
                                            <div id="tab-{{$j}}" class="tab-pane" role="tabpanel">

                                              <?php if($CollegeCategory): ?>
                                                <div style="color: #ff6335; font-size: 17px; font-weight: 600" class="auth-title college-category">{{$CollegeCategory->name}}</div>
                                              <?php endif; ?>         
                                                      
                                            <?php if(isset($AssignColleges) && count($AssignColleges) > 0):?>
                                                <?php $k=1; foreach ($AssignColleges as $assignCollegeKey => $assignCollegeValue):
                                                    $AssignCategoryCollege = \Modules\Web\Entities\AssignCategoryCollege::with(array('GetCourses'=> function($query){
                                                        $query->where('status', 1);
                                                    }))->where('courses_category_id', $CoursesCategory->id)->where('college_id', $assignCollegeValue->college_id)->get();
                                                    if(isset($assignCollegeValue) && isset( $assignCollegeValue->GetColleges)): 
                                                    ?>
                                                        
                                                        <h4 style="text-transform: capitalize; font-size: 17px">{!!$assignCollegeValue->GetColleges->name!!}</h4>
                                                        <hr/>
                                                      
                                                                   
                                                        <?php if(($AssignCategoryCollege)  && count($AssignCategoryCollege)>0):?>
                                                                 <div style="text-transform: capitalize; font-size: 15px;margin-bottom: 10px">Course Preference</div>
                                                                 <div class="row">
                                                                     <?php if(count($AssignCategoryCollege)>=1): ?>
                                                                         
                                                                     
                                                                <div class="col-lg-4">
                                                                <div  class="form-group mb-3">
                                                                    <label>Preference 1</label>
                                                                    <select class="form-control" id="caste_category" name="category_college_course[{{$j}}_{{$k}}_1]">
                                                                        <option value="" >select</option>
         
                                                        <?php $l=1; foreach ($AssignCategoryCollege as $AssignCategoryCollegeKey => $AssignCategoryCollegeValue):
                                                                $checked = null;
                                                                if(isset($AssignCategoryCollegeValue) && isset($AssignCategoryCollegeValue->GetCourses)): 
                                                                    $AssignUserCategoryCollegesCourses = \Modules\Web\Entities\AssignUserCategoryCollegesCourses::where('user_id', $web_user->id)->get();
                                                                        // dd($AssignUserCategoryCollegesCourses);
                                                                
                                                                
                                                                ?>
                                                           
                                                                <?php
                                                                    foreach ($AssignUserCategoryCollegesCourses as $AssignUserCategoryCollegesCourseskey => $AssignUserCategoryCollegesCoursesValue) :
                                                                            if($AssignUserCategoryCollegesCoursesValue->courses_category_id == $CoursesCategory->id 
                                                                            && $AssignUserCategoryCollegesCoursesValue->college_id == $assignCollegeValue->GetColleges->id 
                                                                            && $AssignUserCategoryCollegesCoursesValue->course_id == $AssignCategoryCollegeValue->getCourses->id
                                                                            && $AssignUserCategoryCollegesCoursesValue->preference == 1
                                                                            ): $checked='selected=""'; endif;
                                                                                
                                                                            
                                                                       endforeach;
                                                            ?>
                                                                <option {{$checked}} value="{{$CoursesCategory->id}}_{{$assignCollegeValue->getColleges->id}}_{{$AssignCategoryCollegeValue->getCourses->id}}_1">{{$AssignCategoryCollegeValue->GetCourses->name}}</option>
<!--                                                            <div style="display: inline-block; min-width: 300px; margin: auto 10px;">
                                                                <div class="form-group mb-3">
                                                                    <div class="custom-control custom-checkbox checkbox-info">
                                                                        <input type="checkbox" @if($checked==null) unchecked @else checked @endif name="category_college_course[{{$j}}_{{$k}}_{{$l}}]" value="{{$CoursesCategory->id}}_{{$assignCollegeValue->getColleges->id}}_{{$AssignCategoryCollegeValue->getCourses->id}}" class="custom-control-input" id="category_college_course{{$CoursesCategory->id}}_{{$assignCollegeValue->getColleges->id}}_{{$AssignCategoryCollegeValue->getCourses->id}}">
                                                                        <label class="custom-control-label" for="category_college_course{{$CoursesCategory->id}}_{{$assignCollegeValue->getColleges->id}}_{{$AssignCategoryCollegeValue->getCourses->id}}">{{$AssignCategoryCollegeValue->GetCourses->name}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>-->


                                                        <?php $l++; endif; endforeach;?>
                                                            </select> 
                                                                </div>
                                                            </div>
                                                                 
                                                                 <?php endif; ?>
                                                                 
                                                                 <?php if(count($AssignCategoryCollege)>=2): ?>
                                                                  <div class="col-lg-4">
                                                                <div  class="form-group mb-3">
                                                                    <label>Preference 2 </label>
                                                                    <select class="form-control" id="caste_category" name="category_college_course[{{$j}}_{{$k}}_2]">
                                                                        <option value="">select</option>
         
                                                        <?php $l=1; foreach ($AssignCategoryCollege as $AssignCategoryCollegeKey => $AssignCategoryCollegeValue):
                                                                $checked = null;
                                                                if(isset($AssignCategoryCollegeValue) && isset($AssignCategoryCollegeValue->GetCourses)): 
                                                                    $AssignUserCategoryCollegesCourses = \Modules\Web\Entities\AssignUserCategoryCollegesCourses::where('user_id', $web_user->id)->get();
                                                                        // dd($AssignUserCategoryCollegesCourses);
                                                                
                                                                
                                                                ?>
                                                           
                                                                <?php
                                                                    foreach ($AssignUserCategoryCollegesCourses as $AssignUserCategoryCollegesCourseskey => $AssignUserCategoryCollegesCoursesValue) :
                                                                            if($AssignUserCategoryCollegesCoursesValue->courses_category_id == $CoursesCategory->id 
                                                                            && $AssignUserCategoryCollegesCoursesValue->college_id == $assignCollegeValue->GetColleges->id 
                                                                            && $AssignUserCategoryCollegesCoursesValue->course_id == $AssignCategoryCollegeValue->getCourses->id
                                                                            && $AssignUserCategoryCollegesCoursesValue->preference == 2
                                                                            ): $checked='selected=""'; endif;
                                                                                
                                                                            
                                                                       endforeach;
                                                            ?>
                                                                <option {{$checked}} value="{{$CoursesCategory->id}}_{{$assignCollegeValue->getColleges->id}}_{{$AssignCategoryCollegeValue->getCourses->id}}_2">{{$AssignCategoryCollegeValue->GetCourses->name}}</option>
<!--                                                            <div style="display: inline-block; min-width: 300px; margin: auto 10px;">
                                                                <div class="form-group mb-3">
                                                                    <div class="custom-control custom-checkbox checkbox-info">
                                                                        <input type="checkbox" @if($checked==null) unchecked @else checked @endif name="category_college_course[{{$j}}_{{$k}}_{{$l}}]" value="{{$CoursesCategory->id}}_{{$assignCollegeValue->getColleges->id}}_{{$AssignCategoryCollegeValue->getCourses->id}}" class="custom-control-input" id="category_college_course{{$CoursesCategory->id}}_{{$assignCollegeValue->getColleges->id}}_{{$AssignCategoryCollegeValue->getCourses->id}}">
                                                                        <label class="custom-control-label" for="category_college_course{{$CoursesCategory->id}}_{{$assignCollegeValue->getColleges->id}}_{{$AssignCategoryCollegeValue->getCourses->id}}">{{$AssignCategoryCollegeValue->GetCourses->name}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>-->


                                                        <?php $l++; endif; endforeach;?>
                                                            </select> 
                                                                </div>
                                                            </div>
                                                                 
                                                                  <?php endif; ?>
                                                                 
                                                                 
                                                                 
                                                                 <?php if(count($AssignCategoryCollege)>=3): ?>
                                                                  <div class="col-lg-4">
                                                                <div  class="form-group mb-3">
                                                                    <label>Preference 3 </label>
                                                                    <select class="form-control" id="caste_category" name="category_college_course[{{$j}}_{{$k}}_3]">
                                                                        <option value="">select</option>
         
                                                        <?php $l=1; foreach ($AssignCategoryCollege as $AssignCategoryCollegeKey => $AssignCategoryCollegeValue):
                                                                $checked = null;
                                                                if(isset($AssignCategoryCollegeValue) && isset($AssignCategoryCollegeValue->GetCourses)): 
                                                                    $AssignUserCategoryCollegesCourses = \Modules\Web\Entities\AssignUserCategoryCollegesCourses::where('user_id', $web_user->id)->get();
                                                                        // dd($AssignUserCategoryCollegesCourses);
                                                                
                                                                
                                                                ?>
                                                           
                                                                <?php
                                                                    foreach ($AssignUserCategoryCollegesCourses as $AssignUserCategoryCollegesCourseskey => $AssignUserCategoryCollegesCoursesValue) :
                                                                            if($AssignUserCategoryCollegesCoursesValue->courses_category_id == $CoursesCategory->id 
                                                                            && $AssignUserCategoryCollegesCoursesValue->college_id == $assignCollegeValue->GetColleges->id 
                                                                            && $AssignUserCategoryCollegesCoursesValue->course_id == $AssignCategoryCollegeValue->getCourses->id
                                                                            && $AssignUserCategoryCollegesCoursesValue->preference == 3
                                                                            ): $checked='selected=""'; endif;
                                                                                
                                                                            
                                                                       endforeach;
                                                            ?>
                                                                <option {{$checked}}  value="{{$CoursesCategory->id}}_{{$assignCollegeValue->getColleges->id}}_{{$AssignCategoryCollegeValue->getCourses->id}}_3">{{$AssignCategoryCollegeValue->GetCourses->name}}</option>
<!--                                                            <div style="display: inline-block; min-width: 300px; margin: auto 10px;">
                                                                <div class="form-group mb-3">
                                                                    <div class="custom-control custom-checkbox checkbox-info">
                                                                        <input type="checkbox" @if($checked==null) unchecked @else checked @endif name="category_college_course[{{$j}}_{{$k}}_{{$l}}]" value="{{$CoursesCategory->id}}_{{$assignCollegeValue->getColleges->id}}_{{$AssignCategoryCollegeValue->getCourses->id}}" class="custom-control-input" id="category_college_course{{$CoursesCategory->id}}_{{$assignCollegeValue->getColleges->id}}_{{$AssignCategoryCollegeValue->getCourses->id}}">
                                                                        <label class="custom-control-label" for="category_college_course{{$CoursesCategory->id}}_{{$assignCollegeValue->getColleges->id}}_{{$AssignCategoryCollegeValue->getCourses->id}}">{{$AssignCategoryCollegeValue->GetCourses->name}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>-->


                                                        <?php $l++; endif; endforeach;?>
                                                            </select> 
                                                                </div>
                                                            </div>
                                                                 
                                                                  <?php endif; ?>
                                                                 
                                                                 
                                            </div>
                                                        <?php else: ?>
                                                            <p style="text-align:left; font-weight:500; color: red"> Sorry! No courses here. </p>
                                                        <?php endif; ?>

                                                <?php endif; $k++; endforeach;?>
                                                <?php else: ?>
                                                    <p style="text-align:center; font-weight:600"> Sorry! Nothing to show here. </p>
                                                <?php endif;?>
                                            </div>
                                        <?php $j++; endforeach;  ?>
                                        </div>
                                    </div>


                                    <div style=" display: flex; justify-content: space-between; margin-top: 20px">
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
        <link rel="stylesheet" href="{{asset('public/assets/libs/jquery-smarttab/smart_tab_all.css')}}" type="text/css" >
        <link rel="stylesheet" href="{{asset('public/assets/libs/jquery-smarttab/smart_tab.css')}}">
@endsection

@section('js')
<script src="{{asset('public/assets/libs/jquery-smarttab/jquery.smartTab.js')}}"></script>
<script src="{{asset('Modules/Web/Resources/assets/js/courses_colleges.js')}}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
 
 // SmartTab initialize
 $('#smarttab').smartTab({
     orientation: 'vertical',
     justified: 'false'
    //  theme: 'brick'
 });

});
</script>

@endsection
