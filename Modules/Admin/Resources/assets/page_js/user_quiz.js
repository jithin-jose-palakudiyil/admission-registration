var url_prefix ='users-quiz';
var table=$('#users-quiz-datatable');

$(function() 
{  
    
$('#exam_id').val('')
    
/* ************************************************************************** */  
/* *************************** initialization ******************************* */  
/* ************************************************************************** */ 

    if($('#users-quiz-datatable').length)
    {   
        
        var url=$('#users-quiz-datatable').attr('data-url');
        $('#users-quiz-datatable').DataTable
        ({
      
            processing: true,
            serverSide: true, 
            ajax: url,
            columns: [ 
                        {
                            data: "name", sortable: true,
                            render: function (data, type, full) {  return  full.get_user.name; } 
                        },  
                        
                        {
                            data: "email", sortable: true,
                            render: function (data, type, full) {  return  full.get_user.email; } 
                        },  

                        {
                            data: "mobile", sortable: true,
                            render: function (data, type, full) {  return  full.get_user.mobile; } 
                        },  

                        {
                            data: "quiz_name", sortable: true,
                            render: function (data, type, full) {  return  full.get_quiz.name; } 
                        },
                        {
                            data: "null", sortable: false,  
                            render: function (data, type, full) 
                            { 
                                if(full.tenth_mark_list == null || full.plus_one_mark_list==null)  { return '<button type="button" disabled class="btn btn-danger waves-effect waves-light">Pending</button>';  }
                                else  { return '<button type="button" disabled class="btn btn-success waves-effect waves-light">Uploded</button>';  }
                            } 
                        },
                        {
                            data: "status", sortable: true,  
                            render: function (data, type, full) 
                            { 
                                if(full.quiz_status=="0" || full.quiz_status=="2")  { return '<button type="button" disabled class="btn btn-danger waves-effect waves-light">In progress</button>';  }
                                else  { return '<button type="button" disabled class="btn btn-success waves-effect waves-light">Completed</button>';  }
                            } 
                        }, 
                        {
                            data: "null","searchable": false, sortable: false,
                            render: function (data, type, full)
                            {   
                                var delete_button ='onclick="return Delete('+full.id+')"';
                                var show_url=base_url+'/'+admin_prefix+'/'+url_prefix+'/'+full.id+'/show';

                                var  u = '<div class="btn-group" role="group" aria-label="Basic example">'+
                                        '<a class="text-center" href="'+show_url+'"><button type="button" class="btn btn-sm btn-light waves-effect"><i class="mdi mdi-eye font-18"></i></button></a> &nbsp;'+
                                      '</div>';                     

                                
                                return u;
                            } 
                        }
            ] 
        }); 
//        
    }
    


     
});


//Filter on submit


$('#filter_form').on('submit', function(e){
    e.preventDefault();
    $('#filter_error_container').hide();
    var url=base_url+'/admin/all-user-quiz-list-filtered';  

    var data = {
        exam_id:$('#exam_id').val(),  
        exam_status: $('#exam_status').val(),
        document: $('#document').val()
    }
    $.ajax({
        type: "GET",
        url: url,
        dataType: "json",
        async: false,
        headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: data,
        success: function(response){
            {   

                $('.default-count-area').hide();
                $('.filter-count-area').show()
                document.getElementById("filter_total_exam_count").innerHTML = response.totalExams;
                document.getElementById("filter_completed_exam_count").innerHTML = response.filterCompleted;
                document.getElementById("filter_incompleted_exam_count").innerHTML = response.filterInProgress;

                table.DataTable().clear().destroy();
                table.dataTable(
                   {
                    processing: true,
                    // "scrollX": true,
                    "order": [[ 0, 'desc' ]],
                    responsive: true,
                    columns: [ 
                        {
                            data: "name", sortable: true,
                            render: function (data, type, full) {  return  full.get_user.name; } 
                        },  
                        
                        {
                            data: "email", sortable: true,
                            render: function (data, type, full) {  return  full.get_user.email; } 
                        },  

                        {
                            data: "mobile", sortable: true,
                            render: function (data, type, full) {  return  full.get_user.mobile; } 
                        },  

                        {
                            data: "quiz_name", sortable: true,
                            render: function (data, type, full) {  return  full.get_quiz.name; } 
                        },
                         {
                            data: "null", sortable: false,  
                            render: function (data, type, full) 
                            { 
                                if  (
                                        full.get_user.tenth_mark_list != null ||
                                        full.get_user.plus_one_mark_list!=null ||
                                        full.get_user.plus_two_mark_list!=null ||
                                        full.get_user.iti_diploma_mark_list!=null 
                                    )  { return '<button type="button" disabled class="btn btn-success waves-effect waves-light">Uploded</button>';    }
                                else  { return '<button type="button" disabled class="btn btn-danger waves-effect waves-light">Pending</button>'; }
                            } 
                        },
                        {
                            data: "status", sortable: true,  
                            render: function (data, type, full) 
                            { 
                                if(full.quiz_status=="0" || full.quiz_status=="2")  { return '<button type="button" disabled class="btn btn-danger waves-effect waves-light">In progress</button>';  }
                                else  { return '<button type="button" disabled class="btn btn-success waves-effect waves-light">Completed</button>';  }
                            } 
                        }, 
                        {
                            data: "null","searchable": false, sortable: false,
                            render: function (data, type, full)
                            {   
                                var delete_button ='onclick="return Delete('+full.id+')"';
                                var show_url=base_url+'/'+admin_prefix+'/'+url_prefix+'/'+full.id+'/show';

                                var  u = '<div class="btn-group" role="group" aria-label="Basic example">'+
                                        '<a class="text-center" href="'+show_url+'"><button type="button" class="btn btn-sm btn-light waves-effect"><i class="mdi mdi-eye font-18"></i></button></a> &nbsp;'+
                                      '</div>';                     

                                
                                return u;
                            } 
                        }
                    ] 
                   } 
                ).fnAddData(response.data);

            }
        },
        error: function (request, status, error) {
            $('#filter_error_container').show();
            document.getElementById("filter_error").innerHTML = request.responseJSON.msg;  
        }
    })

    return false;
});



