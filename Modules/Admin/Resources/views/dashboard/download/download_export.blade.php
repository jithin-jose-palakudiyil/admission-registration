 

<?php if(isset($userExam) && $userExam ):   ?>
 
   <table> 
       <thead> 
           <tr>
                <th>Name </th>
                <th>Email </th>
                <th>Mobile </th>
                <th>Scholarship Exam Name </th>
                <th>Introduction Video Link </th>
                <th>Status </th>   
                <th>Attended Question &#38; Answer </th>   
            </tr>
       </thead> 
     
        <?php 
            foreach ($userExam as $userExamKey => $userExamValue): ?>  
        <tr> 
            <td>{{$userExamValue->getUser->name == null ? "Nil" : $userExamValue->getUser->name}}</td>	
            <td>{{$userExamValue->getUser->email == null ? "Nil" : $userExamValue->getUser->email}}</td>	
            <td>{{$userExamValue->getUser->mobile == null ? "Nil" : $userExamValue->getUser->mobile}}</td>	
            <td>{{$userExamValue->getQuiz->name == null ? "Nil" : $userExamValue->getQuiz->name}}</td>	
            <td>{{$userExamValue->getQuiz->video_id == null ? "Nil" : $userExamValue->getQuiz->video_id}}</td>	
            <td>
                <?php                   
                $status = "nil";
                if($userExamValue->quiz_status !=null):
                    if( ($userExamValue->quiz_status == 0 || $userExamValue->quiz_status == 2)):
                        echo 'In Progress';
                    else:
                        echo 'Completed';
                    endif;
                else:
                    echo "Nil";
                endif;
                ?>
            </td>	

            <td>		     
                <?php
                $PivotExamQA = \Modules\Admin\Entities\PivotExamQA::with('getQuestion')->with('getAnswer')->where('exam_id', $userExamValue->id)->get();
                if(isset($PivotExamQA) && count($PivotExamQA) > 0):?>
                <?php $i=1 ; foreach($PivotExamQA as $PivotExamQAkey => $PivotExamQAValue):
                        if(isset($PivotExamQAValue) && isset($PivotExamQAValue->quiz_question_id)):
                        ?>
                        <div>
                        &#123; <p style="display: inline-block;"> {{$PivotExamQAValue->getQuestion->question_youtube_id}}=>
                            <?php 
                                if($PivotExamQAValue->quiz_answer_id == null || $PivotExamQAValue->answered==0):
                            ?>
                               Not Answered

                            <?php else:?>
                             Given Answer: {{$PivotExamQAValue->getAnswer->answer}}
                            <?php endif;?>
                            </p>&#125;
               
                            </div>,
                    <?php $i++; endif; endforeach;?> 
                <?php else: echo "Nil" ; endif;?>
            </td>
            
    </tr> 
<?php  endforeach;  ?>  
   </table> 
<?php endif; ?>
