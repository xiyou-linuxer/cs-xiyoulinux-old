<?php
require_once(dirname(__FILE__) . '/includes/user.class.php');

if (!isset($_SESSION['uid'])) {
    exit;
}

$uid = $_SESSION['uid'];
$userObj = new UserClass();
$permisson = $userObj->get_privilege($uid);

if($permisson != '1') {
    header('location: index.php');
}

?>
