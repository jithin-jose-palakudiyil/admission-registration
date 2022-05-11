var url_prefix ='quiz-questions';
$(function() 
{  
    
    

    
/* ************************************************************************** */  
/* *************************** initialization ******************************* */  
/* ************************************************************************** */ 

    if($('#quiz-questions-datatable').length)
    {   
        
        var url=$('#quiz-questions-datatable').attr('data-url');
        var i=1;
        $('#quiz-questions-datatable').DataTable
        ({
            processing: true,
            serverSide: true, 
//            ajax: url,
            "ajax": {
                "url": url,
                "data": { 'quiz_id': $('#quiz_id').val(), }
              },
            columns: [ 
                        {
                            data: "id", sortable: true,
                            render: function (data, type, full) {  return  full.id; } 
                        }, 
                        {
                            data: "question_youtube_id", sortable: false,
                            render: function (data, type, full) {  return  full.question_youtube_id; } 
                        },   
                        {
                            data: "question", sortable: false,
                            render: function (data, type, full) {  return  full.question; } 
                        },  
                        {
                            data: "null","searchable": false, sortable: false,
                            render: function (data, type, full)
                            {   
                                var delete_button ='onclick="return Delete('+full.id+')"';
                                var edit_url=base_url+'/'+admin_prefix+'/'+url_prefix+'/'+full.id+'/edit';
                                var  u = '<div class="btn-group" role="group" aria-label="Basic example">'+
                                        '<a class="text-center" href="'+edit_url+'"><button type="button" class="btn btn-sm btn-light waves-effect"><i class="mdi mdi-pencil font-18"></i></button></a> &nbsp;'+
                                        '<button type="button" '+delete_button+' class="btn btn-sm btn-light waves-effect"><i class="mdi mdi-archive font-18"></i></button>&nbsp;'+
                                        '</div>';                     

                                
                                return u;
                            } 
                        },
                        {
                            data: "status", sortable: false,  
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

    if($('#quiz_questions_form').length)
    { 
         
        $("#quiz_questions_form").validate
        ({ 
            ignore: [], 
            errorClass: 'invalid-feedback',
            successClass: 'valid-feedback',
            validClass: 'validation-valid-label',
            highlight: function(element, errorClass) { $(element).removeClass(errorClass); },
            unhighlight: function(element, errorClass) { $(element).removeClass(errorClass); }, 
            // Different components require proper error label placement
            errorPlacement: function(error, element)
            { 

                if (element.attr("name") == "status" ){  $("#status_err").html(error); }
                else if (element.attr("name") == "answers_show_status" ){  $("#answers_show_status_err").html(error); }
                else{  error.insertAfter(element);}      
            }, 
            rules: { 
                        'question_youtube_id':{required:true, normalizer: function(value) { return $.trim(value);  } },
                        'question':{ normalizer: function(value) { return $.trim(value);  } },
                        'status':{required:true, normalizer: function(value) { return $.trim(value);  } },
                        'answers_show_status':{required:true, normalizer: function(value) { return $.trim(value);  } },
                        'answers[1]':{required:true, normalizer: function(value) { return $.trim(value);  } },
                         
                     } 
            });
        $('#answers_show_status').on('change', function() {
            if( this.value =='timer'){
                $('input[name="time_of_answers"]').rules("add", { required:true, normalizer: function(value) { return $.trim(value);  }, number:true,max:60 });
                $('.time_of_answers_cls').show(); 
            }else{
                $('input[name="time_of_answers"]').rules('remove', 'required');
                $('.time_of_answers_cls').hide(); 
            }

        });
        
        /* ------------------------------------------------------------------------- */ 
        /* --------------------------------- add more  ----------------------------- */ 
        /* ------------------------------------------------------------------------- */   
  
        $(document.body).on("click",".add_btn",function()
        {
              
            $(".table_row:last").clone().hide().appendTo('.main_row').show('slow'); //taken clone of the last
            $(".table_row:last").find('input[type=text]').val('');
            $(".table_row:last").find(".invalid-feedback").remove(); 
            
            $(".table_row:last").find(".save_btn").attr('onClick','saveAnswer(event, null, '+$('.table_row').length+')');
            $(".table_row:last").find(".remove_btn").attr('onClick','deleteAnswer(event, null)');
//            $(".table_row:last").find(".correct_ans").attr('checked', false);;
           
            $('.table_row').each(function(index){
                var index = parseInt(index)+1; 
                $(this).attr('id','table_row_'+index);
                $(this).find(".answers").attr('name','answers['+(index)+']');
                $(this).find(".remove_btn").attr('data-row',index); 
                $(this).find(".correct_ans").attr('id','correct_ans_'+(index));
                $(this).find(".correct_ans_label").attr('for','correct_ans_'+(index));
                $(this).find(".number_answers").html(index);
                if(index !==1)
                {
//                    $(this).find(".save_btn").prop('onclick', null);  
//                    $(this).find(".save_btn").attr('onClick','saveAnswer(event, null, '+index+')');
//                    $(this).find(".remove_btn").prop('onclick', null);  
//                    $(this).find(".remove_btn").attr('onClick','deleteAnswer(event, null)');
                    
                    $(this).find(".save_btn").css({"display": "inline-block", "margin-right": "4px"});  
                    $(this).find(".remove_btn").css("display", "inline-block");
                }
                
//                $(this).find(".answers").rules("add", {required:true, normalizer: function(value) { return $.trim(value);  } } );
            });
            
            
        });
        
        
        
        
        
        /* ------------------------------------------------------------------------- */ 
        /* --------------------------------- remove more  ----------------------------- */ 
        /* ------------------------------------------------------------------------- */   
  
        
        
        $(document.body).on("click",".remove_btn",function()
        {
           
                var RowRemove = $(this).attr('data-row');
                 
                if(RowRemove!=1){ 
                   
                    setTimeout(function(){  
                        $('#table_row_'+RowRemove).remove(); 
                         
                        $('.table_row').each(function(index){
                            index = parseInt(index)+1; 
                            $(this).attr('id','table_row_'+index);
                            $(this).find(".answers").attr('name','answers['+(index)+']');
                            $(this).find(".remove_btn").attr('data-row',index); 
                            $(this).find(".number_answers").html(index);
                            $(this).find(".correct_ans").attr('id','correct_ans_'+(index));
                            $(this).find(".correct_ans_label").attr('for','correct_ans_'+(index));
//                            $(this).find(".answers").rules("add", {required:true, normalizer: function(value) { return $.trim(value);  } } );
                        });  
                    }, 50);
                }
             
        });
        
        
        
        
        
        
        
        
    }
     
     
     
     
       $('.correct_ans').on('change', function() {
            if ($(this).is(':checked'))
            {
                $(".correct_ans").each(function() {
                    $(this).val(0); 
                });
                $(this).val(1); 
            }  
        });
     
     
     
     
     
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
/* **************************** Save Answer ******************************** */  
/* ************************************************************************** */ 


function saveAnswer(event, answer_id, index)
{
    event.preventDefault();
    let answer = null;
    const question_id = $('input[name="question_id"]').val();
    answer = $('input[name="answers['+index+']"]').val();
    var is_answer = $('#correct_ans_'+index).val();
//    if ($('.correct_ans').is(':checked')){
        
   
   
        var url =base_url+'/'+admin_prefix+'/quiz-answers/'+question_id+'/store-update';  
       $.ajax
       ({
           type: 'POST',
           url: url,
           dataType: "json",
           async: false,
           headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
           data :{'answer_id':answer_id?answer_id:null, answer :answer?answer:null, is_answer :is_answer ? is_answer:null},
           success: function(response){
                    if(response.status == true) {
                        window.location.reload();
                    }
               },
           error: function (request, textStatus, errorThrown)  { 
               const resData =  request.responseJSON;
               if(resData.status == false && typeof(resData.type)!='undefined' && resData.type == 'no_answer' ){
                    window.location.reload();
               }
           }
       }); 
//    }
//    else{
//        $('#correct_ans_error').html('<div class="invalid-feedback" style="display: inline-block;">Please select correct answer</div>');
//        
//    }

  }


  /* ************************************************************************** */  
/* **************************** Delete Answer ******************************** */  
/* ************************************************************************** */ 


function deleteAnswer(event, answer_id) {
    event.preventDefault();
    const question_id = $('input[name="question_id"]').val();
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
            var url =base_url+'/'+admin_prefix+'/quiz-answers/'+question_id+'/destroy';  
            $.ajax
            ({
                type: 'DELETE',
                url: url,
                dataType: "json",
                async: false,
                headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data :{'answer_id':answer_id?answer_id:null},
                success: function(response){
                         if(response.status == true) {
                             // window.location.reload();
                         }
                    },
                error: function (request, textStatus, errorThrown)  {  }
            }); 
        }else{
            window.location.reload();
        }
    });


  }


