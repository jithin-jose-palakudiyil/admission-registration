 

<?php if(isset($userExam) && $userExam ):   ?>
 
   <table> 
       <thead> 
           <tr>
                <th>ID </th>
                <th>Name </th>
                <th>Email </th>
                <th>Mobile </th>
                <th>Total questions </th>
                <th>Score </th>
                
                 
            </tr>
       </thead> 
     
        <?php 
            foreach ($userExam as $userExamKey => $userExamValue): 
             
        ?>  
        <tr> 
            <td> <?php if(isset($userExamValue->id)): echo $userExamValue->id; else: echo 'Nil'; endif;?> </td>
            <td>{{$userExamValue->getUser->name == null ? "Nil" : $userExamValue->getUser->name}}</td>	
            <td>{{$userExamValue->getUser->email == null ? "Nil" : $userExamValue->getUser->email}}</td>	
            <td>{{$userExamValue->getUser->mobile == null ? "Nil" : $userExamValue->getUser->mobile}}</td>	
            <td>{{$userExamValue->total_questions == null ? "Nil" : $userExamValue->total_questions}}</td>	
            <td>{{$userExamValue->total_true_answer == null ? "0" : $userExamValue->total_true_answer}}</td>	
              	
            
            
        </tr> 
<?php  endforeach;  ?>  
   </table> 
<?php endif; ?>
