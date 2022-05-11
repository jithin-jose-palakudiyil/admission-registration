@extends('colleges::layouts.master')
 
@section('content') 

<style>

@media only screen and (min-width:576px){
  .display-a{
        display: block;
  }
  .display-b{
    display:none
}

.display-c{
        display: block;
  }
  .display-d{
    display:none
}
}

@media only screen and (max-width:576px){
    .display-a{
    display:none
}
  .display-b{
    display:block
  }

  .display-c{
    display:none
}
  .display-d{
    display:block
  }
}

</style>
 
 
<?php if(isset($user)): 
    
    $caste_category = "Nil";
    if($user->caste_category != null ):
        if($user->caste_category == "Other"){
            $caste_category = $user->caste_category_other == null ? "Nil" : $user->caste_category_other; 
        }else{
            $caste_category = $user->caste_category;
        }
    endif;


     

    ?>
 <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                        <h3>Personal Info</h3>
                        <hr/>
                        <div class="display-a">
                            <div style="margin-top: 20px" class="row">
                                <div class="col-sm-4">
                                    <h5>Name</h5>
                                    {{$user->name == null ? "Nil" : $user->name}}
                                </div>

                                <div class="col-sm-4">
                                    <h5>Email</h5>
                                    {{$user->email == null ? "Nil" : $user->email}}
                                </div>

                                <div class="col-sm-4">
                                    <h5>Gender</h5>
                                    {{$user->gender == null ? "Nil" : ($user->gender == "m" ? "Male" : "Female")}}
                                </div>
                            </div>


                            <div style="margin-top: 20px" class="row">
                                <div class="col-sm-4 align-center">
                                    <h5>Address</h5>
                                    {{$user->address == null ? "Nil" : $user->address}}

                                </div>

             
                                <div class="col-sm-4">
                                    <h5>District</h5>
                                    {{$user->district == null ? "Nil" : $user->district}}
                                </div>
                                
                                <div class="col-sm-4 align-center">
                                    <h5>Pin code</h5>
                                    {{$user->pincode == null ? "Nil" : $user->pincode}}
                                </div>
                            </div>

                            <div style="margin-top: 20px" class="row">

                                <div class="col-sm-4">
                                    <h5>Date of birth</h5>
                                    {{$user->date_of_birth == null ? "Nil" : $user->date_of_birth}}
                                </div>

                                <div class="col-sm-4">
                                    <h5>Caste</h5>
                                    {{$caste_category}}
                                </div>
                               
                                <div class="col-sm-4 align-center">
                                    <h5>Mobile number</h5>
                                    {{$user->mobile == null ? "Nil" : $user->mobile}}
                                </div>
                            </div>

                            
                            
                            <div style="margin-top: 20px" class="row">
                                <div class="col-sm-4">
                                    <h5>Whatsapp number</h5>
                                    {{$user->whatsapp == null ? "Nil" : $user->whatsapp}}
                                </div>

                                <div class="col-sm-4">
                                    <h5>Parent name</h5>
                                    {{$user->parent_name == null ? "Nil" : $user->parent_name}}
                                </div>

                                <div class="col-sm-4 align-center">
                                    <h5>Parent contact number</h5>
                                    {{$user->parent_contact == null ? "Nil" : $user->parent_contact}}
                                </div>

                            </div>
 


                        </div>  

                        <div class="table-responsive display-b">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                    <th style="text-transform: capitalize;" scope="row">Name</th>
                                    <td>{{$user->name == null ? "Nil" : $user->name}}</td>
                                    </tr>
                                    <tr>
                                    <th style="text-transform: capitalize;" scope="row">Email</th>
                                    <td>{{$user->email == null ? "Nil" : $user->email}}</td>
                                    </tr>
                                    <tr>
                                    <th style="text-transform: capitalize;" scope="row">Gender</th>
                                    <td> {{$user->gender == null ? "Nil" : ($user->gender == "m" ? "Male" : "Female")}} </td>
                                    </tr>
                                    <tr>
                                    <th style="text-transform: capitalize;" scope="row">Address</th>
                                    <td>{{$user->address == null ? "Nil" : $user->address}}</td>
                                    </tr>
                                    <tr>
                                    <th style="text-transform: capitalize;" scope="row">District</th>
                                    <td>{{$user->district == null ? "Nil" : $user->district}}</td>
                                    </tr>
                                    <th style="text-transform: capitalize;" scope="row">Pin code</th>
                                    <td>{{$user->pincode == null ? "Nil" : $user->pincode}}</td>
                                    </tr>
                                    <tr>
                                    <th style="text-transform: capitalize;" scope="row">Date of birth</th>
                                    <td>{{$user->date_of_birth == null ? "Nil" : $user->date_of_birth}}</td>
                                    </tr>
                                    <tr>
                                    <th style="text-transform: capitalize;" scope="row">Caste</th>
                                    <td>{{$caste_category}}</td>
                                    </tr>
                                    <tr>
                                    <th style="text-transform: capitalize;" scope="row">Mobile number</th>
                                    <td>{{$user->mobile == null ? "Nil" : $user->mobile}}</td>
                                    </tr>
                                    <tr>
                                    <th style="text-transform: capitalize;" scope="row">Whatsapp number</th>
                                    <td>{{$user->whatsapp == null ? "Nil" : $user->whatsapp}}</td>
                                    </tr>
                                    <tr>
                                    <th style="text-transform: capitalize;" scope="row">Parent name</th>
                                    <td>{{$user->parent_name == null ? "Nil" : $user->parent_name }}</td>
                                    </tr>
                                    <tr>
                                    <th style="text-transform: capitalize;" scope="row">Parent contact number</th>
                                    <td>{{$user->parent_contact == null ? "Nil" : $user->parent_contact}}</td>
                                    </tr>
                                     
                                    
                                </tbody>
                            </table>
                        </div>
                         <?php   $web_user = $user;   $courses_category_id = null; $CoursesCategory = null;
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
                        <div style="margin-top: 20px" class="row">
                            <div class="col-lg-12">
                                <h3>Accademic Details</h3><br/>
                            </div>
                           
                            
                            
                        </div>

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
                                     <div class="col-lg-2">
                                <div class="form-group mb-3">
                                    <label for="tenth_mark">mark list  {!!(isset($web_user->tenth_mark_list) && $web_user->tenth_mark_list !=null) ?   '<code id="tenth_mark_list_rem">uploded</code>' : ''!!} </label>
                                    <?php if(isset($web_user->tenth_mark_list) && $web_user->tenth_mark_list !=null):?><br/> <a href="{{asset('public/'.$web_user->tenth_mark_list)}}" target="_blank"><i class="la la-clipboard" style="font-size: 22px"></i></a> <?php endif; ?>
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
                                    <div class="col-lg-2">
                                <div class="form-group mb-3">
                                    <label for="mark_list_plus_two">mark list  {!!(isset($web_user->mark_list_plus_two) && $web_user->mark_list_plus_two !=null) ?   '<code id="tenth_mark_list_rem">uploded</code>' : ''!!} </label>
                                    <?php if(isset($web_user->mark_list_plus_two) && $web_user->mark_list_plus_two !=null):?><br/> <a href="{{asset('public/'.$web_user->mark_list_plus_two)}}" target="_blank"><i class="la la-clipboard" style="font-size: 22px"></i></a> <?php endif; ?>
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
                           
                            
                            
                            
                            
                            
 

                        
                        
                         
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->

    </div>
