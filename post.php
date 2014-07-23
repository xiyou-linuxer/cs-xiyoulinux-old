<html>
	<head>
		<title>Post Message</title>
	</head>
	<body>
		<script type="text/javascript">
			function check() {
				var address=document.post_message.address.value;
				var title=document.post_message.title.value;
				var content=document.post_message.content.value;

				if( address=="" ) {
					alert("address is null");
					return false;
				}
				if ( title=="" ) {
					alert("title is null");
					return false;
				}
				if ( content=="" ) {
					alert("content is null");
					return false;
				}
				return true;
			}
		</script>
		<form name="post_message" method="post" action="post_message.php">
			收件人
			<input type="text" name="address" />
			<br />
			主题
			<input type="text" name="title" />
			<br />
			正文
			<input type="text" name="content" />
			<br />
			<input type="submit" name="Submit" onclick="return check()" value="POST" />
		</form>
	</body>
</html>
