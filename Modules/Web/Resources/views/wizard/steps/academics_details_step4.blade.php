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
        $web_user = null; $courses_category_id = null; $CoursesCategory = null;
        if(Auth::guard(web_guard) && Auth::guard(web_guard)->user()):
            $web_user = Auth::guard(web_guard)->user();
        endif;
        if($web_user):
            $AssignUserCategoryCollegesCourses = \Modules\Web\Entities\AssignUserCategoryCollegesCourses::where('user_id', $web_user->id)->get();
            if($AssignUserCategoryCollegesCourses->isNotEmpty()):
                $courses_category_id = $AssignUserCategoryCollegesCourses->pluck('courses_category_id')->unique()->first();
            endif;
        endif;
        
        if($courses_category_id):
            $CoursesCategory = Modules\Web\Entities\CoursesCategory::find($courses_category_id);
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
                            Academic Details
                            <div class="step-container" style="">
                            <div class="step-inactive-container" style=""><p class="step-inactive" style="">Step 1</p></div>
                            <div class="step-inactive-container" style=""><p class="step-inactive" style="">Step 2</p></div>
                            <div class="step-inactive-container" style=""><p class="step-inactive" style="">Step 3</p></div>
                            <div class="step-active-container" style=""><p class="step-active" style="">Step 4</p></div>
                            </div> 
                        </h5>

                        <form action="{{route('accademic_step_store')}}" method="post" id="accademic_info_form" enctype="multipart/form-data"> 
                            @csrf 
                            <div>
                                <h4 class="header-title" style="margin-bottom: 15px">10th/Equivalent</h4> 
                                <div class="row">
                                    <div class="col-md-4" > 
                                        <div class="form-group">
                                            <label>Board of Examination<span class="text-danger">*</span> </label>
                                            <select class="form-control" id="tenth_board" name="tenth_board">
                                                <option value="">select</option>
                                                <?php
                                                    $Board = \Modules\Web\Entities\Board::where('board_type',1)->get();
                                                    foreach ($Board as $BoardKey => $BoardValue):
                                                    ?>
                                                           <option  @if(isset($web_user) && $web_user->tenth_board == $BoardValue->name) selected @endif  value="{{$BoardValue->name}}">{{$BoardValue->name}}</option>

                                                    <?php endforeach;?>
                                            </select>
                                            @if($errors->has('tenth_board'))
                                                <label class="validation-error-label">{{ $errors->first('tenth_board') }}</label>
                                            @endif
                                        </div> 
                                    </div>
                                    <div class="col-md-4">  
                                        <div class="form-group">
                                            <label>Passing Year <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" name="tenth_passing_year" value="{{isset($web_user->tenth_passing_year) ? $web_user->tenth_passing_year  : old('tenth_passing_year')}}"  placeholder="Enter Passing Year ">
                                            @if($errors->has('tenth_passing_year'))
                                                <label class="validation-error-label">{{ $errors->first('tenth_passing_year') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">  
                                        <div class="form-group">
                                            <label>Register Number<span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" name="tenth_register_number" value="{{isset($web_user->tenth_register_number) ? $web_user->tenth_register_number  : old('tenth_register_number')}}"  placeholder="Enter Register Number ">
                                            @if($errors->has('tenth_register_number'))
                                                <label class="validation-error-label">{{ $errors->first('tenth_register_number') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4" > 
                                        <div class="form-group">
                                            <label>Total Percentage <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" name="tenth_marks" value="{{isset($web_user->tenth_marks) ? $web_user->tenth_marks  : old('tenth_marks')}}" placeholder="Enter Marks">
                                            @if($errors->has('tenth_marks'))
                                                <label class="validation-error-label">{{ $errors->first('tenth_marks') }}</label>
                                            @endif
                                        </div> 
                                    </div>
                                    <div class="col-md-6" > 
                                        <div class="form-group"> 
                                            <label class="display-block"> SSLC Mark List Upload Here <?php if(isset($web_user->tenth_marks) && $web_user->tenth_marks !=null):?> <code id="tenth_marks_uploded">(uploded)</code> <?php else: ?> <span class="text-danger">*</span> <?php endif; ?></label>
                                            <?php if(isset($web_user->tenth_marks) && $web_user->tenth_marks !=null):?> 
                                            <input type="hidden" name="hidden_tenth_marks" value="1"/>
                                                <?php endif; ?>
                                            <input name="tenth_mark_list" type="file" class="file-styled"> 
                                            <small id="mark_list_tenthHelp" class="form-text text-muted">File format must be .jpg, .jpeg, .png, .pdf .</small> 
                                            <div id="tenth_mark_list_error"> 
                                                @if($errors->has('tenth_mark_list'))
                                                    <label class="validation-error-label">{{ $errors->first('tenth_mark_list') }}</label>
                                                @endif
                                            </div> 
                                        </div>
                                    </div>
                                </div> 
                                <hr/>
                            </div>
                             <div>
                                <div class="row">
                                    <div class="col-md-4"> 
                                        <div class="checkbox checkbox-success mb-2" style="margin-top: 25px;"> 
                                            <?php
                                            $scholarship_exam_checked = null;
                                            if(isset($web_user->scholarship_exam) && $web_user->scholarship_exam ==1):
                                                $scholarship_exam_checked = 'checked=""';
                                            endif;
                                            ?>
                                            <input id="scholarship_exam" name="scholarship_exam" type="checkbox" {{$scholarship_exam_checked}}  value='1'  >
                                            <label for="scholarship_exam" style="font-weight: 500">I Attended MGM Scholarship Exam </label>
                                        </div>
                                     </div>
                                    <?php if( isset($CoursesCategory->slug) && $CoursesCategory->slug=='b.tech-lateral-entry-3yrs-(after-diploma)' ): ?>
                                    <div class="col-md-4" > 
                                        <div class="form-group">
                                            <label>Did you attended LET ? </label>
                                            <select class="form-control" id="let_exam" name="let_exam">
                                                <option value="">select</option>
                                                <option  @if(isset($web_user->let_exam) && $web_user->let_exam ==1) selected @endif  value="1">Yes</option>
                                                <option  @if(isset($web_user->let_exam) && $web_user->let_exam ==0) selected @endif  value="0">No</option>
                                            </select>
                                            @if($errors->has('let_exam'))
                                                <label class="validation-error-label">{{ $errors->first('let_exam') }}</label>
                                            @endif
                                        </div> 
                                    </div>
                                    <?php endif; ?>
                                    
                                    <?php if( isset($CoursesCategory->slug) && $CoursesCategory->slug=='b.tech-4-yrs' ): ?>
                                    <div class="col-md-4" > 
                                        <div class="form-group">
                                            <label>Quota  <span class="text-danger rem_danger ">*</span></label>
                                            <select class="form-control" id="quota" name="quota" required="">
                                                <option value="">select</option>
                                                <option  @if(isset($web_user->quota) && $web_user->quota =='NRI') selected @endif  value="NRI">NRI</option>
                                                <option  @if(isset($web_user->quota) && $web_user->quota =='Management') selected @endif  value="Management">Management</option>
                                            </select>
                                            @if($errors->has('quota'))
                                                <label class="validation-error-label">{{ $errors->first('quota') }}</label>
                                            @endif
                                        </div> 
                                    </div>
                                    <?php endif; ?>
                                    
                                 </div>
                                 <hr/>
                            </div>
                            <div id="plus_two_div">
                                <?php
                                        $plus_two_title='Plus Two/Equivalent'; 
                                        $board_type_numer =2;
                                        if( isset($CoursesCategory->slug) && $CoursesCategory->slug=='b.tech-lateral-entry-3yrs-(after-diploma)' ):
                                            $plus_two_title='Polytechnic Diploma/Equivalent';  $board_type_numer =3;
                                        endif;
                                        if( isset($CoursesCategory->slug) && $CoursesCategory->slug=='polytechnic-diploma-lateral-entry-2-yrs-(after-plus-two-(pcm)-/-iti)' ):
                                            $plus_two_title='Plus Two/ITI/Equivalent'; 
                                        endif;
                                 ?>
                                    
                                <h4 class="header-title" style="margin-bottom: 15px">{{$plus_two_title}}</h4> 
                                <div class="row">
                                <div class="col-md-4" > 
                                    <div class="form-group">
                                        <label>Board of Examination<span class="text-danger rem_danger ">*</span> </label>
                                        <select class="form-control" id="plus_two_board" name="plus_two_board">
                                            <option value="">select</option>
                                            <?php
                                                $Board = \Modules\Web\Entities\Board::where('board_type',$board_type_numer)->get();
                                                foreach ($Board as $BoardKey => $BoardValue):
                                                ?>
                                                       <option  @if(isset($web_user) && $web_user->plus_two_board == $BoardValue->name) selected @endif  value="{{$BoardValue->name}}">{{$BoardValue->name}}</option>

                                                <?php endforeach;?>
                                        </select>
                                        @if($errors->has('plus_two_board'))
                                            <label class="validation-error-label">{{ $errors->first('plus_two_board') }}</label>
                                        @endif
                                    </div> 
                                </div>
                                <div class="col-md-4">  
                                    <div class="form-group">
                                        <label>Passing Year <span class="text-danger rem_danger">*</span> </label>
                                        <input type="text" class="form-control" name="plus_two_passing_year" value="{{isset($web_user->plus_two_passing_year) ? $web_user->plus_two_passing_year  : old('plus_two_passing_year')}}"  placeholder="Enter Passing Year ">
                                        @if($errors->has('plus_two_passing_year'))
                                            <label class="validation-error-label">{{ $errors->first('plus_two_passing_year') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">  
                                    <div class="form-group">
                                        <label>Register Number<span class="text-danger rem_danger">*</span> </label>
                                        <input type="text" class="form-control" name="plus_two_register_number" value="{{isset($web_user->plus_two_register_number) ? $web_user->plus_two_register_number  : old('plus_two_register_number')}}"  placeholder="Enter Register Number ">
                                        @if($errors->has('plus_two_register_number'))
                                            <label class="validation-error-label">{{ $errors->first('plus_two_register_number') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-4" > 
                                        <div class="form-group">
                                            <label>Total Percentage <span class="text-danger rem_danger">*</span> </label>
                                            <input type="text" class="form-control" name="plus_two_marks" value="{{isset($web_user->plus_two_marks) ? $web_user->plus_two_marks  : old('plus_two_marks')}}" placeholder="Enter Marks">
                                            @if($errors->has('plus_two_marks'))
                                                <label class="validation-error-label">{{ $errors->first('plus_two_marks') }}</label>
                                            @endif
                                        </div> 
                                    </div>
                                    <div class="col-md-4" > 
                                        
                                        <div class="form-group"> 
                                            <label class="display-block">Mark List Upload Here <?php if(isset($web_user->mark_list_plus_two) && $web_user->mark_list_plus_two !=null):?> <code id="mark_list_plus_two_uploded">(uploded)</code> <?php endif; ?></label>
                                            <input name="mark_list_plus_two" type="file" class="file-styled"> 
                                            <small id="mark_list_plus_two_Help" class="form-text text-muted">File format must be .jpg, .jpeg, .png, .pdf .</small> 
                                            <div id="mark_list_plus_two_error"> 
                                                @if($errors->has('mark_list_plus_two'))
                                                    <label class="validation-error-label">{{ $errors->first('mark_list_plus_two') }}</label>
                                                @endif
                                            </div> 
                                        </div>
                                    </div>
                                    <?php if($CoursesCategory->slug=='polytechnic-diploma-3-yrs'):?>
                                     
                                        <input type="hidden" name="HiddenCheck" id="HiddenCheck" value="1"/>
                                        <div class="col-md-4">  
                                            <div class="form-group">
                                                <label>Stream</label>
                                                <input type="text" class="form-control" name="plus_two_stream" id="plus_two_stream" value="{{isset($web_user->plus_two_stream) ? $web_user->plus_two_stream  : old('plus_two_stream')}}"  placeholder="Enter stream ">
                                                @if($errors->has('plus_two_stream'))
                                                    <label class="validation-error-label">{{ $errors->first('plus_two_stream') }}</label>
                                                @endif
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                </div> 
                                <hr/>
                            </div> 
                            
                                    <?php   if(
                                                isset($CoursesCategory->slug)
                                                &&
                                                ( 
                                                    $CoursesCategory->slug=='polytechnic-diploma-lateral-entry-2-yrs-(after-plus-two-(pcm)-/-iti)' ||
                                                    $CoursesCategory->slug=='b.tech-4-yrs' || $CoursesCategory->slug=='b.tech-lateral-entry-3yrs-(after-diploma)' 
//                                                    $CoursesCategory->slug=='polytechnic-diploma-3-yrs'
                                                )
                                            ):
                                        ?>
                                            <div>
                                                <div class="row"> 
                                                    <div class="col-md-4">  
                                                        <div class="form-group">
                                                            <label>PHYSICS + CHEMISTRY + MATHS %<span class="text-danger rem_danger">*</span> </label>
                                                            <input type="text" class="form-control" name="pcm" id="pcm" value="{{isset($web_user->pcm) ? $web_user->pcm  : old('pcm')}}"  placeholder="Enter pcm ">
                                                            @if($errors->has('pcm'))
                                                                <label class="validation-error-label">{{ $errors->first('pcm') }}</label>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    </div>
                                                <hr/>
                                            </div>
                                    
                                    <?php endif; ?>
                                         
                                        
                                    <?php if(
                                                isset($CoursesCategory->slug)
                                                &&
                                                ( 
                                                    $CoursesCategory->slug=='b.-pharm-4-yrs' || $CoursesCategory->slug=='d.-pharm-2-yrs' 
                                                )
                                            ): ?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-5">  
                                                <div class="form-group">
                                                    <label>PHYSICS + CHEMISTRY + MATHS/BIOLOGY %<span class="text-danger rem_danger">*</span> </label>
                                                    <input type="text" class="form-control" name="pcb_m" id="pcb_m" value="{{isset($web_user->pcb_m) ? $web_user->pcb_m  : old('pcb_m')}}"  placeholder="Enter PCB/PCM ">
                                                    @if($errors->has('pcb_m'))
                                                        <label class="validation-error-label">{{ $errors->first('pcb_m') }}</label>
                                                    @endif
                                                </div>
                                            </div>
                                             </div>
                                        <hr/>
                                    </div>
                                    
                                        <?php endif; ?>
                                     
                                 
                            
                            
                            
                            <div>
                                <div class="row">
                                    <div class="col-md-4"> 
                                        <div class="checkbox checkbox-success mb-2" style="margin-left: 0px;margin-top: 25px;padding-bottom: 10px"> 
                                            <?php
                                            $checked = null;
                                            if(isset($web_user->entrance_exam) && $web_user->entrance_exam ==1):
                                                $checked = 'checked=""';
                                            endif;
                                            ?>
                                            <input id="entrance_exam" name="entrance_exam" type="checkbox" {{$checked}}  value='1'  >
                                            <label for="entrance_exam" style="font-weight: 500"> Did You Attend  Entrance Exam ?</label>
                                        </div>
                                     </div>
                                </div>    
                                <div class="row">
                                    <div class="col-md-4 show_entrance" @if($checked==null) style="display: none" @endif>  
                                        <div class="form-group">
                                            <label>Name of the Entrance Examination<span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" name="entrance_name" value="{{isset($web_user->entrance_name) ? $web_user->entrance_name  :  old('entrance_name')}}"  placeholder="Eg: KEAM, JEE, NEET etc">
                                            @if($errors->has('entrance_name'))
                                                <label class="validation-error-label">{{ $errors->first('entrance_name') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 show_entrance" @if($checked==null) style="display: none" @endif > 
                                         <?php
                                            $checkedd = null;
                                           
                                            if(isset($web_user->entrance_result_waiting) && $web_user->entrance_result_waiting ==1):
                                                $checkedd = 'checked=""';
                                            endif;
                                              
                                            ?>
                                        <div class="form-group entrance_rank_hide" >
                                            <label>Entrance Examination - Rank<span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" @if($checkedd != null) disabled="" @endif  id="entrance_rank" name="entrance_rank" value="{{isset($web_user->entrance_rank) ? $web_user->entrance_rank  :   old('entrance_rank')}}"  placeholder="Enter Your Rank ">
                                            @if($errors->has('entrance_rank'))
                                                <label class="validation-error-label">{{ $errors->first('entrance_rank') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 show_entrance" @if($checked==null) style="display: none" @endif> 
                                        
                                        <div class="checkbox checkbox-success mb-2" style="margin-left: 10px;margin-top: 25px;">  
                                            <input id="entrance_result_waiting"  name="entrance_result_waiting" type="checkbox" {{$checkedd}}  value='1'  >
                                            <label for="entrance_result_waiting" style="font-weight: 500">Entrance Exam Result Awaiting ?</label>
                                        </div>
                                     </div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-4 show_entrance" @if($checked==null) style="display: none" @endif>  
                                        <div class="form-group">
                                            <label>Name of the Entrance Examination<span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" name="entrance_name_1" value="{{isset($web_user->entrance_name_1) ? $web_user->entrance_name_1  :  old('entrance_name_1')}}"  placeholder="Eg: KEAM, JEE, NEET etc">
                                            @if($errors->has('entrance_name_1'))
                                                <label class="validation-error-label">{{ $errors->first('entrance_name_1') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 show_entrance" @if($checked==null) style="display: none" @endif > 
                                         <?php
                                            $checkedd = null;
                                           
                                            if(isset($web_user->entrance_result_waiting_1) && $web_user->entrance_result_waiting_1 ==1):
                                                $checkedd = 'checked=""';
                                            endif;
                                              
                                            ?>
                                        <div class="form-group entrance_rank_hide" >
                                            <label>Entrance Examination - Rank<span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" @if($checkedd != null) disabled="" @endif  id="entrance_rank_1" name="entrance_rank_1" value="{{isset($web_user->entrance_rank_1) ? $web_user->entrance_rank_1  :   old('entrance_rank_1')}}"  placeholder="Enter Your Rank ">
                                            @if($errors->has('entrance_rank_1'))
                                                <label class="validation-error-label">{{ $errors->first('entrance_rank_1') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 show_entrance" @if($checked==null) style="display: none" @endif> 
                                        
                                        <div class="checkbox checkbox-success mb-2" style="margin-left: 10px;margin-top: 25px;">  
                                            <input id="entrance_result_waiting_1"  name="entrance_result_waiting_1" type="checkbox" {{$checkedd}}  value='1'  >
                                            <label for="entrance_result_waiting_1" style="font-weight: 500">Entrance Exam Result Awaiting ?</label>
                                        </div>
                                     </div>
                                </div>
                     
                                <hr/>
                            </div>
                           
                            
                            
                            
                            
                            
                            <div style=" display: flex; justify-content: space-between">
                                <div></div>
                                <div class="form-group mb-0 text-center ">
                                    <button style="max-width: 100px; margin-bottom: 10px" class="btn btn-danger btn-block" type="submit"> Submit </button>
                                    <code style=" text-align: center"> All marked (*) fields are required </code>
                                </div>
                            </div> 
                        </form> 
                    </div>  
                </div>  
            </div> 
        </div>
    </div>
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
<script src="{{asset('Modules/Web/Resources/assets/js/accademic_info.js')}}" type="text/javascript"></script>

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


<!--<script type="text/javascript">
        $("#gender").select2();
    </script>-->

    <!-- <script type="text/javascript">
if($('.datepicker').length)
    {
         jQuery('.datepicker').datepicker({
            format: "dd-mm-yyyy", 
        });
    }

    </script> -->

@endsection
