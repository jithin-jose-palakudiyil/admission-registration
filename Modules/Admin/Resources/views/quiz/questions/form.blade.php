@extends('admin::layouts.master')   
@section('content')  
<?php
    $route = null;
    $method = null;
    if($type == 'edit'):
        $route = route('quiz-questions.update', [$quiz_question->id]);
    else:
        $route = route('quiz-questions.store');
    endif;
?>

<form action="{{$route}}" method="post" class='steps-validation' id='quiz_questions_form' enctype='multipart/form-data'> 
@csrf
<div class="card-box"> 
    <div class="panel-body">
        <input type="hidden" value="{{$quiz->id}}" name="quiz"/>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group ">
                    <label for="question_youtube_id">Question YouTube Id  <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="question_youtube_id" name="question_youtube_id"  placeholder="Enter Question YouTube Id" value="{{$quiz_question['question_youtube_id']? $quiz_question['question_youtube_id']:old('question_youtube_id')}}" >
                    @if($errors->has('question_youtube_id'))
                        <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('question_youtube_id') }}</div>
                    @endif
                </div> 
            </div> 
            <div class="col-md-4">
                <div class="form-group">
                    <label>Status: <span class="text-danger">*</span></label>
                    <select name="status" class="form-control" data-toggle="select2" data-placeholder="status">
                     <option value="" > select </option> 
                        <option value="1"  @if(isset($quiz_question['status']) && $quiz_question['status']==1) selected @endif >Approved</option>
                        <option value="0" @if(isset($quiz_question['status']) && $quiz_question['status']==0) selected @endif>Unapproved</option> 
                    </select>
                    <div id="status_err">
                        @if($errors->has('status'))
                            <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('status') }}</div>
                        @endif
                    </div>
                </div>
            </div> 
 
             
            <div class="col-md-4">
                <div class="form-group">
                    <label>Question time <span class="text-danger">*</span></label>
                    <select name="answers_show_status" id="answers_show_status" class="form-control" data-toggle="select2" data-placeholder="Answers Show Status">
                     <option value="" > select </option> 
                        <option value="fixed"  @if(isset($quiz_question['answers_show_status']) && $quiz_question['answers_show_status']=='fixed') selected @endif >Fixed</option>
                        <option value="timer" @if(isset($quiz_question['answers_show_status']) && $quiz_question['answers_show_status']=='timer') selected @endif>Timer</option> 
                    </select>
                    <div id="answers_show_status_err">
                        @if($errors->has('answers_show_status'))
                            <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('answers_show_status') }}</div>
                        @endif
                    </div>
                </div>
            </div> 
            <div class="col-md-4 time_of_answers_cls" @if(isset($quiz_question['answers_show_status']) && $quiz_question['answers_show_status']=='timer')  @elseif(!$errors->has('time_of_answers')) style="display: none" @endif>
                <div class="form-group ">
                    <label for="slug">Time to answer (Min)<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="time_of_answers" name="time_of_answers"  placeholder="Enter time for show answers" value="{{$quiz_question['time_of_answers']? $quiz_question['time_of_answers']:old('time_of_answers')}}" >
                    @if($errors->has('time_of_answers'))
                        <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('time_of_answers') }}</div>
                    @endif
                </div> 
            </div>

            <div class="col-md-8">
                <div class="form-group ">
                    <label for="question">Question <span class="text-danger">*</span></label>
                    <textarea type="text" class="form-control" id="question" name="question"  placeholder="Enter question">{{$quiz_question['question']? $quiz_question['question']:old('question')}}</textarea>
                    @if($errors->has('question'))
                        <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('question') }}</div>
                    @endif
                </div> 
            </div> 
            
        </div> 
    </div>
</div> 
<div class="row">  
            <div class="col-md-12 ">
                <button style="margin-bottom: 20px" type="submit" class="btn btn-primary pull-right" style="margin-left: 10px">Submit</button> 
            </div>
        </div>
</form>
<?php if($type == 'edit'):?>
    <form action="{{route('quiz-answers.store-update',[$quiz_question->id])}}" method="post" class='steps-validation' id='quiz_questions_form' enctype='multipart/form-data'> 
        @csrf
    <input type="hidden" id="question_id" name="question_id" value="{{$quiz_question->id}}" />
