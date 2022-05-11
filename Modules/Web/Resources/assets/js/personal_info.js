$(function() 
{  
  var value = $('#caste_category').val();
//  console.log(value);
  if(value == "Other"){
    $( "#dob_col" ).removeClass( "col-lg-6" )
    $( "#dob_col" ).addClass( "col-lg-4" )
    $( "#caste_category_col" ).removeClass( "col-lg-6" )
    $( "#caste_category_col" ).addClass( "col-lg-4" )
    $( "#caste_category_other_col" ).show();
    $('input[name="caste_category_other"]').rules("add", {required:true, normalizer: function(value) { return $.trim(value);  }, maxlength:255  } );
  
    // $( "#caste_category_other_col" ).removeClass( "col-lg-6" )
  
  }else{
    $( "#dob_col" ).removeClass( "col-lg-4" )
    $( "#dob_col" ).addClass( "col-lg-6" )
    $( "#caste_category_col" ).removeClass( "col-lg-4" )
    $( "#caste_category_col" ).addClass( "col-lg-6" )
    $( "#caste_category_other_col" ).hide();
    $('input[name="caste_category_other"]').rules("remove");
  
  }
})

  // $(this).valid();



$('#caste_category').change(function () {
  // $(this).valid();
  var value = $(this).val();
//  console.log(value);
  if(value == "Other"){
    $( "#dob_col" ).removeClass( "col-lg-6" )
    $( "#dob_col" ).addClass( "col-lg-4" )
    $( "#caste_category_col" ).removeClass( "col-lg-6" )
    $( "#caste_category_col" ).addClass( "col-lg-4" )
    $( "#caste_category_other_col" ).show();
    $('input[name="caste_category_other"]').rules("add", {required:true, normalizer: function(value) { return $.trim(value);  }, maxlength:255  } );

    // $( "#caste_category_other_col" ).removeClass( "col-lg-6" )

  }else{
    $( "#dob_col" ).removeClass( "col-lg-4" )
    $( "#dob_col" ).addClass( "col-lg-6" )
    $( "#caste_category_col" ).removeClass( "col-lg-4" )
    $( "#caste_category_col" ).addClass( "col-lg-6" )
    $( "#caste_category_other_col" ).hide();
    $('input[name="caste_category_other"]').rules("remove");

  }
});


$(function() 
{  
  var value = $('#board').val();
  if(value == "Other"){
    $( "#class_completed_col" ).removeClass( "col-lg-6" )
    $( "#class_completed_col" ).addClass( "col-lg-4" )
    $( "#board_col" ).removeClass( "col-lg-6" )
    $( "#board_col" ).addClass( "col-lg-4" )
    $( "#board_other_col" ).show();
    $('input[name="board_other"]').rules("add", {required:true, normalizer: function(value) { return $.trim(value);  }, maxlength:255  } );

    // $( "#board_other_col" ).removeClass( "col-lg-6" )

  }else{
    $( "#class_completed_col" ).removeClass( "col-lg-4" )
    $( "#class_completed_col" ).addClass( "col-lg-6" )
    $( "#board_col" ).removeClass( "col-lg-4" )
    $( "#board_col" ).addClass( "col-lg-6" )
    $( "#board_other_col" ).hide();
    $('input[name="board_other"]').rules("remove");
  }

})


$('#board').change(function () {
  // $(this).valid();
  var value = $(this).val();
//  console.log(value);
  if(value == "Other"){
    $( "#class_completed_col" ).removeClass( "col-lg-6" )
    $( "#class_completed_col" ).addClass( "col-lg-4" )
    $( "#board_col" ).removeClass( "col-lg-6" )
    $( "#board_col" ).addClass( "col-lg-4" )
    $( "#board_other_col" ).show();
    $('input[name="board_other"]').rules("add", {required:true, normalizer: function(value) { return $.trim(value);  }, maxlength:255  } );

    // $( "#board_other_col" ).removeClass( "col-lg-6" )

  }else{
    $( "#class_completed_col" ).removeClass( "col-lg-4" )
    $( "#class_completed_col" ).addClass( "col-lg-6" )
    $( "#board_col" ).removeClass( "col-lg-4" )
    $( "#board_col" ).addClass( "col-lg-6" )
    $( "#board_other_col" ).hide();
    $('input[name="board_other"]').rules("remove");

  }
});







