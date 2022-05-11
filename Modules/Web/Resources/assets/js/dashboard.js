var a = false;
var b = false;
var global_seconds_end = 0;
var global_seconds_start = 0;


$(function() 
{ 
    localStorage.clear();
})

$(function() 
{ 
    // if(localStorage.getItem('exam_status')){ return;}
    var url=base_url+'/get-exam-end-time/';  
    let exam_end_time = null;
    let server_time = null;

    $.ajax
    ({
            type: 'GET',
            url: url,
            dataType: "json",
            async: false,
            headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response)
            {  
                var obj =  $.parseJSON(JSON.stringify(response)); 
                if(obj.status)
                {
                    exam_end_time = obj.exam_end_time
                    server_time = obj.server_time;

                    a = true;
                }

            },  error: function (request, textStatus, errorThrown)  {a = true; }
        });  
            a = true;
            if(exam_end_time == null) {
                return;
            }

            
            var countDownDate = new Date(`${exam_end_time}`).getTime();

            var x = setInterval(function() {

            // d = new Date();
            // utc = d.getTime() + (d.getTimezoneOffset() * 60000);
            // nd = new Date(utc + (3600000*+5.5));
            // splitted_time = nd.toString().split(" ");
            // time = splitted_time[1]+" "+splitted_time[2]+" "+splitted_time[3]+" "+splitted_time[4];
            var now_ = new Date(`${server_time}`);
            global_seconds_end=global_seconds_end+1;
            var now = now_.setSeconds(now_.getSeconds() + global_seconds_end);

            var distance = countDownDate - now;
        
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);


            let totalTime = parseInt(days) + parseInt(hours) + parseInt(minutes) + parseInt(seconds)
                

            if(totalTime<1) {
                $(".buttonEnabled").remove();
                $(".time_completed_badge").remove();
                $(".time_complete_button").html(`<button href="#" style="background: #fb0000; border: none;color:white; min-width: 390px" disabled class="btn btn-block goToQuizButton" type="button"> Sorry ! The exam is over </button>`);
            }

            if (distance < 1) {
                clearInterval(x);
            }
            }, 1000);

});  


//Timer


$(function() 
{ 
    // if(localStorage.getItem('timer_status')){ $('#timer_active_area').hide();  $('#timer_disabled_area').show();    return;}
    var url=base_url+'/exam-start-time-get/';  
    let exam_start_time = null;
    let server_time = null;

    $.ajax
    ({
        
            type: 'GET',
            url: url,
            dataType: "json",
            async: false,
            headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response)
            {  
                var obj =  $.parseJSON(JSON.stringify(response)); 
                if(obj.status)
                {
                    exam_start_time = obj.exam_start_time
                    // $("#loader-spinner").hide();
                    server_time = obj.server_time;
                    $("#some_div").show();
                    b=true;
                }

            },  error: function (request, textStatus, errorThrown)  {b=true;}
        });  

                b=true;
            if(exam_start_time == null) {
                $('#timer_active_area').hide();  
                $('#timer_disabled_area').show();
                return;
            }
            var countDownDate = new Date(`${exam_start_time}`).getTime();

            var x = setInterval(function() {

            // d = new Date();
            // utc = d.getTime() + (d.getTimezoneOffset() * 60000);
            // nd = new Date(utc + (3600000*+5.5));
            // splitted_time = nd.toString().split(" ");
            // time = splitted_time[1]+" "+splitted_time[2]+" "+splitted_time[3]+" "+splitted_time[4];
            var now_ = new Date(`${server_time}`);
            global_seconds_start=global_seconds_start+1;
            var now = now_.setSeconds(now_.getSeconds() + global_seconds_start);
            var distance = countDownDate - now;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if(days<1){
                days = '0' + days
            }

            if(hours<10){
                hours = '0' + hours
            }

            if(minutes<10){
                minutes = '0' + minutes
            }

            if(seconds<10){
                seconds = '0' + seconds
            }

            let totalTime = parseInt(days) + parseInt(hours) + parseInt(minutes) + parseInt(seconds)
            
            document.getElementById("some_div").innerHTML = `<span class="exam_starts_text">Exam Starts in</span><p>${days}d</p> : <p>${hours}h</p> : <p>${minutes}m</p> : <p>${seconds}s</p>`;


            if(totalTime<1) {
                // localStorage.setItem('timer_status', 'finished')
                $("#some_div").hide()
                $('#timer_active_area').hide()
                $('#timer_disabled_area').show()
            }else if(totalTime>0){
                $('#timer_active_area').show();  
                $('#timer_disabled_area').hide();
            }

            if (distance < 1) {
                clearInterval(x);
            }
            }, 1000);

});  


$(function(){
    if(a && b) {
        $("#loader-spinner").hide();
    }
})