<!-- end row-->

<?php  if(isset($selectedCategories) && count($selectedCategories) > 0):?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3>Courses with preferences</h3>
                    <hr/>
                    <?php $i=1 ; foreach($selectedCategories as $selectedCategorieskey => $SelectedCategoriesValue):?>
                        <div style="margin-bottom: 20px; ">
                        <h4 class="auth-title" style="margin-right: 5px; margin-left: 5px"> <i class="la la-book"></i> {{$SelectedCategoriesValue->name}}</h4>
                             <?php $AssignUserCategoryColleges = \Modules\Web\Entities\AssignUserCategoryCollegesCourses::where('user_id', $user->id)->where('courses_category_id', $SelectedCategoriesValue->id)->where('college_id',Auth::guard(colleges_guard)->user()->id)->get();
                                 if(isset($AssignUserCategoryColleges)): 
                                                 
                                    $j=1 ; foreach ($AssignUserCategoryColleges->unique('college_id') as $AssignUserCategoryCollegesKey => $AssignUserCategoryCollegesValue):
                                       $Colleges =  \Modules\Admin\Entities\Colleges::where('id', $AssignUserCategoryCollegesValue->college_id)->first();
                             ?> 
                                     <!--<i style="margin-right: 8px; display: inline-block; font-size: 23px" class="la la-institution"></i><h4 style="display: inline-block">{!!$Colleges->name!!}</h4>-->
<!--                                     <div style="display: flex; flex-direction: row">-->
                                    <div style="">
                                     <?php $AssignUserCategoryCollegesCourses = \Modules\Web\Entities\AssignUserCategoryCollegesCourses::where('user_id', $user->id)->where('courses_category_id', $SelectedCategoriesValue->id)->where('college_id', $Colleges->id)->get();
                                            if(isset($AssignUserCategoryCollegesCourses)): 
                                          $k=1;  foreach ($AssignUserCategoryCollegesCourses as $AssignUserCategoryCollegesCoursesKey => $AssignUserCategoryCollegesCoursesValue):
                                            $courses = \Modules\Admin\Entities\Courses::where('id', $AssignUserCategoryCollegesCoursesValue->course_id)->first();
                                  
                                          $preference =  $AssignUserCategoryCollegesCoursesValue->preference;
                                        ?>
                                         <p style="margin-left: 30px; font-size: 15px">Preference : <b>{{$preference}}</b>, Course <b>{{$courses->name}}</b></p>

                                            
                                        <?php $k++; endforeach; endif; ?>
                                        </div>
                                                <!-- Third loop else here -->
                             <?php $j++; endforeach; endif;?>
                                <!-- second loop else here -->
                         </div>       
                    <?php $i++; endforeach;?>        
            </div>
        </div>
    </div>
<?php endif; ?>


    <?php else: ?>
    <p>Sorry ! But there is no information available.</P>
    <?php endif; ?>
                          
@stop

@section('js')
<script> $(function()  { $('input,radio,select').prop('disabled', true); });</script>
@endsection

