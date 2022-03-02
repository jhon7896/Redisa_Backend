$(function(){
    $('#create_cate_id').on('change', categoryCreateChange);
    $('#update_cate_id').on('change', categoryUpdateChange);
});

function categoryCreateChange(){
    var cate_id = $(this).val();

    $.get('/api/category/'+cate_id+'/subcategories', function(data){
        var html_select = '<option value="0">Seleccione subcategoría</option>'
        for(var i=0;i<data.length;i++)
            html_select += '<option value="'+data[i].subc_id+'">'+data[i].subc_description+'</option>';
        $('#create_subc_id').html(html_select);
    });
}

function categoryUpdateChange(){
    var cate_id = $(this).val();

    $.get('/api/category/'+cate_id+'/subcategories', function(data){
        var html_select = '<option value="0">Seleccione subcategoría</option>'
        for(var i=0;i<data.length;i++)
            html_select += '<option value="'+data[i].subc_id+'">'+data[i].subc_description+'</option>';
        $('#update_subc_id').html(html_select);
    });
}
