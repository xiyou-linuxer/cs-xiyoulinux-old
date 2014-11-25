<?php

chdir(dirname(__FILE__));
require_once("../inc/conn.php");

class Get{
	private $conn;

	public function __construct(){
		$this->conn = new Csdb();
	}

	public function get($start){
		$query_str = "select * from cs_updata_info limit $start," . ($start+1)  . ";";
		$mresult = $this->conn->query($query_str)->fetch_assoc();
		if(!isset($mresult['uid']))
			return false;
		$uid = $mresult['uid'];
		$query_str = "select name from cs_user where uid=$uid;";
		$uresult = $this->conn->query($query_str)->fetch_assoc();

		$name = $uresult['name'];
		$action = $mresult['action'];
		$des = $mresult['mdescribe'];
		$message = $mresult['message'];

		date_default_timezone_set("PRC");

		$a = strtotime( $mresult['rdate'] );
		$b = time() - $a;
		if($b <= 5*60)
			$time = floor($b/60) . "分钟" . $b-floor($b/60)*60 . "秒前";
		else if($b < 1*3600)
			$time = floor($b/60) . "分钟前";
		else if($b >= 1*3600)
			$time = floor($b/3600) . "小时前";
		else if($b >= 24*3600)
			$time = floor($b/3600/24) . "天前";

		$array = array(
			"name" => $name,
			"action" => $action,
			"mdescribe" => $des,
			"message" => $message,
			"time" => $time
		);
		return $array;
	}
}

?>
