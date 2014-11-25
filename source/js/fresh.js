var before_top;
var times = 0;
var start = 0;

$(document).ready(function(){
	$("#bjax-target").mousewheel(function(){
		var top = $(".row").offset().top;
		if(top != before_top)
			before_top = top;
		else if(before_top != 90){
			++times;
			if( times == 9 ){
				$.ajax({
					type: "post",
					data: {"start": start},
					url: "get.php",
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
						start += 3;
					}
				});
				console.log(top + " - " + before_top);
			}
		}
	});
});
