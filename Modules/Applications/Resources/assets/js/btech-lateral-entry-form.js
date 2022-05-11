

$(function() {
   
    "use strict";
    $("#basicwizard").bootstrapWizard({
            onNext: function (t, r, a) {
                    var find_id =$(".BasicwizardTabs").find('.tab-pane.active').attr('id'); 
                    var tab = $("#"+find_id); 
                    var error =true;
                    if(find_id=='basictab1'){
                        var gender = $("#gender").val();
                        $("#gender_error").html('');
                        if(gender==''){ 
                            error=false;
                            var gender_error= '<label id="gender-error" class="invalid-feedback" for="gender" style="display: inline-block;">This field is required.</label>';
                            $("#gender_error").html(gender_error);
                        }
                        
                        var category = $("#category").val();
                        $("#category_error").html('');
                        if(category==''){ 
                            error=false;
                            var category_error= '<label id="category-error" class="invalid-feedback" for="gender" style="display: inline-block;">This field is required.</label>';
                            $("#category_error").html(category_error);
                        }
                        
                         var permanent_address =$("#permanent_address").val().trim() ; 
                        $("#permanent_address_error").html('');
                        if(permanent_address.length==0){ 
                            error=false;
                            var permanent_address_error= '<label id="permanent_address-error" class="invalid-feedback" for="gender" style="display: inline-block;">This field is required.</label>';
                            $("#permanent_address_error").html(permanent_address_error);
                        }
                        
                    }
                     
                    
                    if(find_id=='basictab4'){ 
                        $(".AhrefNextBtn").html('submit');
                    }
                    else{
                         if(find_id=='basictab5'){
//                            var category_1 = $("#category_1").val();
//                            $("#category_1_error").html('');
//                            if(category_1==''){ 
//                                error=false;
//                                var category_1_error= '<label id="category_1_error-error" class="invalid-feedback" for="gender" style="display: inline-block;">This field is required.</label>';
//                                $("#category_1_error").html(category_1_error);
//                            }
                            
                            var course_1 = $("#course_1").val();
                            $("#course_1_error").html('');
                            if(course_1==''){ 
                                error=false;
                                var course_1_error= '<label id="course_1_error-error" class="invalid-feedback" for="gender" style="display: inline-block;">This field is required.</label>';
                                $("#course_1_error").html(course_1_error);
                            }
                            $("#I_agree_error").html('');
                             if($("#I_agree").prop("checked") == false){
                                var I_agree_error= '<label id="I_agree_error-error" class="invalid-feedback" for="gender" style="display: inline-block;">This field is required.</label>';
                                $("#I_agree_error").html(I_agree_error);
                                error=false;   
                            }
            
                            $(".AhrefNextBtn").html('submit');
                         }else{
                            $(".AhrefNextBtn").html('Next');
                         }
                         
                         
                        
                        
                    }
                    var valid = true;
                    $('input', tab).each(function(i, v){
                        
                             valid = validators.element(v) && valid;
                       
                       
                    });

                    if(!valid){
                       
                       
                           return event.preventDefault(), event.stopPropagation(), !1;   
                        
                            
                    }else{
                        if(!error){
                         return event.preventDefault(), event.stopPropagation(), !1;      
                        }else{
                           if(find_id=='basictab5'){
                                $("#BtechRegularForm").submit();
                            } 
                        }
                        
                    }
            },onPrevious:function (t, r, a) {
                    var find_id =$(".BasicwizardTabs").find('.tab-pane.active').attr('id'); 
                    var tab = $("#"+find_id);  
                    if(find_id=='basictab4'){ 
                        $(".AhrefNextBtn").html('submit');
                    }
                    else{
                        $(".AhrefNextBtn").html('Next');
                    }
            }
        });

//if($("#basicwizard").length) { $("#basicwizard").bootstrapWizard({}); }

 
if($("#date_of_birth").length) { $("#date_of_birth").datepicker();  }

 
if($("#mobile").length)
{
     $("#mobile").intlTelInput
     ({
         initialCountry: 'in',localizedCountries:'in',
         separateDialCode: false,
         nationalMode: false,
         allowDropdown: false, 
           autoHideDialCode: true,
//      autoPlaceholder:false,
        customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
            return "Mobile No" ;
        },
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
         autoHideDialCode: true,
//          autoPlaceholder:false,
         customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
    return "Fathers Mobile No" ;
  },
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
        autoHideDialCode: true,
//      autoPlaceholder:false,
        customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
            return "Mother's Mobile No" ;
        },
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
          autoHideDialCode: true,
//      autoPlaceholder:false,
        customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
            return "Guardian's Mobile No" ;
        },
         utilsScript: base_url+"/public/plugins/intlTelInput/utils.js" // just for formatting/placeholders etc
     });
}

        /* ------------------------------------------------------------------------- */ 
        /* -------------------------- form validate -------------------------------- */ 
        /* ------------------------------------------------------------------------- */
     var validators =   $("#BtechRegularForm").validate({ 
//        ignore: 'input[type=hidden]', // ignore hidden fields
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
                    'mobile':{required:true, normalizer: function(value) { return $.trim(value);  }, 'chkMobile':true },
                    'photo' :   {required:true,fileType: { types: ["jpg", "jpeg", "png"] }, maxFileSize: { "unit": "MB",  "size": 2  }, }, 
                    'signature_applicant' :   {required:true,fileType: { types: ["jpg", "jpeg", "png"] }, maxFileSize: { "unit": "MB",  "size": 2  }, }, 
                    'date_of_birth':{required:true, normalizer: function(value) { return $.trim(value);  }},
                    'age':{required:true, normalizer: function(value) { return $.trim(value);  },number: true },
//                    'gender':{required:true, normalizer: function(value) { return $.trim(value);  }  },
                    'nationality':{required:true, normalizer: function(value) { return $.trim(value);  } },
                    'religion':{required:true, normalizer: function(value) { return $.trim(value);  } },
                    'community':{required:true, normalizer: function(value) { return $.trim(value);  } },
//                    'category':{required:true, normalizer: function(value) { return $.trim(value);  } },
                    'blood_group':{required:true, normalizer: function(value) { return $.trim(value);  } },
                    'aadhar_number':{required:true, normalizer: function(value) { return $.trim(value);  } },
                    'permanent_address':{required:true, normalizer: function(value) { return $.trim(value);  } },
                    'address_communication':{required:true, normalizer: function(value) { return $.trim(value);  } },
                    
                    'father_name':{required:true, normalizer: function(value) { return $.trim(value);  } },
                    'father_occupation':{required:true, normalizer: function(value) { return $.trim(value);  } },
                    'father_mobile':{normalizer: function(value) { return $.trim(value);  }, 'chkMobile':true },
                    'mother_name':{required:true, normalizer: function(value) { return $.trim(value);  } },
                    'mother_occupation':{required:true, normalizer: function(value) { return $.trim(value);  } },
                    'mother_mobile':{normalizer: function(value) { return $.trim(value);  }, 'chkMobile':true },
                    'signature_parent' :   {required:true,fileType: { types: ["jpg", "jpeg", "png"] }, maxFileSize: { "unit": "MB",  "size": 2  }, }, 
                    'annual_family_income':{required:true, normalizer: function(value) { return $.trim(value);  },number:true },
                    'guardian_mobile':{normalizer: function(value) { return $.trim(value);  }, 'chkMobile':true },
                    
                    'last_institution':{required:true, normalizer: function(value) { return $.trim(value);  } },
                    'register_no':{required:true, normalizer: function(value) { return $.trim(value);  } },
                    'month_year_passing':{required:true, normalizer: function(value) { return $.trim(value);  } },
                    'diploma_mark':{required:true, normalizer: function(value) { return $.trim(value);  },number: true },
                    'diploma_percentage':{required:true, normalizer: function(value) { return $.trim(value);  },number: true },
                    'plus2_mark':{ normalizer: function(value) { return $.trim(value);  },number: true },
                    'sslc_mark':{required:true, normalizer: function(value) { return $.trim(value);  },number: true },
                    'diploma_mark_list' :   {required:true,fileType: { types: ["jpg", "jpeg", "png"] }, maxFileSize: { "unit": "MB",  "size": 2  }, }, 
                    'plus_two_mark_list' :   {fileType: { types: ["jpg", "jpeg", "png"] }, maxFileSize: { "unit": "MB",  "size": 2  }, }, 
                    'sslc_mark_list' :   {required:true,fileType: { types: ["jpg", "jpeg", "png"] }, maxFileSize: { "unit": "MB",  "size": 2  }, }, 
                    
                    'place':{required:true, normalizer: function(value) { return $.trim(value);  } },
                 } 
        });
        
     
               
