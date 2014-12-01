var times = 0;

$(document).ready(function(){
	$('#bjax-target').scroll(function(){
		viewH = $(this).height();
		contentH = $(this).get(0).scrollHeight;
		scrollTop = $(this).scrollTop();
		if ((contentH - viewH - scrollTop <= 100) || (contentH - viewH < scrollTop)){
			++times;
			if( times == 1 ){
				var mid = $(".comment-item:last").attr("mid");
				$.ajax({
					type: "post",
					data: {"mid": mid},
					url: "server/fresh.asy.php",
					success: function(data){
						if( data.substr(0,5) != 'false'){
							$(".comment-item:last").after(data);
							$(".comment-item:last").hide();
							$(".comment-item:last").prev().hide();
							$(".comment-item:last").prev().prev().hide();					
							$(".comment-item:last").slideDown();
							$(".comment-item:last").prev().slideDown();
							$(".comment-item:last").prev().prev().slideDown();			
						}
						times = 0;
					}
				});
			}
		}	
	});
});