//download csv


$('#download_data').on('click', function(e){
    e.preventDefault();
    var url=base_url+'/admin/download-filtered-user-quiz-excel';  
     var exam_id = $('#exam_id').val();  
     var exam_status = $('#exam_status').val();
     var document= $('#document').val();
     
    if(exam_id == '' && exam_status == '' && document == ''){
        $('#filter_error').html("Please enter a filter criteria to download !");
        $('#filter_error_container').show();
       
        return;
    }
    else{
        if(exam_id == ''){  exam_id = 'no_exam_id' }
        if(exam_status == ''){ exam_status = 'no_exam_status' }
        if(document == ''){ document = 'no_document' }
        $('#filter_error_container').hide();
        location.href = base_url+'/admin/download-filtered-user-quiz-excel'+'/'+exam_id+'/'+exam_status+'/'+document
    }
     
    return false;
});




//Datatable reset


$("#reset").click(function(e){
    e.preventDefault();
    $('#filter_error_container').hide()
    $('.filter-count-area').hide()
    $('.default-count-area').show();
    $('#exam_id').val('')
    $('#exam_status').val('')
    $('#document').val('')

    table.DataTable().clear().destroy();
    
    if(table.length)
    {   
        var url=table.attr('data-url');
        table.DataTable
        ({
            processing: true,
            // "scrollX": true,
            responsive: true,
            serverSide: true, 
            ajax: url,
            columns: [ 
                {
                    data: "name", sortable: true,
                    render: function (data, type, full) {  return  full.get_user.name; } 
                },  
                
                {
                    data: "email", sortable: true,
                    render: function (data, type, full) {  return  full.get_user.email; } 
                },  

                {
                    data: "mobile", sortable: true,
                    render: function (data, type, full) {  return  full.get_user.mobile; } 
                },  

                {
                    data: "quiz_name", sortable: true,
                    render: function (data, type, full) {  return  full.get_quiz.name; } 
                },
                 {
                            data: "null", sortable: false,  
                            render: function (data, type, full) 
                            { 
                                if(full.tenth_mark_list == null || full.plus_one_mark_list==null)  { return '<button type="button" disabled class="btn btn-danger waves-effect waves-light">Pending</button>';  }
                                else  { return '<button type="button" disabled class="btn btn-success waves-effect waves-light">Uploded</button>';  }
                            } 
                        },
                {
                    data: "status", sortable: true,  
                    render: function (data, type, full) 
                    { 
                        if(full.quiz_status=="0" || full.quiz_status=="2")  { return '<button type="button" disabled class="btn btn-danger waves-effect waves-light">In progress</button>';  }
                        else   { return '<button type="button" disabled class="btn btn-success waves-effect waves-light">Completed</button>';  }
                    } 
                }, 
                {
                    data: "null","searchable": false, sortable: false,
                    render: function (data, type, full)
                    {   
                        var delete_button ='onclick="return Delete('+full.id+')"';
                        var show_url=base_url+'/'+admin_prefix+'/'+url_prefix+'/'+full.id+'/show';

                        var  u = '<div class="btn-group" role="group" aria-label="Basic example">'+
                                '<a class="text-center" href="'+show_url+'"><button type="button" class="btn btn-sm btn-light waves-effect"><i class="mdi mdi-eye font-18"></i></button></a> &nbsp;'+
                              '</div>';                     

                        
                        return u;
                    } 
                }
            ] 
        });   
    }
    return false;
})







function Delete(id)
    {  
         
        
          
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ml-2 mt-2",
                buttonsStyling: !1
            }).then(function(t) 
            { 
                if(t.value == true)
                { 
                    var url=base_url+'/'+admin_prefix+'/'+url_prefix+'/'+id;  
                    $.ajax
                    ({
                       type: 'DELETE',
                        url: url,
                        dataType: "json",
                        async: false,
                        headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data :{'application':id},
                        success: function(response){  window.location.reload(); },
                        error: function (request, textStatus, errorThrown)  {  }
                    }); 
                    
                } 
            })
         
                          

 
         
}
