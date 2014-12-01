$.get("server/online.server.php?uid="+get_cookie('uid')+"&time="+Math.ceil((new Date().getTime())/1000),function(){});
setInterval(function() {
	$.ajax({
		url: "server/online.server.php",
		type: "GET",
		dataType: "JSON",
		data: {
			"uid": get_cookie('uid'),
			"time": Math.ceil((new Date().getTime())/1000)
		},
		success: function(data){
		}
	});			
}, 60000);
