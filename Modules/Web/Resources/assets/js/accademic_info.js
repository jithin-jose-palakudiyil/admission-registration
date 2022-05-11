

//$('#caste_category').change(function () {
//  // $(this).valid();
//  var value = $(this).val();
////  console.log(value);
//  if(value == "Other"){
//    $( "#dob_col" ).removeClass( "col-lg-6" )
//    $( "#dob_col" ).addClass( "col-lg-4" )
//    $( "#caste_category_col" ).removeClass( "col-lg-6" )
//    $( "#caste_category_col" ).addClass( "col-lg-4" )
//    $( "#caste_category_other_col" ).show();
//    $('input[name="caste_category_other"]').rules("add", {required:true, normalizer: function(value) { return $.trim(value);  }, maxlength:255  } );
//
//    // $( "#caste_category_other_col" ).removeClass( "col-lg-6" )
//
//  }else{
//    $( "#dob_col" ).removeClass( "col-lg-4" )
//    $( "#dob_col" ).addClass( "col-lg-6" )
//    $( "#caste_category_col" ).removeClass( "col-lg-4" )
//    $( "#caste_category_col" ).addClass( "col-lg-6" )
//    $( "#caste_category_other_col" ).hide();
//    $('input[name="caste_category_other"]').rules("remove");
//
//  }
//});


var form = $("#accademic_info_form");
$(function() 
{

form.validate({
    ignore: 'input[type=hidden]', // ignore hidden fields
    errorClass: 'error',
    highlight: function(element, errorClass) { $(element).removeClass(errorClass); },
    unhighlight: function(element, errorClass) { $(element).removeClass(errorClass); },
    errorPlacement: function(error, element)
            { 

                if (element.attr("name") == "tenth_mark_list" ){  $("#tenth_mark_list_error").html(error); }
                else if (element.attr("name") == "mark_list_plus_two" ){  $("#mark_list_plus_two_error").html(error); }
          
                else{  error.insertAfter(element);}      
            }, 
    rules:{
        "tenth_board"           :   {required:true, normalizer: function(value) { return $.trim(value);  },maxlength:255   },
        "tenth_passing_year"    :   {required:true, normalizer: function(value) { return $.trim(value);  },digits: true  },
        "tenth_register_number" :   {required:true, normalizer: function(value) { return $.trim(value);  },digits: true   },
        "tenth_marks"           :   {required:true, normalizer: function(value) { return $.trim(value);  },number: true   },
        'tenth_mark_list'       :   {required:true,fileType: { types: ["jpg", "jpeg", "png"] }, maxFileSize: { "unit": "MB",  "size": 2  }, },    
        
        "plus_two_board"           :   {required:true, normalizer: function(value) { return $.trim(value);  },maxlength:255   },
        "plus_two_passing_year"    :   {required:true, normalizer: function(value) { return $.trim(value);  },digits: true  },
        "plus_two_register_number" :   {required:true, normalizer: function(value) { return $.trim(value);  },digits: true   },
        "plus_two_marks"           :   {required:true, normalizer: function(value) { return $.trim(value);  },number: true   },
        'mark_list_plus_two'       :   {fileType: { types: ["jpg", "jpeg", "png"] }, maxFileSize: { "unit": "MB",  "size": 2  }, },    
        
        
    }
});
 
 
    $('#entrance_exam').change(function() {
        if($(this).is(":checked")) {
            $('input[name="entrance_name"]').rules("add", { required:true, normalizer: function(value) { return $.trim(value);  },maxlength:255 });
            $('input[name="entrance_rank"]').rules("add", { required:true, normalizer: function(value) { return $.trim(value);  }, digits:true});
            $('.show_entrance').show();
        }
        else{
            $('input[name="entrance_name"]').rules('remove', 'required');
            $('input[name="entrance_rank"]').rules('remove', 'required');
            $('.show_entrance').hide();
        }
                
    });
    
    $('#entrance_result_waiting').change(function() {
        if($(this).is(":checked")) {
            $('input[name="entrance_rank"]').val('');
            $('input[name="entrance_rank"]').rules('remove', 'required');
            $('input[name="entrance_rank"]').prop("disabled", true);
        }
        else{
            $('input[name="entrance_rank"]').rules("add", { required:true, normalizer: function(value) { return $.trim(value);  }, digits:true});
            $('input[name="entrance_rank"]').prop("disabled", false);
        }
                
    });
    
     $('#entrance_result_waiting_1').change(function() {
        if($(this).is(":checked")) {
            $('input[name="entrance_rank_1"]').val('');
            $('input[name="entrance_rank_1"]').rules('remove', 'required');
            $('input[name="entrance_rank_1"]').prop("disabled", true);
        }
        else{
            $('input[name="entrance_rank_1"]').rules("add", { required:true, normalizer: function(value) { return $.trim(value);  }, digits:true});
            $('input[name="entrance_rank_1"]').prop("disabled", false);
        }
                
    });
    
    
  
if($('#tenth_marks_uploded').length){
    $('input[name="tenth_mark_list"]').rules('remove', 'required');
}
  
  
if($('#mark_list_plus_two_uploded').length){
//    $('input[name="mark_list_plus_two"]').rules('remove', 'required');
}

if($('#pcb_m').length){
    $('input[name="pcb_m"]').rules("add", { required:true, normalizer: function(value) { return $.trim(value);  }, number:true});
}
 
 if($('#pcm').length){
    if(!$('#HiddenCheck').length)
    {
        $('input[name="pcm"]').rules("add", { required:true, normalizer: function(value) { return $.trim(value);  }, number:true});
    }
}
if($('#HiddenCheck').length){
   
   $('.rem_danger').remove();
    $('input[name="pcm"]').rules('remove', 'required');
    $('select[name="plus_two_board"]').rules('remove', 'required');
    $('input[name="plus_two_passing_year"]').rules('remove', 'required');
    $('input[name="plus_two_register_number"]').rules('remove', 'required');
    $('input[name="plus_two_marks"]').rules('remove', 'required');
//    $('input[name="mark_list_plus_two"]').rules('remove', 'required');
}


 
 
//        if($('#tenth_mark_list_rem').length)
//        {
//            $('input[name="tenth_mark_list"]').rules('remove', 'required');
//        }
 
});
