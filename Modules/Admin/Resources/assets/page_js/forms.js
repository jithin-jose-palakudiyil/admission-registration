var url_prefix ='courses';
$(function() 
{  
    
    //copy cammand
    $('.clipboard').on('click', function()
    {
  
        var $temp = $("<input>");
        var $url=$(this).attr('data-url');
        $("body").append($temp);
        $temp.val($url).select();
        document.execCommand("copy");
        $temp.remove();
        $('.table_assign').find('.clipboard').removeClass('btn-purple');
        $('.table_assign').find('.clipboard').addClass('btn-purple');
        $(this).removeClass('btn-purple');
        $(this).addClass('btn-warning');
    
    });

/* ************************************************************************** */  
/* *************************** initialization ******************************* */  
/* ************************************************************************** */ 

    if($('#forms-datatable').length)
    {   
        
        var url=$('#forms-datatable').attr('data-url');
        $('#forms-datatable').DataTable
        ({
            processing: true,
            serverSide: true, 
            ajax: url,
            columns: [ 
                        {
                            data: "name", sortable: true,
                            render: function (data, type, full) {  return  full.name; } 
                        },   
                         
                        {
                            data: "slug", sortable: true,
                            render: function (data, type, full) {  return  full.slug; } 
                        },  
                        {
                            data: "created_at", sortable: true,
                            render: function (data, type, full) {  return  null; } 
                        }, 
            ] 
        }); 
//        
    }
    

});


