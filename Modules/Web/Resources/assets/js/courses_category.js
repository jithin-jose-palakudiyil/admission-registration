// var form = $("#courses_category_form");

 $(function() {

    $('.courses_category_class').on('change', function() {
        $('.courses_category_class').not(this).prop('checked', false);  
    });
//     form.validate({
//         ignore: 'input[type=hidden]', // ignore hidden fields
//         errorClass: 'error',
//         highlight: function(element, errorClass) { $(element).removeClass(errorClass); },
//         unhighlight: function(element, errorClass) { $(element).removeClass(errorClass); }, 
//         rules:{
//             'courses_category[]':{required:true, normalizer: function(value) { return $.trim(value);  }, 'confirmPassword':true  }, 
    
//         }
//     });
    
    
//         $.validator.addMethod("courses_category", function(value, elem, param) {
//             return $(".roles:checkbox:checked").length > 0;
//         },"You must select at least one!");
    
     });
    
    
