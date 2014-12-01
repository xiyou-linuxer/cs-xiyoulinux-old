<?php

require_once("/usr/share/nginx/html/cs/server/fresh.server.php");

function get_message($a, $mid, $start){
	$m = $a->get("mid", $mid, $start);

	if(!$m)
		return 'false';
	$result="<article class='comment-item' mid=" . $m['mid']  . ">
			<a class='pull-left thumb-sm avatar'>
				<img src='" . $m['avatar']  . "' alt='...'></a>
			<span class='arrow left'></span>
			<section class='comment-body panel panel-default'>
			<header class='panel-heading'>
			<a href='" . $m['profile']  . "'>".$m['name']."
			</a>
			<label class='label " . $m['actioncolor']  . " m-l-xs'>" . $m['actiontext'] . "</label>
			<span class='text-muted m-l-sm pull-right'> <i class='fa fa-clock-o'></i>
			".$m['time']."</span>
			</header>
			<div class='panel-body'>
			<h4><a href=".$m['href'].">".$m['mdescribe']."</a></h4>
			<div class='panel-body'><blockpanel-bodyquote><p>".$m['message']."</p></blockquote></div>
			</div>
			</section>
			</article>";

	return $result;
}

$mid = $_POST['mid'];
$result = "";
$a = new GetArt();

for($i = 0; $i < 5; ++$i){
	$b = get_message($a, $mid, $i);
	if($b == 'false'){
		if($result == "")
			$result = 'false';
		break;
	}
	$result .= $b;
}
print $result;
?>
