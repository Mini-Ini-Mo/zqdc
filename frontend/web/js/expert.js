$(function(){
	
	//点赞
	$(".praise-btn").click(function(){
		
		target = $(this).data('url');
		$.get(target,function(result){
			
			if (result.code == 200) {
				location.reload();
			} else {
				alert(result.reason);
			}
		});
	});
	
	
	
});