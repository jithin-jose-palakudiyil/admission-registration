 

<?php if(isset($applications) && $applications ):  ?>
 
   <table> 
       <thead> 
           <tr>
                <th>Name </th>
                <th>Place </th>
                <th>Mobile </th> 
                <th>Email </th> 
                <th>Total% </th>
                <th>PCM% </th>
                <th>Created date </th>   
                 
            </tr>
       </thead> 
     
        <?php 
            foreach ($applications as $Key => $Value): ?>  
        <tr> 
            <td>{{(isset($Value->name) && $Value->name == null) ? "Nil" : $Value->name}}</td>
            <td>{{(isset($Value->place) && $Value->place == null) ? "Nil" : $Value->place}}</td>
            <td>{{(isset($Value->mobile) && $Value->mobile == null) ? "Nil" : $Value->mobile}}</td>
            <td>{{(isset($Value->email) && $Value->email == null) ? "Nil" : $Value->email}}</td>
            <td>{{(isset($Value->total_percentage) && $Value->total_percentage == null) ? "Nil" : $Value->total_percentage}}</td>
            <td>{{(isset($Value->pcm_percentage) && $Value->pcm_percentage == null) ? "Nil" : $Value->pcm_percentage}}</td>
            <td>{{(isset($Value->created_at) && $Value->created_at == null) ? "Nil" : Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $Value->created_at)->format('d-m-Y H:i:s')}}</td>
            
            
            
            
    </tr> 
<?php  endforeach;  ?>  
   </table> 
<?php endif; ?>
