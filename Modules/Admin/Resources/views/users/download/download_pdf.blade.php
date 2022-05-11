<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MGM - User Details</title> 
    <style>
    .auth-title{
        background-color: #f7fafb;
        border-top: 1px solid #ecf2f4;
        border-bottom: 1px solid #ecf2f4;
        padding: 12px 2.25rem;
        margin: 0 -2.25rem 30px;
        text-transform: uppercase;
        font-weight: 700;
        text-align: center;
    }
    .tabletd{
        font-weight: bold
    }
    </style>
</head>
<body style="background-color: white">
<table width=100%>
      <tr>
        <td align="center">
            <img height="55px" src="{{public_path('assets/images/mgm_btech.png')}}"/>
        </td>
      </tr>
  </table>
  <?php
    $user = null;
    if(isset($data['user'])):
        $user = $data['user'];
    endif;
    
    if($user):
        ?> 
    <table style="margin-top: 25px; margin-bottom: 35px" width=100%>
      <tr>
        <td align="center" >
            <div class="auth-title"> User Details <?php if($user->name != null):  echo " - ".$user->name; endif; ?> </div>
        </td>
      </tr>
  </table>

<table width=100% class="table table-borderless">
    <tbody>
        <!--row-1-->
        <tr>
          <td style="font-weight: bold; font-size: 15px">Name</td>
          <td style="font-weight: bold; font-size: 15px">Email</td>
          <td style="font-weight: bold; font-size: 15px">Gender</td>
        </tr> 
        <tr>
          <td style="font-size: 15px">{{ (isset($user->name) && $user->name ==null) ? "Nil" : $user->name }}</td>
          <td style="font-size: 15px">{{ (isset($user->email) && $user->email ==null) ? "Nil" : $user->email }}</td>
          <td style="font-size: 15px"><?php if(isset($user->gender) && $user->gender =='m'): echo "Male"; elseif(isset($user->gender) && $user->gender =='f'): echo "Female"; endif; ?></td>
        </tr>
        
        <!--row-2-->
        <tr>
          <td style="font-weight: bold; font-size: 15px">Address</td>
          <td style="font-weight: bold; font-size: 15px">District</td>
          <td style="font-weight: bold; font-size: 15px">Pin code</td>
        </tr> 
        <tr>
          <td style="font-size: 15px">{{ (isset($user->address) && $user->address ==null) ? "Nil" : $user->address }}</td>
          <td style="font-size: 15px">{{ (isset($user->district) && $user->district ==null) ? "Nil" : $user->district }}</td>
          <td style="font-size: 15px">{{ (isset($user->pincode) && $user->pincode ==null) ? "Nil" : $user->pincode }}</td>
        </tr>
        
        <!--row-3--> 
        <tr>
            <td style="font-weight: bold; font-size: 15px">Date of birth</td>
            <td style="font-weight: bold; font-size: 15px">Caste</td>
            <td style="font-weight: bold; font-size: 15px">Mobile number</td>
        </tr> 
        <tr>
          <td style="font-size: 15px">{{ (isset($user->date_of_birth) && $user->date_of_birth ==null) ? "Nil" : $user->date_of_birth }}</td>
          <td style="font-size: 15px">
              <?php
                $caste_category = "Nil";
                if(isset($user->caste_category) && $user->caste_category != null ):
                    if($user->caste_category == "Other"){
                        $caste_category = $user->caste_category_other == null ? "Nil" : $user->caste_category_other; 
                    }else{
                        $caste_category = $user->caste_category;
                    }
                endif;
              ?>
              {{ $caste_category }}
          </td>
          <td style="font-size: 15px">{{ (isset($user->mobile) && $user->mobile ==null) ? "Nil" : $user->mobile }}</td>
          
        </tr>
        
        <!--row-4-->
        <tr>
          <td style="font-weight: bold; font-size: 15px">Whatsapp number</td>
          <td style="font-weight: bold; font-size: 15px">Parent name</td>
          <td style="font-weight: bold; font-size: 15px">Parent contact number</td>
        </tr> 
        <tr>
          <td style="font-size: 15px">{{ (isset($user->whatsapp) && $user->whatsapp ==null) ? "Nil" : $user->whatsapp }}</td>
          <td style="font-size: 15px">{{ (isset($user->parent_name) && $user->parent_name ==null) ? "Nil" : $user->parent_name }}</td>
          <td style="font-size: 15px">{{ (isset($user->parent_contact) && $user->parent_contact ==null) ? "Nil" : $user->parent_contact }}</td>
          
        </tr>
    </tbody>
