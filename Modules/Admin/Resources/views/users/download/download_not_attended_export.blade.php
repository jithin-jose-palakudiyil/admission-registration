 

<?php if(isset($users) && $users->isNotEmpty() ):   ?>
 
   <table border = 1> 
       <thead> 
           <tr>
                <th>Name </th>
                <th>Email </th>
                <th>Gender </th>
                <th>Address </th>
                <th>District </th>
                <th>Pin code </th>
                <th>Mobile number </th>
                <th>Whatsapp number </th>
                <th>Parent name </th>
                <th>parent contact number </th>
             
            </tr>
       </thead> 
     
        <?php  foreach ($users as $key => $user): ?>  
        <tr> 
            <td>{{$user->name == null ? "Nil" : $user->name}}</td>	
            <td>{{$user->email == null ? "Nil" : $user->email}}</td>	
            <td>{{$user->gender == null ? "Nil" : ($user->gender == "m" ? "Male" : "Female")}}</td>	
            <td>{{$user->address == null ? "Nil" : $user->address}}</td>	
            <td>{{$user->district == null ? "Nil" : $user->district}}</td>	
            <td>{{$user->pincode == null ? "Nil" : $user->pincode}}</td>
            <td>{{$user->mobile == null ? "Nil" : $user->mobile}}</td>	
            <td>{{$user->whatsapp == null ? "Nil" : $user->whatsapp}}</td>	
            <td>{{$user->parent_name == null ? "Nil" : $user->parent_name}}</td>	
            <td>{{$user->parent_contact == null ? "Nil" : $user->parent_contact}}</td>	
           
            </tr>     
        <?php  endforeach;  ?>
   </table> 
<?php endif; ?>
