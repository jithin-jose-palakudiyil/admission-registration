<div class="tab-pane" id="basictab5">
    <?php
    $category = collect([]); $courses_category_id=null;
    if(isset($explode) && isset($explode[0])): 
//        $category = \DB::table('pivot_assign_colleges')
//                    ->select('courses_category.*')
//                    ->join('courses_category','pivot_assign_colleges.courses_category_id','courses_category.id')
//                    ->where('college_id',$explode[0])->get();
     $category =     \DB::table('pivot_assign_category_colleges')
                            ->select('courses.*','courses_category.id as courses_category_id')
                            ->join('courses','pivot_assign_category_colleges.course_id','courses.id')
                            ->join('courses_category','pivot_assign_category_colleges.courses_category_id','courses_category.id')
                            ->where('pivot_assign_category_colleges.college_id',$explode[0])
                            ->where('courses_category.slug','polytechnic-diploma-lateral-entry-2-yrs-(after-plus-two-(pcm)-/-iti)')
                            ->get();
    $courses_category_id = $category->pluck('courses_category_id')->unique()->first();
    endif; 
    ?>
    <input type="hidden" name="courses_category_id" value="{{$courses_category_id}}"/>
           
    <div class="row"> 
        <div class="col-md-4">
            <div class="form-group">
                <label>Course  Preference 1 <span class="text-danger">*</span></label> 
                <select class="form-control" name="course_1" id="course_1">
                    <option value="">Select</option> 
                    <?php if($category->isNotEmpty()): 
                        foreach ($category as $key => $value):
                                ?>
                                <option value="{{$value->id}}">{{$value->name}}</option> 
                                <?php
                        endforeach;
                    endif; ?>
                </select> 
                <div id="course_1_error"></div>
            </div>
        </div>
        <?php if($category->count() >=2): ?> 
          <div class="col-md-4">
            <div class="form-group">
                <label>Course Preference 2</label> 
                <select class="form-control" name="course_2" id="course_2">
                    <option value="">Select</option> 
                    <?php if($category->isNotEmpty()): 
                        foreach ($category as $key => $value):
                                ?>
                                <option value="{{$value->id}}">{{$value->name}}</option> 
                                <?php
                        endforeach;
                    endif; ?> 
                </select> 
                <div id="course_2_error"></div>
            </div>
        </div>
        <?php endif; ?>
        <?php if($category->count() >=3): ?>
          <div class="col-md-4">
            <div class="form-group">
                <label>Course Preference 3</label> 
                <select class="form-control" name="course_3" id="course_3">
                    <option value="">Select</option> 
                    <?php if($category->isNotEmpty()): 
                        foreach ($category as $key => $value):
                                ?>
                                <option value="{{$value->id}}">{{$value->name}}</option> 
                                <?php
                        endforeach;
                    endif; ?> 
                </select> 
                <div id="course_3_error"></div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <hr/>
    
    <div class="row">
         <div class="col-12">
             <div class="text-center">
                <!--<h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>-->
                <h3 class="mt-0">Declaration</h3>

                <p class="w-75 mb-2 mx-auto">We, the applicant & parent / guardian do hereby declare that all the information furnished above are true and correct and we will obey the rules and regulations of the institution, if admitted.  Also we understand that the admission shall be, subject to satisfying the eligibility norms prescribed by the Statutory Authorities and the state Govt. from time to time.</p>

                <div class="mb-3">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="I_agree" name="I_agree" value="1">
                        <label class="custom-control-label" for="I_agree">I agree</label>
                        <div id="I_agree_error"></div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>