<?php
require_once('server/fresh.server.php');

$script_list = array(
	'js/fresh.js'
);
$tpl->assign('script_list', $script_list);
	
$a  = new GetArt();
for($i = 0; $i < 5; ++$i){
	$tmp = $a->get("index", $i);
	if($tmp == false)
		break;
	$Dynamics_array[] = $tmp;
}

$tpl->assign( "Dynamics_array", $Dynamics_array );

?>
