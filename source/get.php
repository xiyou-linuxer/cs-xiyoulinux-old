<?php

require_once("./server/get.server.php");

function get_message($a, $start){
	$m = $a->get($start);

	if(!$m)
		return 'false';
	$result="<article class='comment-item'>
			<a class='pull-left thumb-sm avatar'>
				<img src='images/a9.png' alt='...'></a>
			<span class='arrow left'></span>
			<section class='comment-body panel panel-default'>
			<header class='panel-heading'>
			<a href='#'>".$m['name']."
			</a>
			<label class='label bg-red m-l-xs'>".$m['action']."</label>
			<span class='text-muted m-l-sm pull-right'> <i class='fa fa-clock-o'></i>
			".$m['time']."</span>
			</header>
			<div class='panel-body'>
			<h4>".$m['mdescribe']."</br>".$m['message']."</h4>
			<div class='line pull-in'></div></div>
			</section>
			</article>";

	return $result;
}

$start = $_POST['start'];
$result = "";
$a = new Get();
for($i = $start; $i < $start+3; ++$i){
	$result .= get_message($a, $i);
	if($result == 'false')
	break;
}
print $result;

?>
