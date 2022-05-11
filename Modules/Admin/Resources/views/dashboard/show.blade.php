@extends('admin::layouts.master') 
 
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
 
 
<?php if(isset($userExam)):   ?>
 <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                        <h3>Scholarship Exam Details</h3>
                        <hr/>
                        <div class="display-a">
                            <div style="margin-top: 20px" class="row">
                                <div class="col-sm-4">
                                    <h5>Name</h5>
                                    {{$userExam->getUser->name == null ? "Nil" : $userExam->getUser->name}}
                                </div>

                                <div class="col-sm-4">
                                    <h5>Email</h5>
                                    {{$userExam->getUser->email == null ? "Nil" : $userExam->getUser->email}}
                                </div>

                                <div class="col-sm-4">
                                    <h5>Mobile</h5>
                                    {{$userExam->getUser->mobile == null ? "Nil" : $userExam->getUser->mobile}}
                                </div>
                            </div>


                            <div style="margin-top: 20px" class="row">
             
                                <div class="col-sm-4">
                                    <h5>Scholarship Exam Name</h5>
                                    {{$userExam->getQuiz->name == null ? "Nil" : $userExam->getQuiz->name}}
                                </div>
                                

                                <div class="col-sm-4">
                                    <h5>Introduction Video Link</h5>
                                    <a style="text-decoration: underline" href="https://www.youtube.com/watch?v={{$userExam->getQuiz->video_id}}" target="_blank" rel="noopener noreferrer">{{$userExam->getQuiz->video_id == null ? "Nil" : $userExam->getQuiz->video_id}}</a>
                                </div>

                                <div class="col-sm-4 align-center">
                                    <h5>Status</h5>
                                    <?php 
                                    
                                    if(isset($userExam->quiz_status)):
                                        if($userExam->quiz_status == 0 || $userExam->quiz_status == 2):
                                            echo '<p style="color: red">In Progress</p>';
                                        else:
                                            echo '<p style="color: #1dbd57">Completed</p>';
                                        endif;
                                    else:
                                        echo "Nil";
                                    endif;
                                    ?>
                                </div>

                            </div>


            
                        </div>  

                        <div class="table-responsive display-b">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                    <th style="text-transform: capitalize;" scope="row">Name</th>
                                    <td>{{$userExam->getUser->name == null ? "Nil" : $userExam->getUser->name}}</td>
                                    </tr>
                                    <tr>
                                    <th style="text-transform: capitalize;" scope="row">Email</th>
                                    <td>{{$userExam->getUser->email == null ? "Nil" : $userExam->getUser->email}}</td>
                                    </tr>
                                    <tr>
                                    <th style="text-transform: capitalize;" scope="row">Mobile</th>
                                    <td> {{$userExam->getUser->mobile == null ? "Nil" : $userExam->getUser->mobile}} </td>
                                    </tr>
                                    <tr>
                                    <th style="text-transform: capitalize;" scope="row">Scholarship Exam Name</th>
                                    <td>{{$userExam->getQuiz->name == null ? "Nil" : $userExam->getQuiz->name}}</td>
                                    </tr>
                                    <th style="text-transform: capitalize;" scope="row">Introduction Video Link</th>
                                    <td><a style="text-decoration: underline" href="https://www.youtube.com/watch?v={{$userExam->getQuiz->video_id}}" target="_blank" rel="noopener noreferrer">{{$userExam->getQuiz->video_id == null ? "Nil" : $userExam->getQuiz->video_id}}</a></td>
                                    </tr>
                                    <th style="text-transform: capitalize;" scope="row">Status</th>
                                    <td>
                                        <?php 
                                        // quiz_status
                                        if(isset($userExam->quiz_status)):
                                            if($userExam->quiz_status == 0 || $userExam->quiz_status == 2):
                                                echo '<p style="color: red">In Progress</p>';
                                            else:
                                                echo '<p style="color: #1dbd57">Completed</p>';
                                            endif;
                                        else:
                                            echo "Nil";
                                        endif;

                                        ?>
                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->

    </div>
<!-- end row-->

<?php
$PivotExamQA = \Modules\Admin\Entities\PivotExamQA::with('getQuestion')->with('getAnswer')->where('exam_id', $userExam->id)->get();
if(isset($PivotExamQA) && count($PivotExamQA) > 0):?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3>Attended Questions & Answers</h3>
                    <hr/>
                    <?php $i=1 ; foreach($PivotExamQA as $PivotExamQAkey => $PivotExamQAValue):
                        if(isset($PivotExamQAValue) && isset($PivotExamQAValue->quiz_question_id)):
                        ?>
                        <div style="margin-bottom: 20px; ">
                            <a href="https://www.youtube.com/watch?v={{$PivotExamQAValue->getQuestion->question_youtube_id}}" target="_blank" rel="noopener noreferrer"><h4 class="" style="margin-right: 5px; margin-left: 5px; text-align:left; text-decoration: underline"> <i class="la la-youtube"></i> {{$PivotExamQAValue->getQuestion->question_youtube_id}}</h4></a>
                            <?php if(isset($PivotExamQAValue->getQuestion) && $PivotExamQAValue->getQuestion->question):?>
                                <p style="margin-left: 5px; font-size: 13px"><span style="font-weight: 600">Q: {{$PivotExamQAkey + 1}}.  </span>{{$PivotExamQAValue->getQuestion->question}}</p>
                            <?php endif;?>
                            <?php 
                                if($PivotExamQAValue->quiz_answer_id == null || $PivotExamQAValue->answered==0):
                            ?>
                                <p style="margin-left: 30px; font-size: 13px; color: red">Not Answered</p>

                            <?php else:?>
                                <p style="margin-left: 30px; font-size: 13px"><span style="color: #1dbd57">Given Answer : </span>{{$PivotExamQAValue->getAnswer->answer}}</p>
                            <?php endif;?>
                        </div>
                    <?php $i++; endif; endforeach;?>        
            </div>
        </div>
    </div>
<?php endif; ?>


    <?php else: ?>
    <p>Sorry ! But there is no information available.</P>
    <?php endif; ?>
                          
@stop