//        $.validator.addMethod("check_item_dropdown", function(value, element) {  
//            alert('s');
//    return this.optional(element) || value != 'null'  ;   
//    }, "Please select an item from the dropdown list.");
    
//        $.validator.addMethod('selectcheck', function (value) {
//            return (value == 'select');
//        }, "year required");
 

        /*email validation*/
        $.validator.addMethod("chkEmail", function(value, element) 
        {   
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value))
            { return true;  } 
            else  {  $.validator.messages.chkEmail = 'Please enter a valid email address';  return false; }
        }, $.validator.messages.chkEmail );
        /* email validation end */
        
        
        
        /* Mobile validation */
        $.validator.addMethod("chkMobile", function(value, element) 
        {  
            if(value!=''){  
                var intlNumbers = $("#"+element.id).intlTelInput("getNumber");    

                $("#"+element.id).intlTelInput("setNumber", intlNumbers);
                var valid= $("#"+element.id).intlTelInput("isValidNumber"); 
                if(valid){return true;}
                else { $.validator.messages.chkMobile='Please enter a valid mobile number.'; return false; }
            } else {return true;}
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
    
        $(document).on('change','.category_change',function()
        {
            var courses_category_id =$(this).val();
            var append = $(this).attr("data-append"); 
            courses_category_colleges(courses_category_id,college_id,append);
            
        });
    
    
    
    
});

function courses_category_colleges(courses_category_id,college_id=null,append=null)
{
            
    var url=base_url+'/'+application_prefix+'/get_courses_category_colleges/';  
    $.ajax
    ({
       type: 'GET',
        url: url,
        dataType: "json",
        async: false,
        headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data :{'college_id':college_id,'courses_category_id':courses_category_id},
        success: function(response){  
           var obj =  $.parseJSON(JSON.stringify(response)); 
           if(obj.option) { 
            $('#'+append).html(obj.option);
           }


            },
        error: function (request, textStatus, errorThrown)  {  }
    });
                    
}