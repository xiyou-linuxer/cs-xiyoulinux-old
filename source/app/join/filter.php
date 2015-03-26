<?php
function daddslashes($string, $force = 1) {
	if (is_array($string)) {
		$keys = array_keys($string);
		foreach ($keys as $key) {
			$val = $string[$key];
			unset($string[$key]);
			$string[addslashes($key)] = daddslashes($val, $force);
		}
	} else {
		$string = htmlspecialchars(addslashes(trim($string)));
	}
	return $string;
}
$_GET = daddslashes($_GET);
$_POST = daddslashes($_POST);
$_REQUEST = daddslashes($_REQUEST);
$_COOKIE = daddslashes($_COOKIE);
preg_match("/\d+/", $_POST["schoolnum"], $t);
$schoolnum = $t[0];
preg_match("/[\x{4e00}-\x{9fa5}]+/u", $_POST["name"], $t);
$name = $t[0];
preg_match("/\d+/", $_POST["tel"], $t);
$tel = $t[0];
preg_match("/[\x{4e00}-\x{9fa5}]+/u", $_POST["class"], $t1);
$class = $t1[0];
preg_match("/\d+/", $_POST["class"], $t2);
$class .= $t2[0];
$password = $_POST["password"];
?>