 

<?php if(isset($users) && $users ):   ?>
 
   <table border = 1> 
       <thead> 
           <tr>
                <th>Name </th>
                <th>Address </th>
                <th>Ph.No </th>
                <th>WhatsApp No.  </th>
                <th>Email id </th>
                <th>Total Marks </th>
                <th>PCM% </th>
                <th>Created date </th> 
            </tr>
       </thead> 
     
        <?php 
            foreach ($users as $key => $user): 
               
      ?>  
        <tr> 
            <td>{{$user->name == null ? "Nil" : $user->name}}</td>
            <td>{{$user->address == null ? "Nil" : $user->address}}</td> 
            <td>{{$user->mobile == null ? "Nil" : $user->mobile}}</td>	
            <td>{{$user->whatsapp == null ? "Nil" : $user->whatsapp}}</td>
            <td>{{$user->email == null ? "Nil" : $user->email}}</td>	
            <td>{{$user->plus_two_marks == null ? "Nil" : $user->plus_two_marks}}</td>	
            <td>{{$user->pcm == null ? "Nil" : $user->pcm}}</td>	
            <td>{{$user->created_at == null ? "Nil" : $user->created_at}}</td>	
        </tr>     
        <?php  endforeach;  ?>
   </table> 
<?php endif; ?>
