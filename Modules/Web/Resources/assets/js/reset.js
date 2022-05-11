
var form = $("#reset_form");
$(function() {
form.validate({
    ignore: 'input[type=hidden]', // ignore hidden fields
    errorClass: 'error',
    highlight: function(element, errorClass) { $(element).removeClass(errorClass); },
    unhighlight: function(element, errorClass) { $(element).removeClass(errorClass); }, 
    rules:{
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
          

});

