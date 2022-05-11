
var form = $("#otp_form");
$(function() {




form.validate({
    ignore: 'input[type=hidden]', // ignore hidden fields
    errorClass: 'error',
    highlight: function(element, errorClass) { $(element).removeClass(errorClass); },
    unhighlight: function(element, errorClass) { $(element).removeClass(errorClass); }, 
    rules:{
        'otp':{required:true, normalizer: function(value) { return $.trim(value);  },digits: true, minlength: 4,maxlength: 4  },


    }
});

    /* ************************************************************************* */  
    /* **************************** Resend otp ********************************* */  
    /* ************************************************************************* */ 

    $(document).on("click","#ResendCode",function() 
    { 
        var url=base_url+'/register/resend-otp/';  

        $.ajax
        ({
                type: 'GET',
                url: url,
                dataType: "json",
                async: false,
                headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data :{'resend':1,},
                success: function(response)
                {  
                    var obj =  $.parseJSON(JSON.stringify(response)); 
                    if(obj.status)
                    {
                        $("#some_div").show();
                        $("#ResendCode").hide();
                        sessionStorage.setItem("counter", 120);
                        timer(sessionStorage.getItem("counter"));
                    }

                    if(obj.resend_msg)
                    {
                        $("#otp_message").html(obj.resend_msg) 
                    }

                },  error: function (request, textStatus, errorThrown)  {}
            });  
    });  

    /* ********************************************************************** */  
    /* **************************** timer form ****************************** */  
    /* ********************************************************************** */ 

        if (sessionStorage.getItem("counter")) { 
            if(sessionStorage.getItem("counter") == 0)
            {
                sessionStorage.removeItem("counter");
            }
        } 
        else { sessionStorage.setItem("counter", 120); }

        timer(sessionStorage.getItem("counter"));  

});



      


let timerOn = true;

function timer(remaining) {  
  var m = Math.floor(remaining / 60);
  var s = remaining % 60;
  
  m = m < 10 ? '0' + m : m;
  s = s < 10 ? '0' + s : s;
  document.getElementById('some_div').innerHTML = m + ':' + s;
  remaining -= 1;
  
  if(remaining >= 0 && timerOn) {
    setTimeout(function() {
        timer(remaining);
         sessionStorage.setItem("counter", remaining);
    }, 1000);
    return;
  }
  else
  {
      $("#ResendCode").show(); 
      $("#some_div").hide();
  }

  if(!timerOn) {
    // Do validate stuff here
    return;
  }
  
 
 
}
