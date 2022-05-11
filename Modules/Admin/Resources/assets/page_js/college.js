var url_prefix ='colleges';
$(function() 
{  
    
    
    
/* ************************************************************************** */  
/* *************************** initialization ******************************* */  
/* ************************************************************************** */ 

    if($('#college-datatable').length)
    {   
        
        var url=$('#college-datatable').attr('data-url');
        $('#college-datatable').DataTable
        ({
            processing: true,
            serverSide: true, 
            ajax: url,
            columns: [ 
                        {
                            data: "name", sortable: true,
                            render: function (data, type, full) {  return  full.name; } 
                        },   
                          
                        {
                            data: "null","searchable": false, sortable: false,
                            render: function (data, type, full)
                            {   
                                var delete_button ='onclick="return Delete('+full.id+')"';
                                var edit_url=base_url+'/'+admin_prefix+'/'+url_prefix+'/'+full.id+'/edit';
                                var assign_url=base_url+'/'+admin_prefix+'/'+url_prefix+'/assign-category/'+full.id+'';
                                var assign_url_form=base_url+'/'+admin_prefix+'/'+url_prefix+'/assign-forms/'+full.id+'';
                                var  u = '<div class="btn-group" role="group" aria-label="Basic example">'+
                                        '<a class="text-center" href="'+edit_url+'"><button type="button" class="btn btn-sm btn-light waves-effect"><i class="mdi mdi-pencil font-18"></i></button></a> &nbsp;'+
                                        '<button type="button" '+delete_button+' class="btn btn-sm btn-light waves-effect"><i class="mdi mdi-archive font-18"></i></button>&nbsp;'+
                                        '<a class="text-center" href="'+assign_url+'"><button type="button" class="btn btn-sm btn-light waves-effect"><i class=" mdi mdi-turtle font-18"></i></button></a> &nbsp;'+
                                        '<a class="text-center" href="'+assign_url_form+'"><button type="button" class="btn btn-sm btn-light waves-effect"><i class=" la la-code-fork font-18"></i></button></a> &nbsp;'+
                                        '</div>';                     

                                
                                return u;
                            } 
                        },
                        {
                            data: "status", sortable: true,  
                            render: function (data, type, full) 
                            { 
                                if(full.status=="0")  { return '<button type="button" class="btn btn-danger waves-effect waves-light">InActive</button>';  }
                                else if(full.status=="1")  { return '<button type="button" class="btn btn-success waves-effect waves-light">Active</button>';  }
                            } 
                        }
            ] 
        }); 
//        
    }
    
/* ************************************************************************** */  
/* **************************** validate form ******************************* */  
/* ************************************************************************** */ 

    if($('#college_form').length)
    { 
        $("#name").keyup(function() {  $("#slug").val(generate_slug($("#name").val())); }); 
        $("#college_form").validate
        ({ 
            ignore: [],
//            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'invalid-feedback',
            successClass: 'valid-feedback',
            validClass: 'validation-valid-label',
            highlight: function(element, errorClass) { $(element).removeClass(errorClass); },
            unhighlight: function(element, errorClass) { $(element).removeClass(errorClass); }, 
            // Different components require proper error label placement
            errorPlacement: function(error, element)
            { 

                if (element.attr("name") == "status" ){  $("#status_err").html(error); }
                else{  error.insertAfter(element);}      
            }, 
            rules: { 
                        'name':{required:true, normalizer: function(value) { return $.trim(value);  } },
                        'slug':{required:true, normalizer: function(value) { return $.trim(value);  } },
                        'status':{required:true, normalizer: function(value) { return $.trim(value);  } },
                        'username':{required:true, normalizer: function(value) { return $.trim(value);  } },
                        'password':{required:true, normalizer: function(value) { return $.trim(value);  },minlength:6 },
                        

                     } 
            });
            
                if($('#HdnEdit').length){
                    $('input[name="password"]').rules('remove', 'required');
                }
    }
     
});

 
/* ************************************************************************** */  
/* **************************** Generate Slug ******************************* */  
/* ************************************************************************** */ 

function generate_slug(str) 
{
    var $slug = '';
    var trimmed = $.trim(str);
    $slug = trimmed.replace(/ /g, '-').
            replace(/\s*:|\s+(?=\s)/g, "").
            replace(/-+/g, '-').
            replace(/^-|-$/g, '');
    return $slug.toLowerCase();
}


/* ************************************************************************** */  
/* **************************** Delete Entry ******************************** */  
/* ************************************************************************** */ 

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