</table>
    
    
      <table style="margin-top: 70px;" width=100%>
      <tr>
        <td align="center">
        <h4 class="auth-title">Accademic Details</h4>
        </td>
      </tr>
      </table> 
<table width=100% class="table table-borderless">
    <tbody>
        <tr>
            <td colspan="3" align="center"><div style="font-weight: bold;font-size: 20px;margin-bottom: 30px;color: #ff0707;">10th/Equivalent</div></td>
        </tr>
         <?php // dd($user); ?>
        <!--row-1-->
        <tr>
            <td style="font-weight: bold; font-size: 15px">Board of Examination</td>
            <td style="font-weight: bold; font-size: 15px">Passing Year</td>
            <td style="font-weight: bold; font-size: 15px">Register Number</td>
        </tr>  
        <tr>
            <td style="font-size: 15px">{{ (isset($user->tenth_board) && $user->tenth_board ==null) ? "Nil" : $user->tenth_board }}</td>
            <td style="font-size: 15px">{{ (isset($user->tenth_passing_year) && $user->tenth_passing_year ==null) ? "Nil" : $user->tenth_passing_year }}</td>
            <td style="font-size: 15px">{{ (isset($user->tenth_register_number) && $user->tenth_register_number ==null) ? "Nil" : $user->tenth_register_number }}</td>
        </tr>
     
        <!--row-2-->
        <tr>
            <td style="font-weight: bold; font-size: 15px">Total Percentage</td>
            <td style="font-weight: bold; font-size: 15px">Mark list</td>
            <td style="font-weight: bold; font-size: 15px">&nbsp;</td>
        </tr>  
        <tr>
            <td style="font-size: 15px">{{ (isset($user->tenth_marks) && $user->tenth_marks ==null) ? "Nil" : $user->tenth_marks }}</td>
            <td style="font-size: 15px"><?php  if(isset($user->tenth_mark_list) && $user->tenth_mark_list != null): echo 'Uploded'; else: echo "Nil";  endif; ?></td>
            <td style="font-size: 15px">&nbsp;</td>
        </tr>
        
    </tbody>
</table>  
    <?php
   
    $web_user = $user; ?>
   
        <?php
        $scholarship_exam_checked = null;
        if(isset($web_user->scholarship_exam) && $web_user->scholarship_exam ==1):
            $scholarship_exam_checked = 'checked=""';
        endif;
        ?> 
    <hr style="margin-top: 35px"/>
        <table width=100% style="margin-top: 35px;  ">
            <tr>
            <td style="font-weight: bold; font-size: 15px">I Attended MGM Scholarship Exam </td>
            <td style="font-weight: bold; font-size: 15px">Did you attended LET ? </td>
            <td style="font-weight: bold; font-size: 15px">Quota</td>
        </tr> 
        <tr>
            <td style="font-size: 15px">
                 <input id="scholarship_exam" style="margin-top: 6px;background-color: #fff;color: #ff0707" name="scholarship_exam" type="checkbox" {{$scholarship_exam_checked}}  value='1'  >
            </td>
            <td style="font-size: 15px">
               @if(isset($web_user->let_exam) && $web_user->let_exam ==1) Yes @endif
               @if(isset($web_user->let_exam) && $web_user->let_exam ==0) No @endif
            </td>
            <td style="font-size: 15px">
               @if(isset($web_user->quota) && $web_user->quota =='NRI') NRI  
               @elseif(isset($web_user->quota) && $web_user->quota =='Management') Management @else Nil @endif
            </td>
        </tr>
       
        </table>
        
    
    <hr style="margin-top: 35px"/>
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
    <table width=100% class="table table-borderless" style="margin-top: 35px">
    <tbody>
        <tr>
            <td colspan="3" align="center"><div style="font-weight: bold;font-size: 20px;margin-bottom: 30px;color: #ff0707;">{{$plus_two_title}}</div></td>
        </tr>
         <?php // dd($user); ?>
        <!--row-1-->
        <tr>
            <td style="font-weight: bold; font-size: 15px">Board of Examination</td>
            <td style="font-weight: bold; font-size: 15px">Passing Year</td>
            <td style="font-weight: bold; font-size: 15px">Register Number</td>
        </tr>  
        <tr>
            <td style="font-size: 15px">{{ (isset($user->plus_two_board) && $user->plus_two_board ==null) ? "Nil" : $user->plus_two_board }}</td>
            <td style="font-size: 15px">{{ (isset($user->plus_two_passing_year) && $user->plus_two_passing_year ==null) ? "Nil" : $user->plus_two_passing_year }}</td>
            <td style="font-size: 15px">{{ (isset($user->plus_two_register_number) && $user->plus_two_register_number ==null) ? "Nil" : $user->plus_two_register_number }}</td>
        </tr>
     
        <!--row-2-->
        <tr>
            <td style="font-weight: bold; font-size: 15px">Total Percentage</td>
            <td style="font-weight: bold; font-size: 15px">Mark list</td>
            <td style="font-weight: bold; font-size: 15px">&nbsp;</td>
        </tr>  
        <tr> 
            <td style="font-size: 15px">{{ (isset($user->plus_two_marks) && $user->plus_two_marks ==null) ? "Nil" : $user->plus_two_marks }}</td>
            <td style="font-size: 15px"><?php  if(isset($user->mark_list_plus_two) && $user->mark_list_plus_two != null):  echo 'Uploded'; else: echo "Nil"; endif; ?></td>
            <td style="font-size: 15px">&nbsp;</td>
        </tr>
        
    </tbody>
