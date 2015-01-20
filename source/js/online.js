$.get("../server/online.server.php?uid="+get_cookie('uid')+"&logout=false",function(){});
setInterval(function() {
	$.ajax({
		url: "server/online.server.php",
		type: "GET",
		dataType: "JSON",
		data: {
			"uid": get_cookie('uid'),
		},
		success: function(data){
		}
	});			
}, 60000);
