<?php
require(dirname(dirname(dirname(__FILE__))) . '/config.php');
require(dirname(__FILE__) . "/includes/lecture.class.php");
require_once(BASE_PATH . "/includes/db.class.php");
require_once(BASE_PATH . "/includes/user.class.php");

if (!isset($_POST["action"])) {
	exit;
}

session_start();

if(!isset($_SESSION['uid']) ) {
    exit;
}

$action = $_POST["action"];

switch ($action) {
	case 'add':
		echo add();
		exit();
	case 'del':
		echo del();
		exit();
	case 'update':
		echo update();
		exit();
	case 'get_info':
		echo get_info();
		exit();
	
	default:
		exit();
}

/*  添加讲座
	返回值：
	1	成功
	0	失败
	-1	信息不全
*/

function add() {
	if ($_POST['title'] == ""
		|| $_POST['time'] == ""
		|| $_POST['location'] == "") {
		return "-1";
	}
	
	$lecture_inc = new LectureClass();
	$result = $lecture_inc->add_lecture($_SESSION['uid'], $_POST['title'], $_POST['time'], $_POST['location'], $_POST['tag'], $_POST['description'], $_POST['slide']);
	return $result;
}

/*  删除讲座
	返回值：
	1	成功
	0	失败
	-1	信息不全
	-2	讲座不存在
	-3	无权限删除
*/

function del() {
	if ($_POST['lid'] == "") {
		return "-1";
	}
	
	$db = new DBClass();
	$sql = "SELECT uid FROM `app_lecture_info` WHERE lid = ".$_POST['lid'];
	$result = $db->query($sql);
	if( $result->num_rows <= 0 ) {
		return "-2";
	} else {
		$row = $result->fetch_assoc();
		$userObj = new UserClass();
		$permisson = $userObj->get_privilege($_SESSION['uid']);
		if ($_SESSION['uid'] != $row["uid"] && $permisson != '1') {
			return "-3";
		}
	}
	
	$lecture_inc = new LectureClass();
	$result = $lecture_inc->del_lecture($_POST['lid']);
	return $result;
}

/*  编辑讲座
	返回值：
	1	成功
	0	失败
	-1	信息不全
	-2	讲座不存在
	-3	无权限编辑
*/

function update() {
	if ($_POST['lid'] == ""
		|| $_POST['title'] == ""
		|| $_POST['time'] == ""
		|| $_POST['location'] == "") {
		return "-1";
	}
	
	$db = new DBClass();
	$sql = "SELECT uid FROM `app_lecture_info` WHERE lid = ".$_POST['lid'];
	$result = $db->query($sql);
	if( $result->num_rows <= 0 ) {
		return "-2";
	} else {
		$row = $result->fetch_assoc();
		$userObj = new UserClass();
		$permisson = $userObj->get_privilege($_SESSION['uid']);
		if ($_SESSION['uid'] != $row["uid"] && $permisson != '1') {
			return "-3";
		}
	}
	
	$lecture_inc = new LectureClass();
	$result = $lecture_inc->update_lecture($_POST['lid'], $_POST['title'], $_POST['time'], $_POST['location'], $_POST['tag'], $_POST['description'], $_POST['slide']);
	return $result;
}


/*  获取讲座信息
	返回值：
	-1	信息不全
	0	讲座不存在
*/

function get_info() {
	if ($_POST['lid'] == "") {
		return "-1";
	}
	
	$lecture_inc = new LectureClass();
	$result = $lecture_inc->get_lecture_info($_POST['lid']);

	if ($result == 0) return 0;
	return json_encode($result);
}

?>