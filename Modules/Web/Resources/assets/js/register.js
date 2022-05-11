
var form = $("#register_form");
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
        'name':{required:true, normalizer: function(value) { return $.trim(value);  } }, 
        'email':{required:true,email:true, normalizer: function(value) { return $.trim(value);  } }, 
        'mobile':{required:true,number:true,maxlength:10,digits:true, normalizer: function(value) { return $.trim(value);  } }, 
        'password':{required:true, normalizer: function(value) { return $.trim(value);  } }, 
        'confirm_password':{required:true, normalizer: function(value) { return $.trim(value);  }, 'confirmPassword':true  }, 

    }
});


          /*Password validation*/
          $.validator.addMethod("confirmPassword", function(value, element) 
          {   
              var ConfirmPassword = $('input[name="confirm_password"]').val();
              var txtPassword = $('input[name="password"]').val();
              if(txtPassword == ConfirmPassword){ return true; }
              else  { $.validator.messages.confirmPassword = 'The password is not matching'; return false;   }  

          }, $.validator.messages.chkPassword );
          /* Password validation end */

        //   if($("#otp_form").length){

        //     $("#otp_form").validate({
        //         ignore: 'input[type=hidden]', // ignore hidden fields
        //         errorClass: 'error',
        //         highlight: function(element, errorClass) { $(element).removeClass(errorClass); },
        //         unhighlight: function(element, errorClass) { $(element).removeClass(errorClass); }, 
        //         rules:{
        //             'otp':{required:true, normalizer: function(value) { return $.trim(value);  },digits: true, minlength: 4,maxlength: 4  },
        //         }
        //     });
        //   }

          

});

