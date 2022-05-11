/*!
 * bootstrap wizard plugin initialize
 */
//$(document).ready(function () 
//{
//    "use strict";
//    $("#basicwizard").bootstrapWizard({
//            onNext: function (t, r, a) {
//             
//                var o = $($(t).data("targetForm"));
//                if (o && (o.addClass("was-validated"), !1 === o[0].checkValidity())) return event.preventDefault(), event.stopPropagation(), !1;
//            },
//        });
//});


$(function() {
    "use strict";
    $("#basicwizard").bootstrapWizard({
            onNext: function (t, r, a) {
                    var find_id =$(".BasicwizardTabs").find('.tab-pane.active').attr('id'); 
                    var tab = $("#"+find_id); 
                    var valid = true;
                    $('input', tab).each(function(i, v){
                        valid = validators.element(v) && valid;
                    });

                    if(!valid){
                           return event.preventDefault(), event.stopPropagation(), !1;  
                    }
            },
        });



 


  
//if($("#basicwizard").length) { $("#basicwizard").bootstrapWizard({}); } 
if($("#mobile").length)
{
     $("#mobile").intlTelInput
     ({
         initialCountry: 'in',localizedCountries:'in',
         separateDialCode: false,
         nationalMode: false,
         allowDropdown: false, 
         utilsScript: base_url+"/public/plugins/intlTelInput/utils.js" // just for formatting/placeholders etc
     });
}


if($("#father_mobile").length)
{
     $("#father_mobile").intlTelInput
     ({
         initialCountry: 'in',localizedCountries:'in',
         separateDialCode: false,
         nationalMode: false,
         allowDropdown: false, 
         utilsScript: base_url+"/public/plugins/intlTelInput/utils.js" // just for formatting/placeholders etc
     });
}

if($("#mother_mobile").length)
{
     $("#mother_mobile").intlTelInput
     ({
         initialCountry: 'in',localizedCountries:'in',
         separateDialCode: false,
         nationalMode: false,
         allowDropdown: false, 
         utilsScript: base_url+"/public/plugins/intlTelInput/utils.js" // just for formatting/placeholders etc
     });
 }

if($("#guardian_mobile").length)
{
     $("#guardian_mobile").intlTelInput
     ({
         initialCountry: 'in',localizedCountries:'in',
         separateDialCode: false,
         nationalMode: false,
         allowDropdown: false, 
         utilsScript: base_url+"/public/plugins/intlTelInput/utils.js" // just for formatting/placeholders etc
     });
}
        /* ------------------------------------------------------------------------- */ 
        /* -------------------------- form validate -------------------------------- */ 
        /* ------------------------------------------------------------------------- */
     var validators =   $("#BtechRegularForm").validate({ 
         ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'invalid-feedback',
            successClass: 'validation-valid-label',
            validClass: 'validation-valid-label',
        highlight: function(element, errorClass) { $(element).removeClass(errorClass); },
        unhighlight: function(element, errorClass) { $(element).removeClass(errorClass); }, 
        // Different components require proper error label placement
        errorPlacement: function(error, element)
        { 
            
            if (element.attr("name") == "mobile" ){  $("#mobile_error").html(error); }
            else if (element.attr("name") == "gender" ){  $("#gender_error").html(error); }
            else{  error.insertAfter(element);}      
        }, 
        rules: { 
                    'name':{required:true, normalizer: function(value) { return $.trim(value);  } }, 
                    'email':{required:true, normalizer: function(value) { return $.trim(value);  }, 'chkEmail':true },
//                    'mobile':{required:true, normalizer: function(value) { return $.trim(value);  }, chkMobile:true },
//                    'photo' :   {required:true,fileType: { types: ["jpg", "jpeg", "png"] }, maxFileSize: { "unit": "MB",  "size": 2  }, }, 
//                    'date_of_birth':{required:true, normalizer: function(value) { return $.trim(value);  },'validDate':true },
//                    'age':{required:true, normalizer: function(value) { return $.trim(value);  },number: true },
//                    'gender':{required:true, normalizer: function(value) { return $.trim(value);  } },
//                    'nationality':{required:true, normalizer: function(value) { return $.trim(value);  } },
//                    'religion':{required:true, normalizer: function(value) { return $.trim(value);  } },
//                    'community':{required:true, normalizer: function(value) { return $.trim(value);  } },
//                    'category':{required:true, normalizer: function(value) { return $.trim(value);  } },
//                    'blood_group':{required:true, normalizer: function(value) { return $.trim(value);  } },
//                    'aadhar_number':{required:true, normalizer: function(value) { return $.trim(value);  } },
//                    'permanent_address':{required:true, normalizer: function(value) { return $.trim(value);  } },
//                    'address_communication':{required:true, normalizer: function(value) { return $.trim(value);  } },
//                    
//                    'father_name':{required:true, normalizer: function(value) { return $.trim(value);  } },
//                    'father_occupation':{required:true, normalizer: function(value) { return $.trim(value);  } },
//                    'mother_name':{required:true, normalizer: function(value) { return $.trim(value);  } },
//                    'mother_occupation':{required:true, normalizer: function(value) { return $.trim(value);  } },
//                    'annual_family_income':{required:true, normalizer: function(value) { return $.trim(value);  },number:true },
//                    'guardian_mobile':{normalizer: function(value) { return $.trim(value);  }, 'chkMobile':true },
                    
//                    'subject[1]':{required:true, normalizer: function(value) { return $.trim(value);  } },
//                    'mark_obtained[1]':{required:true, normalizer: function(value) { return $.trim(value);  },number:true },
//                    'maximum_marks[1]':{required:true, normalizer: function(value) { return $.trim(value);  },number:true },
//                    'grade[1]':{required:true, normalizer: function(value) { return $.trim(value);  } },
//                    'grand_total':{required:true, normalizer: function(value) { return $.trim(value);  },number:true },
//                    'total_percentage':{required:true, normalizer: function(value) { return $.trim(value);  },number:true },
//                    'pcm_total':{required:true, normalizer: function(value) { return $.trim(value);  },number:true },
//                    'pcm_percentage':{required:true, normalizer: function(value) { return $.trim(value);  },number:true },
//                    
//                    'paper_I_figures':{normalizer: function(value) { return $.trim(value);  },number:true },
//                    'paper_II_figures':{normalizer: function(value) { return $.trim(value);  },number:true },
//                    'total_figures':{normalizer: function(value) { return $.trim(value);  },number:true },
//                    
                    
                    'place':{required:true, normalizer: function(value) { return $.trim(value);  } },
                    
                    
                 } 
        });
        


        /*email validation*/
        $.validator.addMethod("chkEmail", function(value, element) 
        {   
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value))
            {
                //check email address exist or not  
//                var obj;
//                var url=base_url+'/student/ValidateEmail';  
//                $.ajax
//                ({
//                    type: 'GET',
//                    url: url,
//                    dataType: "json",
//                    async: false,
//                    headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
//                    data :{'email':value,},
//                    success: function(response)
//                    {   obj =  $.parseJSON(JSON.stringify(response));  
//                    },  error: function (request, textStatus, errorThrown)  {  $.validator.messages.chkEmail='Somthing went wrong.'; }
//                }); 
                return true;
//                if(obj.status) {  return true;     }
//                else  { $.validator.messages.chkEmail = obj.error; return false;   }    
            } 
            else  {  $.validator.messages.chkEmail = 'Please enter a valid email address';  return false; }
        }, $.validator.messages.chkEmail );
        /* email validation end */
        
        
        
        /* Mobile validation */
        $.validator.addMethod("chkMobile", function(value, element) 
        { 
            var intlNumbers = $("#mobile").intlTelInput("getNumber");    
             
            $("#mobile").intlTelInput("setNumber", intlNumbers);
            var valid= $("#mobile").intlTelInput("isValidNumber"); 
            if(valid){
                // check mobile number already exist or not
//                var intlNumber = $("#txtMobileNumber").intlTelInput("getNumber"); 
                
//                var obj;
//                var url=base_url+'/student/ValidateMobile';  
//                $.ajax
//                ({
//                    type: 'GET',
//                    url: url,
//                    dataType: "json",
//                    async: false,
//                    headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
//                    data :{'mobile':$("#txtMobileNumber").val()},
//                    success: function(response)
//                    {   obj =  $.parseJSON(JSON.stringify(response));  
//                    },  error: function (request, textStatus, errorThrown)  {  $.validator.messages.chkMobile='Somthing went wrong.'; }
//                }); 
//                if(obj.status) {  return true;     }
//                else  { $.validator.messages.chkMobile = obj.error; return false;   } 
                return true;
            }else { $.validator.messages.chkMobile='Please enter a valid mobile number.'; return false; }

        }, $.validator.messages.chkMobile );
        /* Mobile validation end */
        


        /* Date of Birth validation */
        $.validator.addMethod( "validDate", function ( value, element )
        {
            var bits = value.match( /([0-9]+)/gi ), str;
            if ( ! bits )
                return this.optional(element) || false;
            str = bits[ 1 ] + '/' + bits[ 0 ] + '/' + bits[ 2 ];
            return this.optional(element) || !/Invalid|NaN/.test(new Date( str ));
        }, "Please enter a date in the format dd/mm/yyyy" );
        /* Date of Birth validation end */
 
 

        /* Check and radio input styles */
	 $(document).on('change','#p_address_for_communication', function(event) {
             
            var myval =$("#permanent_address").val();
             if($("#p_address_for_communication").is(":checked")) {
                $('#address_communication').val(myval);
                $('#address_communication').prop('disabled', true);
             }else{
                $('#address_communication').val('');
                $('#address_communication').prop('disabled', false);
             }   
        });
        
        $("#permanent_address").keyup(function(){
            var myval =$(this).val();
             if($("#p_address_for_communication").is(":checked")) {
                $('#address_communication').val(myval);
             }else{
                $('#address_communication').val('');
             } 
        });
    
        /* Check and radio input styles end */
        
        
        
        /* ------------------------------------------------------------------------- */ 
        /* --------------------------------- add more  ----------------------------- */ 
        /* ------------------------------------------------------------------------- */   
  
        $(document.body).on("click",".add_btn",function()
        {
             
            $(".table_row:last").clone().hide().appendTo('.table_main').show('slow'); //taken clone of the last
            $(".table_row:last").find('input[type=text]').val('');
            $(".table_row:last").find('input[type=text]').removeClass('error');
            $(".table_row:last").find(".error").remove(); 
            $(".table_row:last").find(".validation-error-label").remove(); 
            
            $('.table_row').each(function(index){
                 
                var index = parseInt(index)+1;
                $(this).attr('id','table_row_'+index);
                $(this).find(".subject").attr('name','subject['+(index)+']');
                $(this).find(".mark_obtained").attr('name','mark_obtained['+(index)+']');
                $(this).find(".maximum_marks").attr('name','maximum_marks['+(index)+']');
                $(this).find(".grade").attr('name','grade['+(index)+']'); 
                $(this).find(".remove_btn").attr('data-row',index); 
                $(this).find(".subject").rules("add", {required:true, normalizer: function(value) { return $.trim(value);  } } );
                $(this).find(".mark_obtained").rules("add", {required:true, normalizer: function(value) { return $.trim(value);  } ,number:true } );;
                $(this).find(".maximum_marks").rules("add", {required:true, normalizer: function(value) { return $.trim(value);  } ,number:true } );;
                $(this).find(".grade").rules("add", {required:true, normalizer: function(value) { return $.trim(value);  } } );
                if(index !==1)
                {
                    $(this).find(".remove_btn").css("display", "inline-block");
                }else{
                    
                }
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
                        $(this).find(".remove_btn").attr('data-row',index);
                        $(this).find(".subject").attr('name','subject['+(index)+']');
                        $(this).find(".mark_obtained").attr('name','mark_obtained['+(index)+']');
                        $(this).find(".maximum_marks").attr('name','maximum_marks['+(index)+']');
                        $(this).find(".grade").attr('name','grade['+(index)+']'); 
                    });
                }, 50);
              }
        });
     
    
    
    
    
    
    
    
    
    
    
    
        /* ------------------------------------------------------------------------- */ 
        /* --------------------------------- add more  ----------------------------- */ 
        /* ------------------------------------------------------------------------- */   
//       $(document).on('click','#NextBtn',function()
//        {
//           var is_valid =  $("#BtechRegularForm").valid();
//           var find_length =$(".BasicwizardTabs").find('.tab-pane.active').length;
//           if(!is_valid){
//            
//            $(".BasicwizardTabs").find('.tab-pane').removeClass('active');
//            $(".custom_nav").find('.nav-link').removeClass('active');
//            
//            $( ".BasicwizardTabs div:nth-child("+find_length+")" ).addClass('active');
//            $( ".custom_nav .nav-item:nth-child("+find_length+")").find('a').addClass('active');
//             
//            
//           }else{
//               find_length =find_length+1; 
//            $(".BasicwizardTabs").find('.tab-pane').removeClass('active');
//            $(".custom_nav").find('.nav-link').removeClass('active');
//            
//            $( ".BasicwizardTabs div:nth-child("+find_length+")" ).addClass('active');
//            $( ".custom_nav .nav-item:nth-child("+find_length+")").find('a').addClass('active');
//             
//            
//           }
//           
//        });
    
    
    
    
    
    
});

