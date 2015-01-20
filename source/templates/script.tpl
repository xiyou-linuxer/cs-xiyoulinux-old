</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
</section>
</section>
</section>
</section>

<script type="text/javascript" src="<{$SITE_DOMAIN}>/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script type="text/javascript" src="<{$SITE_DOMAIN}>/js/bootstrap.js"></script>

<!-- App -->
<script type="text/javascript" src="<{$SITE_DOMAIN}>/js/app.js"></script>
<script type="text/javascript" src="<{$SITE_DOMAIN}>/js/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="<{$SITE_DOMAIN}>/js/app.plugin.js"></script>
<script type="text/javascript" src="<{$SITE_DOMAIN}>/js/cookie.js"></script>
<script type="text/javascript" src="<{$SITE_DOMAIN}>/js/login.js"></script>

//online
<script type="text/javascript">

	$.get("<{$SITE_DOMAIN}>/server/online.server.php?uid="+get_cookie('uid')+"&logout=false",function(){});
	setInterval(function() {
		$.ajax({
			url: "<{$SITE_DOMAIN}>/server/online.server.php",
			type: "GET",
			dataType: "JSON",
			data: {
				"uid": get_cookie('uid'),
			},
			success: function(data){
                        console.log(data);
			}
		});			
	}, 60000);

        $('.update-num').each(function() {
                var elem = $(this);
                var func_url = elem.data('funcurl') + '?func=cal_num';
                $.get(func_url, function(data) {
                        if (data == '0') {
                                elem.remove();
                        } else {
                                elem.html(data);
                        }
                });
        });
</script>
