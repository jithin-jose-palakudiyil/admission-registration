var form = $("#documents_form");
$(function() {




form.validate({
    ignore: 'input[type=hidden]', // ignore hidden fields
    errorClass: 'error',
    highlight: function(element, errorClass) { $(element).removeClass(errorClass); },
    unhighlight: function(element, errorClass) { $(element).removeClass(errorClass); }, 
    rules:{
      
//        'tenth_mark_list'     :   {required:true,fileType: { types: ["jpg", "jpeg", "png"] }, maxFileSize: { "unit": "MB",  "size": 2  }, }, 
        'tenth_maximum_mark'          :   {required:true, normalizer: function(value) { return $.trim(value);  },number:true   },
        'tenth_mark'          :   {required:true, normalizer: function(value) { return $.trim(value);  },number:true   },
        'tenth_board'          :   {required:true, normalizer: function(value) { return $.trim(value);  },number:true   },
        
//        'plus_one_mark_list'  :   {required:true,fileType: { types: ["jpg", "jpeg", "png"] }, maxFileSize: { "unit": "MB",  "size": 2  }, }, 
        'plus_one_maximum_mark'       :   {required:true, normalizer: function(value) { return $.trim(value);  },number:true   },
        'plus_one_mark'       :   {required:true, normalizer: function(value) { return $.trim(value);  },number:true   },
        'plus_one_board'       :   {required:true, normalizer: function(value) { return $.trim(value);  },number:true   },
         
//        'plus_two_mark_list'  :   {fileType: { types: ["jpg", "jpeg", "png"] }, maxFileSize: { "unit": "MB",  "size": 2  }, }, 
//        'plus_two_mark'       :   {required:true, normalizer: function(value) { return $.trim(value);  },number:true   },
//        'plus_two_maximum_mark'       :   {required:true, normalizer: function(value) { return $.trim(value);  },number:true   },
        
    }
});
        if($('#tenth_mark_list_rem').length)
        {
            $('input[name="tenth_mark_list"]').rules('remove', 'required');
        }
        
        if($('#plus_one_mark_list_rem').length)
        {
            $('input[name="plus_one_mark_list"]').rules('remove', 'required');
        }
        
        if($('#plus_two_mark_list_rem').length)
        {
            $('input[name="plus_two_mark_list"]').rules('remove', 'required');
        }
});
