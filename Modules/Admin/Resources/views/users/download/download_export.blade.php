 

<?php if(isset($users) && $users ):   ?>
 
   <table border = 1> 
       <thead> 
           <tr>
                <th>Name </th>
                <th>Email </th>
                <th>Gender </th>
                <th>Address </th>
                <th>District </th>
                <th>Pin code </th>
                <th>Date of birth </th>
                <th>Caste </th>
                <th>Mobile number </th>
                <th>Whatsapp number </th>
                <th>Parent name </th>
                <th>parent contact number </th>
                <th>Class completed </th>
                <th>Last studied </th>
                <th>Board </th>
                <th>Annual income </th>
                <?php 
                // $categories = \Modules\Admin\Entities\Colleges::all();
                $categories = \Modules\Admin\Entities\CoursesCategory::all();

                $i=1;
                foreach ($categories as $key => $value):?>
                <th>{{$value->name}} </th>
                <?php $i++; endforeach; ?>
            </tr>
       </thead> 
     
        <?php 
            foreach ($users as $key => $user): 
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
        <tr> 
            <td>{{$user->name == null ? "Nil" : $user->name}}</td>	
            <td>{{$user->email == null ? "Nil" : $user->email}}</td>	
            <td>{{$user->gender == null ? "Nil" : ($user->gender == "m" ? "Male" : "Female")}}</td>	
            <td>{{$user->address == null ? "Nil" : $user->address}}</td>	
            <td>{{$user->district == null ? "Nil" : $user->district}}</td>	
            <td>{{$user->pincode == null ? "Nil" : $user->pincode}}</td>	
            <td>{{$user->date_of_birth == null ? "Nil" : $user->date_of_birth}}</td>	
            <td>{{$caste_category}}</td>	
            <td>{{$user->mobile == null ? "Nil" : $user->mobile}}</td>	
            <td>{{$user->whatsapp == null ? "Nil" : $user->whatsapp}}</td>	
            <td>{{$user->parent_name == null ? "Nil" : $user->parent_name}}</td>	
            <td>{{$user->parent_contact == null ? "Nil" : $user->parent_contact}}</td>	
            <td>{{$user->class_completed == null ? "Nil" : $user->class_completed }}</td>	
            <td> {{$user->last_studied == null ? "Nil" : $user->last_studied}}</td>	
            <td>{{$board}}</td>	
            <td>{{$user->annual_income == null ? "Nil" :"₹". $user->annual_income }}</td>	  
            
            <?php 
            // $categories = \Modules\Admin\Entities\Colleges::all();
            $categories = \Modules\Admin\Entities\CoursesCategory::all();
            $j=1;
            foreach ($categories as $categoriesKey => $CategoriesValue):?>
                <td>
                    <?php $AssignUserCategoryColleges = \Modules\Web\Entities\AssignUserCategoryCollegesCourses::where('user_id', $user->id)->where('courses_category_id', $CategoriesValue->id)->get();
                            if(isset($AssignUserCategoryColleges)): 
                            $k=1 ; foreach ($AssignUserCategoryColleges->unique('college_id') as $AssignUserCategoryCollegesKey => $AssignUserCategoryCollegesValue):
                                $Colleges =  \Modules\Admin\Entities\Colleges::where('id', $AssignUserCategoryCollegesValue->college_id)->first();
                        ?> 
                                <span>{{$Colleges->name}} - </span>
                                <div>&#123;
                                <?php $AssignUserCategoryCollegesCourses = \Modules\Web\Entities\AssignUserCategoryCollegesCourses::where('user_id', $user->id)->where('courses_category_id', $CategoriesValue->id)->where('college_id', $Colleges->id)->get();
                                if(isset($AssignUserCategoryCollegesCourses)): 
                                $l=1;  foreach ($AssignUserCategoryCollegesCourses as $AssignUserCategoryCollegesCoursesKey => $AssignUserCategoryCollegesCoursesValue):
                                $courses = \Modules\Admin\Entities\Courses::where('id', $AssignUserCategoryCollegesCoursesValue->course_id)->first();
                            ?>
                                <span> {{$courses->name}}, </span>
                                <?php $l++; endforeach; endif; ?>
                                &#125;</div>
                                    <!-- third loop else here -->        
                        <?php $k++; endforeach; endif;?>
                        <!-- second loop else here -->        
                </td>
            <?php $j++; endforeach; ?>
            </tr>     
        <?php  endforeach;  ?>
   </table> 
<?php endif; ?>