</table> 
    
        <hr style="margin-top: 35px"/>
        <table width=100% style="margin-top: 35px;  ">
        <tr>
            <td style="font-weight: bold; font-size: 15px">Stream </td>
            <td style="font-weight: bold; font-size: 15px">PHYSICS + CHEMISTRY + MATHS % </td>
            <td style="font-weight: bold; font-size: 15px">PHYSICS + CHEMISTRY + MATHS/BIOLOGY %</td>
        </tr> 
        <tr>
            <td style="font-size: 15px">
              {{ (isset($web_user->plus_two_stream) && $web_user->plus_two_stream !=null ) ? $web_user->plus_two_stream  : ''}}
            </td>
            <td style="font-size: 15px">
                {{ (isset($web_user->pcm) && $web_user->pcm !=null ) ? $web_user->pcm  : ''}}
            </td>
            <td style="font-size: 15px">
                {{ (isset($web_user->pcb_m) && $web_user->pcb_m !=null ) ? $web_user->pcb_m  : ''}}
            </td>
        </tr> 
        </table>
        
         <hr style="margin-top: 35px"/>
        <table width=100% style="margin-top: 35px;">
        <tr>
            <td style="font-weight: bold; font-size: 15px" colspan="3">
                Did You Attend  Entrance Exam ?
                    <?php
                $checked = null;
                if(isset($web_user->entrance_exam) && $web_user->entrance_exam ==1):
                    $checked = 'checked=""';
                endif;
                ?>
                <input id="entrance_exam" style="margin-top: 6px;background-color: #fff;color: #ff0707" name="entrance_exam" type="checkbox" {{$checked}}  value='1'  >
            
            </td>
        </tr> 
         <tr>
             <td style="font-size: 15px" colspan="3"> &nbsp; </td>
        </tr>
        <tr>
            <td style="font-weight: bold; font-size: 15px">Name of the Entrance Examination </td>
            <td style="font-weight: bold; font-size: 15px">Entrance Examination - Rank</td>
            <td style="font-weight: bold; font-size: 15px">Entrance Exam Result Awaiting ?</td>
        </tr> 
        <tr>
            <td style="font-size: 15px">
              {{ (isset($web_user->entrance_name) && $web_user->entrance_name !=null ) ? $web_user->plus_two_stream  : ''}}
            </td>
            <td style="font-size: 15px">
                {{ (isset($web_user->entrance_rank) && $web_user->entrance_rank !=null ) ? $web_user->entrance_rank  : ''}}
            </td>
            <td style="font-size: 15px">
                <?php
                $checkedd = null; 
                if(isset($web_user->entrance_result_waiting) && $web_user->entrance_result_waiting ==1):
                    $checkedd = 'checked=""';
                endif;  
                ?>
                 <input id="entrance_result_waiting"  name="entrance_result_waiting" style="margin-top: 6px;background-color: #fff;color: #ff0707" type="checkbox" {{$checkedd}}  value='1'  >
            </td>
        </tr> 
        
        <tr>
            <td style="font-weight: bold; font-size: 15px">Name of the Entrance Examination </td>
            <td style="font-weight: bold; font-size: 15px">Entrance Examination - Rank</td>
            <td style="font-weight: bold; font-size: 15px">Entrance Exam Result Awaiting ?</td>
        </tr> 
        <tr>
            <td style="font-size: 15px">
              {{ (isset($web_user->entrance_name_1) && $web_user->entrance_name_1 !=null ) ? $web_user->plus_two_stream_1  : ''}}
            </td>
            <td style="font-size: 15px">
                {{ (isset($web_user->entrance_rank_1) && $web_user->entrance_rank_1 !=null ) ? $web_user->entrance_rank_1  : ''}}
            </td>
            <td style="font-size: 15px">
                <?php
                $checkedd_1 = null; 
                if(isset($web_user->entrance_result_waiting_1) && $web_user->entrance_result_waiting_1 ==1):
                    $checkedd_1 = 'checked=""';
                endif;  
                ?>
                 <input id="entrance_result_waiting_1"  name="entrance_result_waiting_1" style="margin-top: 6px;background-color: #fff;color: #ff0707" type="checkbox" {{$checkedd_1}}  value='1'  >
            </td>
        </tr> 
    </table>
    
    <?php 
    $selectedCategories = null;
    
    if(isset($data['selectedCategories'])):
        $selectedCategories = $data['selectedCategories'];
    endif;
    if(isset($selectedCategories) && count($selectedCategories) > 0):?>
       
         <table style="margin-top: 50px;" width=100%>
            <tr>
              <td align="center">
              <h4 class="auth-title">Courses with preferences</h4>
              </td>
            </tr>
        </table> 
              
                   
                  
                    <?php $i=1 ; foreach($selectedCategories as $selectedCategorieskey => $SelectedCategoriesValue):?>
                        <div style="margin-bottom: 20px; background-color: #ddd;padding: 5px;">
                                <h4 class="auth-title" style="margin-right: 5px; margin-left: 5px;font-size: 15px!important;background-color: #fff;color: #ff0707"> <i class="la la-book"></i> {{$SelectedCategoriesValue->name}}</h4>
                             <?php $AssignUserCategoryColleges = \Modules\Web\Entities\AssignUserCategoryCollegesCourses::where('user_id', $user->id)->where('courses_category_id', $SelectedCategoriesValue->id)->get();
                                 if(isset($AssignUserCategoryColleges)): 
                                    $j=1 ; foreach ($AssignUserCategoryColleges->unique('college_id') as $AssignUserCategoryCollegesKey => $AssignUserCategoryCollegesValue):
                                       $Colleges =  \Modules\Admin\Entities\Colleges::where('id', $AssignUserCategoryCollegesValue->college_id)->first();
                    ?> 
                                <h4 style="">{!!str_replace("<br>","",$Colleges->name); !!}</h4>
