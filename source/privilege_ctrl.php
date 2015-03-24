<?php
require_once(dirname(__FILE__) . '/includes/user.class.php');

if (!isset($_SESSION['uid'])) {
    exit;
}

$userObj = new UserClass();
$permisson = $userObj->get_privilege($_SESSION['uid']);
if($permisson != '1') {
	echo '<script type="text/javascript">javascript:history.back(1);</script>';
    //header('location: ' . $_SERVER["HTTP_REFERER"]);
    exit;
}

?>
