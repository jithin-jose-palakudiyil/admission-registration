@extends('admin::layouts.master') 

@section('css')  

@stop

@section('content') 

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                 <form action="{{route('assign_category_college_update',$courses->id)}}" method="post" autocomplete="off">
                    {{ csrf_field() }}
                    
                        <?php
                        if(isset($CollegesWithCategory) && $CollegesWithCategory->isNotEmpty()):
                            foreach ($CollegesWithCategory as $key => $value) :
                            if($value->belongsToCategory->isNotEmpty()):
                                
                            ?>
                                <h5 class="card-title">{{$value->name}}</h5> 
                                <div class="row">   
                                <?php   
                                $belongsToCategory =   $value->belongsToCategory;  
                                foreach ($belongsToCategory as $key => $values) : 
                                    $CoursesCategory = Modules\Admin\Entities\CoursesCategory::where('id',$values->courses_category_id)->where('status',1)->first();
                                    if($CoursesCategory):
                                        $checked = null;
                                        $AssignCategoryCollege = Modules\Admin\Entities\AssignCategoryCollege::where('course_id',$courses->id)
                                            ->where('college_id',$value->id)
                                            ->where('courses_category_id',$CoursesCategory->id)
                                            ->first();
                                        if( isset($AssignCategoryCollege) && $AssignCategoryCollege): 
                                                $checked = 'checked=""';   
                                        endif;
                                        ?>
                                            <div class="col-md-6">
                                                <div class="checkbox checkbox-primary mb-2">
                                                    <input {{$checked}}  id="checkbox{{$CoursesCategory->id}}_{{$value->id}}" name="assign[]" type="checkbox" value="{{$value->id}}_{{$CoursesCategory->id}}">
                                                    <label for="checkbox{{$CoursesCategory->id}}_{{$value->id}}">
                                                        {{$CoursesCategory->name}}
                                                    </label>
                                                </div>
                                            </div>  
                                        <?php
                                    endif;
                                endforeach;
                                ?> 
                                </div>
                                <hr/>
                            <?php
                                endif;
                            endforeach;
                        endif;
                        ?>

                    
                        <div class="row"> 
                            <div class="col-md-12 ">    
                                <button class="btn btn-primary" style="float: right;margin-top: 15px" type="submit"> submit </button>
                            </div>
                         </div>
                     </form>
            </div>
        </div>
    </div>
 
@stop

@section('js')  

@stop
