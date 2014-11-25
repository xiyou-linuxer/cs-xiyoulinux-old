setInterval(function() {
	$.ajax({
		url: "server/online.php",
		type: "GET",
		dataType: "JSON",
		data: {
			"uid": get_cookie('uid'),
			"time": new Date().getTime()
		},
		success: function(data){
		}
	});			
}, 5000);
