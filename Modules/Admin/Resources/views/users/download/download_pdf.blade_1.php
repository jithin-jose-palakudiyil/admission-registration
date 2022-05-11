<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MGM - User Details</title>
    <link rel="stylesheet" href="{{public_path('assets/css/bootstrap.min.css')}}">
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


  <?php if(isset($user)):
            
    $caste_category = "Nil";
    if($user->caste_category != null ):
        if($user->caste_category == "Other"){
            $caste_category = $user->caste_category_other == null ? "Nil" : $user->caste_category_other; 
        }else{
            $caste_category = $user->caste_category;
        }
    endif;


    $board = "Nil";
    if($user->board != null ):
        if($user->board == "Other"){
            $board = $user->board_other == null ? "Nil" : $user->board_other; 
        }else{
            $board =  $user->board;
        }
    endif;

    ?>

<table style="margin-top: 25px; margin-bottom: 35px" width=100%>
      <tr>
        <td align="center">
            <h4 class="auth-title">User Details {{$user->name == null ? null : " - ".$user->name }}</h4>
        </td>
      </tr>
  </table>



    <table width=100% class="table table-borderless">
  <tbody>
  
  
  <tr>
      <td style="font-weight: bold; font-size: 15px">Name</td>
      <td style="font-weight: bold; font-size: 15px">Email</td>
      <td style="font-weight: bold; font-size: 15px">Gender</td>
    </tr>


    <tr>
      <td style="font-size: 15px">{{$user->name == null ? "Nil" : $user->name}}</td>
      <td style="font-size: 15px">{{$user->email == null ? "Nil" : $user->email}}</td>
      <td style="font-size: 15px">{{$user->gender == null ? "Nil" : ($user->gender == "m" ? "Male" : "Female")}}</td>
    </tr>


    <tr>
      <td style="font-weight: bold; font-size: 15px">Address</td>
      <td style="font-weight: bold; font-size: 15px">District</td>
      <td style="font-weight: bold; font-size: 15px">Pin code</td>
    </tr>


    <tr>
      <td style="font-size: 15px">{{$user->address == null ? "Nil" : $user->address}}</td>
      <td style="font-size: 15px">{{$user->district == null ? "Nil" : $user->district}}</td>
      <td style="font-size: 15px">{{$user->pincode == null ? "Nil" : $user->pincode}}</td>
    </tr>


    <tr>
      <td style="font-weight: bold; font-size: 15px">Date of birth</td>
      <td style="font-weight: bold; font-size: 15px">Caste</td>
      <td style="font-weight: bold; font-size: 15px">Mobile number</td>
    </tr>


    <tr>
      <td style="font-size: 15px">{{$user->date_of_birth == null ? "Nil" : $user->date_of_birth}}</td>
      <td style="font-size: 15px">{{$caste_category}}</td>
      <td style="font-size: 15px">{{$user->mobile == null ? "Nil" : $user->mobile}}</td>
    </tr>


    <tr>
      <td style="font-weight: bold; font-size: 15px">Whatsapp number</td>
      <td style="font-weight: bold; font-size: 15px">Parent name</td>
      <td style="font-weight: bold; font-size: 15px">Parent contact number</td>
    </tr>


    <tr>
      <td style="font-size: 15px">{{$user->whatsapp == null ? "Nil" : $user->whatsapp}}</td>
      <td style="font-size: 15px">{{$user->parent_name == null ? "Nil" : $user->parent_name}}</td>
      <td style="font-size: 15px">{{$user->parent_contact == null ? "Nil" : $user->parent_contact}}</td>
    </tr>


    <tr>
      <td style="font-weight: bold; font-size: 15px">Class completed</td>
      <td style="font-weight: bold; font-size: 15px">Last studied</td>
      <td style="font-weight: bold; font-size: 15px">Board</td>
    </tr>


    <tr>
      <td style="font-size: 15px">{{$user->class_completed == null ? "Nil" : $user->class_completed }}</td>
      <td style="font-size: 15px">{{$user->last_studied == null ? "Nil" : $user->last_studied}}</td>
      <td style="font-size: 15px">{{$board}}</td>
    </tr>


    <tr>
      <td style="font-weight: bold; font-size: 15px">Annual income</td>
    </tr>

    <tr>
      <td style="font-size: 15px">{{$user->annual_income == null ? "Nil" : $user->annual_income }} INR</td>
    </tr>


  </tbody>
</table>

<?php  if(isset($selectedCategories) && count($selectedCategories) > 0):?>

  <table style="margin-top: 180px;" width=100%>
      <tr>
        <td align="center">
        <h4 class="auth-title">Programs & courses</h4>
        </td>
      </tr>
      </table>                    


  <table class="table table-borderless" width=100%>
  <thead>
    <tr>
      <td style="font-weight: bold; font-size: 15px">SI. No</td>
      <td style="font-weight: bold; font-size: 15px">Programs</td>
      <td style="font-weight: bold; font-size: 15px">Colleges & Categories</td>
    </tr>
  </thead>


            <?php $i=1 ; foreach($selectedCategories as $selectedCategorieskey => $SelectedCategoriesValue):?>
      <tr>
      <td style="font-size: 15px">{{$selectedCategorieskey + 1}}</td>
      <td style="font-size: 15px">{{$SelectedCategoriesValue->name}}</td>
      <td style="font-size: 15px">
              <?php $AssignUserCategoryColleges = \Modules\Web\Entities\AssignUserCategoryCollegesCourses::where('user_id', $user->id)->where('courses_category_id', $SelectedCategoriesValue->id)->get();
                                 if(isset($AssignUserCategoryColleges)): 
                                    $j=1 ; foreach ($AssignUserCategoryColleges->unique('college_id') as $AssignUserCategoryCollegesKey => $AssignUserCategoryCollegesValue):
                                       $Colleges =  \Modules\Admin\Entities\Colleges::where('id', $AssignUserCategoryCollegesValue->college_id)->first();
                             ?> 
                                        <p style="margin-bottom: 0!important; font-weight: bold">{!!$Colleges->name!!} - </p>
                                        <?php $AssignUserCategoryCollegesCourses = \Modules\Web\Entities\AssignUserCategoryCollegesCourses::where('user_id', $user->id)->where('courses_category_id', $SelectedCategoriesValue->id)->where('college_id', $Colleges->id)->get();
                                            if(isset($AssignUserCategoryCollegesCourses)): 
                                          $k=1;  foreach ($AssignUserCategoryCollegesCourses as $AssignUserCategoryCollegesCoursesKey => $AssignUserCategoryCollegesCoursesValue):
                                            $courses = \Modules\Admin\Entities\Courses::where('id', $AssignUserCategoryCollegesCoursesValue->course_id)->first();
                                        ?>
                                               <span style="margin-top: 8px">{{$courses->name}}</span>
                                               
                                               
                                        <?php $k++; endforeach; endif; ?>
                                                <!-- Third loop else here -->
                                <?php $j++; endforeach; endif;?>
                                               </td>
                                <!-- second loop else here -->
      </tr>
              <?php $i++; endforeach;?>        
      </table>                    


<?php endif; ?>



    <?php endif;?>


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
