$(function(){
	
	//点赞
	$(".praise-btn").click(function(){
		
		target = $(this).data('url');
		$.get(target,function(result){
			
			if (result.code == 200) {
				$(".praise-box").html(result.data.praise);

			} else {
				alert(result.reason);
			}
		});
	});
	
	
});