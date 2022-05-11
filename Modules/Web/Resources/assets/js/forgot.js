
var form = $("#forgot_form");
$(function() {


//     if($("#mobile").length)
// {
//     $("#mobile").intlTelInput
//     ({
//         initialCountry: 'in',localizedCountries:'in',
//         separateDialCode: true,
//         nationalMode: false,
//         allowDropdown: false, 
//         utilsScript: base_url+"'public/vendor/intlTelInput/utils.js" // just for formatting/placeholders etc
//     });
// }



    form.validate({
        ignore: 'input[type=hidden]', // ignore hidden fields
        errorClass: 'error',
        highlight: function(element, errorClass) { $(element).removeClass(errorClass); },
        unhighlight: function(element, errorClass) { $(element).removeClass(errorClass); }, 
        rules:{
            'mobile':{required:true,number:true,maxlength:10,digits:true, normalizer: function(value) { return $.trim(value);  } }, 
        }
    });


});

