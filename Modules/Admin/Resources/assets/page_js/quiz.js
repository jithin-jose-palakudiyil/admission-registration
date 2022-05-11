var url_prefix ='quiz';
$(function() 
{  
    
    
    
/* ************************************************************************** */  
/* *************************** initialization ******************************* */  
/* ************************************************************************** */ 

    if($('#quiz-datatable').length)
    {   
        data_table();
        setInterval(function()
        {
            $('#quiz-datatable').dataTable().fnClearTable();
            $('#quiz-datatable').dataTable().fnDestroy(); 
            data_table();
        }, 15000); 
    }
    
/* ************************************************************************** */  
/* **************************** validate form ******************************* */  
/* ************************************************************************** */ 

    if($('#quiz_form').length)
    { 
        $("#quiz_form").validate
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
                else if (element.attr("name") == "btn_show_status" ){  $("#btn_show_status_err").html(error); }
                else if (element.attr("name") == "exam_type" ){  $("#exam_type_err").html(error); }
                else if (element.attr("name") == "exams[]" ){  $("#exam_error").html(error); }
                else if (element.attr("name") == "exams_status" ){  $("#exams_status_error").html(error); }
                else{  error.insertAfter(element);}      
            }, 
            rules: { 
                        'name':{required:true, normalizer: function(value) { return $.trim(value);  } },
                        'button_text':{required:true, normalizer: function(value) { return $.trim(value);  } },
                        'status':{required:true, normalizer: function(value) { return $.trim(value);  } },
                        'review_quiz':{required:true,normalizer: function(value) { return $.trim(value);  } },
                        'video_id':{required:true, normalizer: function(value) { return $.trim(value);  } },
                        'btn_show_status':{required:true, normalizer: function(value) { return $.trim(value);  } },
                        'description':{required:true, normalizer: function(value) { return $.trim(value);  } },
                        'exam_completed_description':{required:true, normalizer: function(value) { return $.trim(value);  } },
                        'exam_completed_image':{required:true, normalizer: function(value) { return $.trim(value);  } },
                        'exam_type':{required:true, normalizer: function(value) { return $.trim(value);  } },
                        'exams_status':{required:true, normalizer: function(value) { return $.trim(value);  } },

                 
                     } 
            });
            $('#btn_show_status').on('change', function() {
                if( this.value =='timer'){
                    $('input[name="time_of_btn"]').rules("add", { required:true, normalizer: function(value) { return $.trim(value);  }, number:true,max:60 });
                    $('.time_of_btn_cls').show(); 
                }else{
                    $('input[name="time_of_btn"]').rules('remove', 'required');
                    $('.time_of_btn_cls').hide(); 
                }
               
            });
            
            
            
            
            
            
            
            
            
            
            
            
        //onchange      
        $('#exam_type').on('change', function() {
            
            var values = this.value;
           
            if(values == 're_exam_for_previous'){
//                 alert(values);
                GetExams(values);
            } else { $('#appendDiv').html(''); }
        });
            
        $(document).on('change', '#is_need_new_users', function() {
            if(this.checked) {
                $('#FromDateofJoiningDiv').show();
                $('input[name="date_users_reg_re_exam"]').rules("add", {required:true, normalizer: function(value) { return $.trim(value);  } } ); 
            }
            else{
                $('input[name="date_users_reg_re_exam"]').rules('remove', 'required');
                $('#FromDateofJoiningDiv').hide();
            }
        });    
    }
     
});
 
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


/* ************************************************************************** */  
/* **************************** Close Quiz ********************************** */  
/* ************************************************************************** */ 

