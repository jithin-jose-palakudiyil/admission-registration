<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MGM - Scholarship Exam</title>
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

<?php if(isset($userExam)):?>

    <table style="margin-top: 25px; margin-bottom: 35px" width=100%>
      <tr>
        <td align="center">
            <h4 class="auth-title">Scholarship Exam Details {{$userExam->getQuiz->name == null ? null : " - ".$userExam->getQuiz->name}}</h4>
        </td>
      </tr>
  </table>


  <table width=100% class="table table-borderless">
  <tbody>
  
  
  <tr>
      <td style="font-weight: bold; font-size: 15px">Name</td>
      <td style="font-weight: bold; font-size: 15px">Email</td>
      <td style="font-weight: bold; font-size: 15px">Mobile</td>
    </tr>


    <tr>
      <td style="font-size: 15px">{{$userExam->getUser->name == null ? "Nil" : $userExam->getUser->name}}</td>
      <td style="font-size: 15px">{{$userExam->getUser->email == null ? "Nil" : $userExam->getUser->email}}</td>
      <td style="font-size: 15px">{{$userExam->getUser->mobile == null ? "Nil" : $userExam->getUser->mobile}}</td>
    </tr>


    <tr>
        <td style="font-weight: bold; font-size: 15px">Scholarship Exam Name</td>
        <td style="font-weight: bold; font-size: 15px">Introduction Video Link</td>
        <td style="font-weight: bold; font-size: 15px">Status</td>
    </tr>


    <tr>
        <td style="font-size: 15px">{{$userExam->getQuiz->name == null ? "Nil" : $userExam->getQuiz->name}}</td>
        <td style="font-size: 15px">
            <a style="text-decoration: underline" href="https://www.youtube.com/watch?v={{$userExam->getQuiz->video_id}}" 
            target="_blank" rel="noopener noreferrer">{{$userExam->getQuiz->video_id == null ? "Nil" : $userExam->getQuiz->video_id}}
            </a>
        </td>
        <td style="font-size: 15px">
        <?php 
                                        
            $status = "nil";
            if(isset($userExam->quiz_status)):
                if( ($userExam->quiz_status == 0 || $userExam->quiz_status == 2)):
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


<?php
$PivotExamQA = \Modules\Admin\Entities\PivotExamQA::with('getQuestion')->with('getAnswer')->where('exam_id', $userExam->id)->get();
if(isset($PivotExamQA) && count($PivotExamQA) > 0):?>
    <table style="margin-top: 25px; margin-bottom: 35px" width=100%>
      <tr>
        <td align="center">
            <h4 class="auth-title">Attended Questions & Answers</h4>
        </td>
      </tr>
      </table>                    

<table width=100% class="table table-borderless">

<thead>
    <tr>
      <td style="font-weight: bold; font-size: 15px">SI. No</td>
      <td style="font-weight: bold; font-size: 15px">Questions ( Youtube link ) </td>
      <td style="font-weight: bold; font-size: 15px">Answers</td>
    </tr>
  </thead>


    <?php $i=1 ; foreach($PivotExamQA as $PivotExamQAkey => $PivotExamQAValue):
                            if(isset($PivotExamQAValue) && isset($PivotExamQAValue->quiz_question_id)):
                            ?>
                            <tr>
                                <td style="font-size: 15px">{{$PivotExamQAkey + 1}}</td>
                                <td style=" font-size: 15px">
                                 <a style="text-decoration: underline" href="https://www.youtube.com/watch?v={{$PivotExamQAValue->getQuestion->question_youtube_id}}" target="_blank" rel="noopener noreferrer">{{$PivotExamQAValue->getQuestion->question_youtube_id}}</a>
                                </td>
                                
                                    <?php 
                                    if($PivotExamQAValue->quiz_answer_id == null || $PivotExamQAValue->answered==0):
                                    ?>
                                        <td style="font-size: 15px; color: red">Not Answered</td>
                                    <?php else:?>
                                        <td><p style="font-size: 15px"><span style="font-weight: bold;">Given Answer : </span>{{$PivotExamQAValue->getAnswer->answer}}</p></td>
                                    <?php endif; ?>

                            </tr>


        <?php $i++; endif; endforeach;?> 
</table>  
<?php endif;?>

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
