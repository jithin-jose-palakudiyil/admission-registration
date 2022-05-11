var url_prefix ='users';
$(function() 
{  
    
    
    
/* ************************************************************************** */  
/* *************************** initialization ******************************* */  
/* ************************************************************************** */ 

    if($('#users-datatable').length)
    {   
        
        var url=$('#users-datatable').attr('data-url');
//        var document=$('#users-datatable').attr('data-document');
//         var not_attend_any_exams=$('#users-datatable').attr('data-not_attend_any_exams');
        var college=$('#users-datatable').attr('data-college');
          
        $('#users-datatable').DataTable
        ({
      
            processing: true,
            serverSide: true, 
//            ajax: url,
             "ajax": {
                "url": url,
//                "data": { 'document': document,'not_attend_any_exams':not_attend_any_exams }
                "data": { 'college': college}
              },
            columns: [ 
                        {
                            data: "name", sortable: false,
                            render: function (data, type, full) {  return  full.name; } 
                        },  
                        
                        {
                            data: "email", sortable: false,
                            render: function (data, type, full) {  return  full.email; } 
                        },  

                        {
                            data: "mobile", sortable: false,
                            render: function (data, type, full) {  return  full.mobile; } 
                        },
                        {
                            data: "null","searchable": false, sortable: false,
                            render: function (data, type, full)
                            {   
                                var delete_button ='onclick="return Delete('+full.id+')"';
                                var show_url=base_url+'/'+admin_prefix+'/'+url_prefix+'/'+full.id+'/show';
                                var  u = '<div class="btn-group" role="group" aria-label="Basic example">'+
                                        '<a class="text-center" href="'+show_url+'"><button type="button" class="btn btn-sm btn-light waves-effect"><i class="mdi mdi-eye font-18"></i></button></a> &nbsp;'+
                                        '<button type="button" '+delete_button+' class="btn btn-sm btn-light waves-effect"><i class="mdi mdi-archive font-18"></i></button>&nbsp;'+
                                        '</div>';                     

                                
                                return u;
                            } 
                        }
            ] 
        }); 
//        
    }
    


     
});


function Delete(id)
    {  
         
     
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ml-2 mt-2",
                buttonsStyling: !1
            }).then(function(t) 
            { 
                if(t.value == true)
                { 
                    var url=base_url+'/'+admin_prefix+'/'+url_prefix+'/'+id;  
                    $.ajax
                    ({
                       type: 'DELETE',
                        url: url,
                        dataType: "json",
                        async: false,
                        headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data :{'application':id},
                        success: function(response){  window.location.reload(); },
                        error: function (request, textStatus, errorThrown)  {  }
                    }); 
                    
                } 
            })
         
                        
         
}