function CloseQuiz(id)
    {  
         
        
          
            Swal.fire({
                title: "You want to close this exam?.",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, close it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ml-2 mt-2",
                buttonsStyling: !1
            }).then(function(t) 
            { 
                if(t.value == true)
                { 
                    var url=base_url+'/'+admin_prefix+'/'+url_prefix+'/close/'+id;  
                    $.ajax
                    ({
                       type: 'get',
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

/* ************************************************************************** */  
/* **************************** Result Quiz ********************************* */  
/* ************************************************************************** */ 

function ResultQuiz(id)
    {  
         
        
          
            Swal.fire({
                title: "You want to publish exam result?.",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, publish it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ml-2 mt-2",
                buttonsStyling: !1
            }).then(function(t) 
            { 
                if(t.value == true)
                { 
                    var url=base_url+'/'+admin_prefix+'/'+url_prefix+'/result-publish/'+id;
                    window.location.href =url;
//                    $.ajax
//                    ({
//                       type: 'get',
//                        url: url,
//                        dataType: "json",
//                        async: false,
//                        headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
//                        data :{'application':id},
//                        success: function(response){  window.location.reload(); },
//                        error: function (request, textStatus, errorThrown)  {  }
//                    }); 
                    
                } 
            })
         
                          

 
         
}

function data_table(){
     
        var url=$('#quiz-datatable').attr('data-url');
        $('#quiz-datatable').DataTable
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
                            data: "Open or Close", sortable: true,  
                            render: function (data, type, full) 
                            { 
//                                if(full.open_or_close=="4")  { return '<button type="button" class="btn btn-secondary waves-effect waves-light">Publishing  Results</button>';  }
//                                else
                                if(full.open_or_close=="3")  { return '<button type="button" class="btn btn-primary waves-effect waves-light">Pending</button>';  }
                                else if(full.open_or_close=="2")  { return '<button type="button" class="btn btn-danger waves-effect waves-light">Closed</button>';  }
                                else if(full.open_or_close=="1")  { return '<button type="button" class="btn btn-success waves-effect waves-light">Open</button>';  }
                                else{return null;}
                            } 
                        },
                        {
                            data: "null","searchable": false, sortable: false,
                            render: function (data, type, full)
                            {   
                                var delete_button ='onclick="return Delete('+full.id+')"';
                                var quiz_button ='onclick="return CloseQuiz('+full.id+')"';
                                var quiz_result ='onclick="return ResultQuiz('+full.id+')"';
                                var edit_url=base_url+'/'+admin_prefix+'/'+url_prefix+'/'+full.id+'/edit';
                                var quiz_open_url=base_url+'/'+admin_prefix+'/'+url_prefix+'/open-exam/'+full.id;
                                var assign_url=base_url+'/'+admin_prefix+'/quiz-questions/?quiz='+full.id+'';
                                var  u = '<div class="btn-group" role="group" aria-label="Basic example">'+
                                        '<a class="text-center" href="'+edit_url+'"><button type="button" class="btn btn-sm btn-light waves-effect"><i class="mdi mdi-pencil font-18"></i></button></a> &nbsp;'+
                                        '<button type="button" '+delete_button+' class="btn btn-sm btn-light waves-effect"><i class="mdi mdi-archive font-18"></i></button>&nbsp;'+
                                        '<a class="text-center" href="'+assign_url+'"><button type="button" class="btn btn-sm btn-light waves-effect"><i class="  mdi mdi-book-open font-18"></i></button></a> &nbsp;';
                                    if(full.open_or_close == '1' && full.result_published == '2')
                                    {   
                                        u+= '<button type="button" '+quiz_button+' class="btn btn-sm btn-light waves-effect"><i class="mdi mdi-close font-18"></i></button>&nbsp;';
                                    }
                                    if(full.open_or_close == '2' && full.result_published == '2'){ 
//                                       u+='';
                                     u+= '<button type="button" '+quiz_result+' class="btn btn-sm btn-light waves-effect"><i class="mdi mdi-check-box-multiple-outline font-18"></i></button>&nbsp;';
                                    }
                                    if(full.open_or_close == '3' && full.result_published == '2'){   
                                     u+= '<a class="text-center" href="'+quiz_open_url+'"><button type="button"  class="btn btn-sm btn-light waves-effect"><i class="mdi mdi-eye-circle font-18"></i></button></a>&nbsp;';
                                    }
                                    if(full.open_or_close == '2' && full.result_published == '1')
                                    {
                                        var quiz_download=base_url+'/'+admin_prefix+'/download-result/'+full.id+'';
                                        u+= '<a class="text-center" href="'+quiz_download+'"><button type="button"  class="btn btn-sm btn-light waves-effect"><i class="mdi mdi-cloud-download font-18"></i></button></a>&nbsp;';
                                     
                                    }
                                    u+= '</div>';
                                   
                                    if(full.open_or_close == '2' && full.result_published == '3')
                                    {
                                        u+=     '<div class="progress" style="margin-top:10px"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="'+full.progress+'" aria-valuemin="0" aria-valuemax="100" style="width: '+full.progress+'%"></div></div>';
                                    }
                                
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



function GetExams(previous,edit=null){
    var data;
    data ={'previous':previous};
    if(window.edits==true){edit = window.exam_type_id; data ={'previous':previous,edit:edit};}
    var url=base_url+'/'+admin_prefix+'/'+url_prefix+'/GetExams';  
                    $.ajax
                    ({
                       type: 'get',
                        url: url,
                        dataType: "json",
                        async: false,
                        headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data :data,
                        success: function(response){ 
                            var obj =  $.parseJSON(JSON.stringify(response));
                            if( obj.html && obj.status==1)
                            {
                                $('#appendDiv').html(obj.html); 
                                $('.datepicker').datepicker({
                                    format: 'dd-mm-yyyy',autoclose:true
//                                    startDate: '-3d'
                                });
                                $('input[name="exams[]"]').rules("add", {required:true, normalizer: function(value) { return $.trim(value);  } } ); 
                                $('input[name="exams_status"]').rules("add", {required:true, normalizer: function(value) { return $.trim(value);  } } ); 
                                
                                if($("#is_need_new_users").is(':checked'))
                                {
                                    $('#FromDateofJoiningDiv').show();
                                    $('input[name="date_users_reg_re_exam"]').rules("add", {required:true, normalizer: function(value) { return $.trim(value);  } } ); 
            
                                }else
                                {
                                   $('input[name="date_users_reg_re_exam"]').rules('remove', 'required');
                                    $('#FromDateofJoiningDiv').hide(); 
                                }
                                
                            }
                            else
                            { 
                                if(obj.status==3)
                                {
                                   $('#appendDiv').html(obj.message); 
                                }
                                else{
                                    $('#appendDiv').html('');
                                }
                                $('input[name="exams[]"]').rules('remove', 'required');
                                $('input[name="exams_status"]').rules('remove', 'required');
                               
                            }
                
                           
                        },
                        error: function (request, textStatus, errorThrown)  {  }
                    }); 
}
