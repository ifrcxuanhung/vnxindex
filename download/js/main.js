$(document).ready(function(){
    
    $("input[name='excute_query']").click(function(){
        var query = $('p.result_query').html();
        $.ajax({
			url: BASE_URL + 'ajax.php',
			type:'post',
			data:{query:query, act:'action1'},
			success:function(data){
                try {
                    var result = jQuery.parseJSON(data);
    				name_file = result.name_file;
                    link_file = result.link_file;
                    $('.view_file_download').prepend("<li><a href='"+link_file+"'>"+name_file+"</a></li>");
                } catch (e) {
                    alert(data);
                    return false;
                }
			}
		});	
    });
});

function updateQueryToResult(query)
{
    var result_query = $('.result_query');
    if(query != "")
        result_query.fadeIn();
    else
        result_query.fadeOut();
    $('.result_query').html(query);
}