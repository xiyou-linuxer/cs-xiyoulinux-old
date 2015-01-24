<?php
require_once('server/fresh.server.php');

$a  = new GetArt();
for($i = 0; $i < 10; ++$i){
	$tmp = $a->get("index", $i);
	if($tmp == false)
		break;
	$Dynamics_array[] = $tmp;
}

$tpl->assign( "Dynamics_array", $Dynamics_array );

?>
