@extends('admin::layouts.master') 

@section('css')  

@stop

@section('content') 

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                 <form action="{{route('assign_category_update',$colleges->id)}}" method="post" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="row">
                        <?php
                        if(isset($CoursesCategory) && $CoursesCategory->isNotEmpty()):
                            foreach ($CoursesCategory as $key => $value) :
                            $checked = null;
                            if(isset($AssignColleges) && !empty($AssignColleges)): 
                                if (in_array($value->id, $AssignColleges)) :
                                    $checked = 'checked=""';   
                                endif; 
                            endif;
                            ?>
                            <div class="col-md-6">
                                <div class="checkbox checkbox-primary mb-2">
                                    <input {{$checked}}  id="checkbox{{$value->id}}" name="assign[]" type="checkbox" value="{{$value->id}}">
                                    <label for="checkbox{{$value->id}}">
                                        {{$value->name}}
                                    </label>
                                </div>
                            </div>
                            <?php
                            endforeach;
                        endif;
                        ?>

                    </div>
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