var form = $("#personal_info_form");
$(function() {




form.validate({
    ignore: 'input[type=hidden]', // ignore hidden fields
    errorClass: 'error',
    highlight: function(element, errorClass) { $(element).removeClass(errorClass); },
    unhighlight: function(element, errorClass) { $(element).removeClass(errorClass); }, 
    rules:{
        "address"             :   {required:true, normalizer: function(value) { return $.trim(value);  },maxlength:255   },
        "district"            :   {required:true, normalizer: function(value) { return $.trim(value);  },maxlength:255   },
        "pin"                 :   {required:true, normalizer: function(value) { return $.trim(value);  },maxlength:255, digits: true   },
        "gender"              :   {required:true, normalizer: function(value) { return $.trim(value);  },maxlength:255   },
        'date_of_birth'       :   {required:true, normalizer: function(value) { return $.trim(value);  },maxlength:255   },
        'caste_category'      :   {required:true, normalizer: function(value) { return $.trim(value);  },maxlength:255   },
        'mobile'              :   {required:true, normalizer: function(value) { return $.trim(value);  },maxlength:10, digits: true   },
        'whatsapp'            :   {required:true, normalizer: function(value) { return $.trim(value);  },maxlength:10, digits: true   },
        'parent_name'         :   {required:true, normalizer: function(value) { return $.trim(value);  },maxlength:255   },
        'parent_contact'      :   {required:true, normalizer: function(value) { return $.trim(value);  },maxlength:10, digits: true   },
//        'class_completed'     :   {required:true, normalizer: function(value) { return $.trim(value);  },maxlength:255   },
//        'board'               :   {required:true, normalizer: function(value) { return $.trim(value);  },maxlength:255   },
//        'last_studied'        :   {required:true, normalizer: function(value) { return $.trim(value);  },maxlength:255   },
//        'annual_income'       :   {required:true, normalizer: function(value) { return $.trim(value);  },maxlength:255   },
        
//        'tenth_mark_list'     :   {required:true,fileType: { types: ["jpg", "jpeg", "png"] }, maxFileSize: { "unit": "MB",  "size": 2  }, }, 
//        'tenth_maximum_mark'          :   {required:true, normalizer: function(value) { return $.trim(value);  },number:true   },
//        'tenth_mark'          :   {required:true, normalizer: function(value) { return $.trim(value);  },number:true   },
//        'tenth_board'          :   {required:true, normalizer: function(value) { return $.trim(value);  },number:true   },
//        
//        'plus_one_mark_list'  :   {required:true,fileType: { types: ["jpg", "jpeg", "png"] }, maxFileSize: { "unit": "MB",  "size": 2  }, }, 
//        'plus_one_maximum_mark'       :   {required:true, normalizer: function(value) { return $.trim(value);  },number:true   },
//        'plus_one_mark'       :   {required:true, normalizer: function(value) { return $.trim(value);  },number:true   },
//        'plus_one_board'       :   {required:true, normalizer: function(value) { return $.trim(value);  },number:true   },
         
//        'plus_two_mark_list'  :   {fileType: { types: ["jpg", "jpeg", "png"] }, maxFileSize: { "unit": "MB",  "size": 2  }, }, 
//        'plus_two_mark'       :   {required:true, normalizer: function(value) { return $.trim(value);  },number:true   },
//        'plus_two_maximum_mark'       :   {required:true, normalizer: function(value) { return $.trim(value);  },number:true   },
       
        
        
        
    }
});



//        if($('#tenth_mark_list_rem').length)
//        {
//            $('input[name="tenth_mark_list"]').rules('remove', 'required');
//        }
//        
//        if($('#plus_one_mark_list_rem').length)
//        {
//            $('input[name="plus_one_mark_list"]').rules('remove', 'required');
//        }
//        
//        if($('#plus_two_mark_list_rem').length)
//        {
//            $('input[name="plus_two_mark_list"]').rules('remove', 'required');
//        }
});