<!--                                     <div style="display: flex; flex-direction: row">-->
                                    
                                     <?php $AssignUserCategoryCollegesCourses = \Modules\Web\Entities\AssignUserCategoryCollegesCourses::where('user_id', $user->id)->where('courses_category_id', $SelectedCategoriesValue->id)->where('college_id', $Colleges->id)->get();
                                            if(isset($AssignUserCategoryCollegesCourses)): 
                                          $k=1;  foreach ($AssignUserCategoryCollegesCourses as $AssignUserCategoryCollegesCoursesKey => $AssignUserCategoryCollegesCoursesValue):
                                            $courses = \Modules\Admin\Entities\Courses::where('id', $AssignUserCategoryCollegesCoursesValue->course_id)->first();
                                  
                                          $preference =  $AssignUserCategoryCollegesCoursesValue->preference;
                                        ?>
                                         <p style="margin-left: 30px; font-size: 15px">Preference : <b>{{$preference}}</b>, Course <b>{{$courses->name}}</b></p>

                                            
                                        <?php $k++; endforeach; endif; ?>
                                        
                                                <!-- Third loop else here -->
                             <?php $j++; endforeach; endif;?>
                                <!-- second loop else here -->
                         </div>       
                    <?php $i++; endforeach;?>        
           
       

<?php endif; ?>
    
    
    
        <?php
    endif;
  ?>
    
  <table width=100% style="margin-top: 65px;  text-align: center; ">
    
    <tr>
        <td>
            <p style="margin-bottom: 0; font-size: 12px; color: #666666;">
                Copyright © <?php  echo date('Y');  ?> MGM. 
            <br> <a href="javascritp:void(0)"style="text-decoration: none; color: black;">All Rights Reserved by MGM.</a></p>
        </td>
    </tr>


</table>


</body>

</html>
