<?php
$disabled =null; 
if( (isset($quiz['open_or_close']) && $quiz['open_or_close'] ==2)) : 
    $disabled='disabled=""';
endif;
?>
  @if(count($errors) > 0 )
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <ul class="p-0 m-0" style="list-style: none;">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card-box"> 
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group ">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" {{$disabled}}  id="name" name="name"  placeholder="Enter Name" value="{{$quiz['name']? $quiz['name']:old('name')}}" >
                    @if($errors->has('name'))
                        <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('name') }}</div>
                    @endif
                </div> 
            </div>
            <div class="col-md-4">
                <div class="form-group ">
                    <label for="button_text">Button Text <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" {{$disabled}} id="button_text" name="button_text"  placeholder="Enter Button Text" value="{{$quiz['button_text']? $quiz['button_text']:old('button_text')}}" >
                    @if($errors->has('button_text'))
                        <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('button_text') }}</div>
                    @endif
                </div> 
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Status: <span class="text-danger">*</span></label>
                    <select name="status"{{$disabled}}  class="form-control" data-toggle="select2" data-placeholder="status">
                     <option value="" > select </option> 
                        <option value="1"  @if(isset($quiz['status']) && $quiz['status']==1) selected @endif >Approved</option>
                        <option value="0" @if(isset($quiz['status']) && $quiz['status']==0) selected @endif>Unapproved</option> 
                    </select>
                    <div id="status_err">
                        @if($errors->has('status'))
                            <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('status') }}</div>
                        @endif
                    </div>
                </div>
            </div> 
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group ">
                    <label for="name">Introduction youtube video Id <span class="text-danger">*</span></label>
                    <input type="text" {{$disabled}} class="form-control" id="video_id" name="video_id"  placeholder="Enter video Id " value="{{$quiz['video_id']? $quiz['video_id']:old('video_id')}}" >
                    @if($errors->has('video_id'))
                        <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('video_id') }}</div>
                    @endif
                </div> 
            </div> 
            <div class="col-md-4">
                <div class="form-group">
                    <label>Button Show Status: <span class="text-danger">*</span></label>
                    <select name="btn_show_status" {{$disabled}} id="btn_show_status" class="form-control" data-toggle="select2" data-placeholder="Button Show Status">
                     <option value="" > select </option> 
                        <option value="fixed"  @if(isset($quiz['btn_show_status']) && $quiz['btn_show_status']=='fixed') selected @endif >Fixed</option>
                        <option value="timer" @if(isset($quiz['btn_show_status']) && $quiz['btn_show_status']=='timer') selected @endif>Timer</option> 
                    </select>
                    <div id="btn_show_status_err">
                        @if($errors->has('btn_show_status'))
                            <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('btn_show_status') }}</div>
                        @endif
                    </div>
                </div>
            </div> 
            <div class="col-md-4 time_of_btn_cls" @if(isset($quiz['btn_show_status']) && $quiz['btn_show_status']=='timer')  @elseif(!$errors->has('time_of_btn')) style="display: none" @endif>
                <div class="form-group ">
                    <label for="slug">Time for show Button (Min)<span class="text-danger">*</span></label>
                    <input type="text" {{$disabled}} class="form-control" id="time_of_btn" name="time_of_btn"  placeholder="Enter Time for show Button" value="{{$quiz['time_of_btn']? $quiz['time_of_btn']:old('time_of_btn')}}" >
                    @if($errors->has('time_of_btn'))
                        <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('time_of_btn') }}</div>
                    @endif
                </div> 
            </div>

            <div class="col-md-4"> 
                <div class="form-group mb-3">
                    <label for="image">Image </label>
                    <input type="file" {{$disabled}} name='image'  id="image" class="form-control-file">
                    @if($errors->has('image'))
                        <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('image') }}</div>
                    @endif
                </div> 
                <?php 
                if($quiz!=null && $quiz->image!=null):
                $path = 'public/uploads/quiz_image/'.$quiz->image; 
                if(File::exists($path)): 
                    $image = $path;    
                ?>
                <img  src="{{asset($image)}}" alt="user-image" style="background-color: #969696;width: 60px; margin-bottom: 20px" class="rounded-circle">
                    <?php endif;endif;
                ?>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Review quiz: </label>
                    <select name="review_quiz" {{$disabled}} class="form-control" data-toggle="select2" data-placeholder="review_quiz">
                     <option value="" > select </option> 
                        <option value="1"  @if(isset($quiz['review_quiz']) && $quiz['review_quiz']==1) selected @endif >Yes</option>
                        <option value="0" @if(isset($quiz['review_quiz']) && $quiz['review_quiz']==0) selected @endif>No</option> 
                    </select>
                    <div id="review_quiz_err">
                        @if($errors->has('review_quiz'))
                            <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('review_quiz') }}</div>
                        @endif
                    </div>
                </div>
            </div> 

            <div class="col-md-4"> 
                <div class="form-group mb-3">
                    <label for="exam_completed_image">Exam completed image <span class="text-danger"><?php echo (isset($quiz) && $quiz->exam_completed_image == null) ? '*' : ''  ?></span></label>
                    <input type="file" {{$disabled}} name='exam_completed_image'  id="exam_completed_image" class="form-control-file">
                    @if($errors->has('exam_completed_image'))
                        <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('exam_completed_image') }}</div>
                    @endif
                </div> 
                <?php 
                if($quiz!=null && $quiz->exam_completed_image!=null):
                $path = 'public/uploads/quiz_image/'.$quiz->exam_completed_image; 
                if(File::exists($path)): 
                    $image = $path;    
                ?>
                <img  src="{{asset($image)}}" alt="user-image" style="background-color: #969696;width: 60px; margin-bottom: 20px" class="rounded-circle">
                    <?php endif;endif;
                ?>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Exam type: <span class="text-danger">*</span></label>
                    <select name="exam_type" {{$disabled}} id="exam_type" class="form-control" data-toggle="select2" data-placeholder="exam type">
                     <option value="" > select </option> 
                        <option value="fresh"  @if(isset($quiz['exam_type']) && $quiz['exam_type']=='fresh') selected @endif >Fresh</option>
                        <option value="re_exam_for_previous" @if(isset($quiz['exam_type']) && $quiz['exam_type']=='re_exam_for_previous') selected @endif>Re-exam for previous exams</option> 
                    </select>
                    <div id="exam_type_err">
                        @if($errors->has('exam_type'))
                            <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('exam_type') }}</div>
                        @endif
                    </div>
                </div>
            </div> 
        </div>
        <div class="row" id="appendDiv"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group ">
                    <label for="description">Description <span class="text-danger">*</span></label>
                    <textarea style="resize: none" {{$disabled}} type="text" class="form-control" id="description" name="description"  placeholder="Enter description "  >{{$quiz['description']? $quiz['description']:old('description')}}</textarea>
                    @if($errors->has('description'))
                        <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('description') }}</div>
                    @endif
                </div> 
            </div>
        </div>    

        <div class="row">
            <div class="col-md-12">
                <div class="form-group ">
                    <label for="exam_completed_description">Exam completed description <span class="text-danger">*</span></label>
                    <textarea style="resize: none" type="text" {{$disabled}} class="form-control" id="exam_completed_description" name="exam_completed_description"  placeholder="Description when exam ends "  >{{$quiz['exam_completed_description']? $quiz['exam_completed_description']:old('exam_completed_description')}}</textarea>
                    @if($errors->has('exam_completed_description'))
                        <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('exam_completed_description') }}</div>
                    @endif
                </div> 
            </div>
        </div>    
        <?php if( (isset($quiz['open_or_close']) && $quiz['open_or_close'] !=2) || !isset($quiz['open_or_close']) ) : ?>
        <div class="row">  
            <div class="col-md-12 ">
                <button type="submit" class="btn btn-primary pull-right" style="margin-left: 10px">Submit</button> 
            </div>
        </div>
        <?php endif; ?>

    </div>
</div> 
@section('js')
    <link href="{{asset('public/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('public/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('public/assets/libs/validation/validate.min.js')}}" type="text/javascript"></script>
   
        <?php if(isset($quiz->exam_type)):  ?>
        <script>
            
        $(function() 
        { 
            window.edits = true;
            window.exam_type_id ={{$quiz->id}};
            GetExams('<?php echo $quiz->exam_type;  ?>','<?php echo $quiz->id;  ?>');
        }); 
      </script>
        <?php endif;  ?>
      
    <script src="{{asset('Modules/Admin/Resources/assets/page_js/quiz.js')}}"></script> 
    
    <?php if(isset($quiz) && $quiz["exam_completed_image"] != null):  ?>
            <script>
                $( document ).ready(function() {
                    $('#exam_completed_image').rules('remove');
                });
            </script>
        <?php endif;?>


@stop
