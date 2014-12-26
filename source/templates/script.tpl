</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
</section>
</section>
</section>
</section>

<script type="text/javascript" src="js/jquery.min.js"></script>

<!-- Bootstrap -->
<script type="text/javascript" src="js/bootstrap.js"></script>

<!-- App -->
<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript" src="js/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="js/app.plugin.js"></script>
<script type="text/javascript" src="js/cookie.js"></script>
<script type="text/javascript" src="js/login.js"></script>

//online
<script type="text/javascript">
	$.get("<{$SITE_DOMAIN}>/server/online.server.php?uid="+get_cookie('uid')+"&logout=false",function(){});
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
</script>