<div class="card-box"> 
    <div class="panel-body">
        <h4 class="header-title mb-0">Question Answers</h4>
        <div id="correct_ans_error"></div>
        
        @error('answers.*')
            <div class="invalid-feedback" style="display: inline-block;">{{ $message }}</div>
        @endif
        <button type="button" class="btn btn-info waves-effect waves-light add_btn" style="float: right"s>
            <i class="mdi mdi-plus"></i>
        </button>           
        <br/> 
        
        <?php $answers = (isset($quiz_question->hasManyAnswers) && $quiz_question->hasManyAnswers->isNotEmpty() ) ? $quiz_question->hasManyAnswers : []; 
        if(!empty($answers)): 
            $i=1;
        ?><div class="main_row" ><?php
            foreach ($answers as $key => $value):
               ?>
        
            <table style="width: 100%" class="table_row" id="table_row_{{$i}}">
                <tr>
                    <td align="center" width="35px">
                        <div class="number_answers">{{$i}}</div>
                    </td>
                    <td style="width: 70%">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label for="answers">Answer <span class="text-danger">*</span></label>
                                <input type="text" class="form-control answers"  name="answers[{{$i}}]"  placeholder="Enter answer" value="{{$value->answer}}" >
                           </div> 
                        </div>
                     </td>
                     <td>
                         <div class="col-md-12">
                            <div class="form-group "> 
                                <div class="radio radio-success mb-2">
                                    
                                    <?php $is_answer_checked = null; if($value->is_answer==1):
                                        $is_answer_checked ='checked=""';
                                    endif; ?>
                                    <input type="radio" name="correct_ans" {{$is_answer_checked}}  id="correct_ans_{{$i}}" value="0" class="correct_ans">
                                    <label class="correct_ans_label" for="correct_ans_{{$i}}">
                                        Is answer
                                    </label>
                                </div>  
                           </div> 
                        </div>
                           

                     </td>
                     <td align="left">
                        
                       <div class="col-md-12">
                            <div class="form-group " style="margin-top:  26px; display: flex; flex-direction: row"> 
                                <button onclick="saveAnswer(event, {{$value->id}}, {{$i}})" type="button" class="btn btn-success waves-effect waves-light save_btn"  style="margin-right: 4px!important"  data-row='{{$i}}'>Save</button> 
                                <button onclick="deleteAnswer(event, {{$value->id}})" type="button" class="btn btn-danger waves-effect waves-light remove_btn" @if($i==1) style='display:none' @endif data-row='{{$i}}'><i class="mdi mdi-close"></i></button> 
                           </div> 
                        </div>   
                    </td>

                </tr>      
            </table> 
       
       <?php $i++; endforeach; ?> 
       </div>
        <?php  else: ?> 
        <div class="main_row" >
            <table style="width: 100%" class="table_row" id="table_row_1">
                  <tr>
                            <td align="center" width="35px">
                                <div class="number_answers">1</div>
                            </td>
                            <td style="width: 70%">
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="answers">Answer <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control answers"  name="answers[1]"  placeholder="Enter answer" value="" >
                                   </div> 
                                </div> 
                             </td>
                             <td>
                         <div class="col-md-12">
                            <div class="form-group "> 
                                <div class="radio radio-success mb-2">
                                    <input type="radio" name="correct_ans" id="correct_ans_1" value="0" class="correct_ans">
                                    <label class="correct_ans_label" for="correct_ans_1">
                                        Is answer
                                    </label>
                                </div>  
                           </div> 
                        </div>
                           

                     </td>
                             <td align="left">
                                
                               <div class="col-md-12">
                                    <div class="form-group " style="margin-top:  26px; display: flex; flex-direction: row"> 
                                        <button onclick="saveAnswer(event, null, 1)" type="submit" class="btn btn-success waves-effect waves-light save_btn"  style='display:inline-block;margin-right: 4px!important' data-row='1'>Save</button> 
                                        <button onclick="deleteAnswer(event, null)" type="button" class="btn btn-danger waves-effect waves-light remove_btn" style="display: none" data-row='1'><i class="mdi mdi-close"></i></button> 
                                   </div> 
                                </div>   
                            </td>
                            
                        </tr>
                        
            </table>
 
            
         
       </div>
        <?php endif; ?>
        
    </div>
</div> 
    </form>
<?php endif; ?>

@stop

@section('css')  
        <!-- third party css -->
    <link href="{{asset('public/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
 @stop       

@section('js')
    <script src="{{asset('public/assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('public/assets/libs/validation/validate.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('Modules/Admin/Resources/assets/page_js/quiz_questions.js')}}"></script> 
@stop


