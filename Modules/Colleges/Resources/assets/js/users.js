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
          
        $('#users-datatable').DataTable
        ({
      
            processing: true,
            serverSide: true, 
            ajax: url,
//             "ajax": {
//                "url": url,
//                "data": { 'document': document,'not_attend_any_exams':not_attend_any_exams }
//              },
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
                               
                                var show_url=base_url+'/'+colleges_prefix+'/'+url_prefix+'/'+full.id+'/show';
                                var  u = '<div class="btn-group" role="group" aria-label="Basic example">'+
                                        '<a class="text-center" href="'+show_url+'"><button type="button" class="btn btn-sm btn-light waves-effect"><i class="mdi mdi-eye font-18"></i></button></a> &nbsp;'+
                                        '</div>';                     

//                                var u = '';
                                return u;
                            } 
                        }
            ] 
        }); 
//        
    }
    


     
});


