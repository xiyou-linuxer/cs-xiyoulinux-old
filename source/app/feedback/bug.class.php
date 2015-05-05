<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/includes/db.class.php');

class Bug{
	private $dbObj;

	function __construct(){
		$this->dbObj = new DBClass();
	}

	//发布新bug
	public function bug_send($content,$uid,$method,$title) {
		$status = 0;
		$attr = "预留拓展";
		$sql = "insert into app_feedback_bug_info (content,uid,title,status,method,attr) values('$content','$uid','$title','$status','$method','$attr');";
		$result = $this->dbObj->query($sql);
		if($result) 
			return true;
		else
			return false;
		
	}

/*
*        tag = 0,查询新发布以及未修复bug；
*        tag = 1,查询已修复和已关闭的bug
*        tag = 2,查询最新5个bug
*/

	public function bug_status($tag) {
		if($tag == 0) {
		
			$sql = "select * from app_feedback_bug_info where status='0' or status='1';";
			$result = $this->dbObj->query($sql);

			if(is_object($result)){
				if($result->num_rows > 0) {
					while($com = $result->fetch_assoc()) {
						$bug_info[] = $com;
					}
					return $bug_info;
				}		
			} else
				return $result;
		}

		else if($tag == 1) {
			
			$sql = "select * from app_feedback_bug_info where status='2' or status='3';";
			$result = $this->dbObj->query($sql);
			
			if(is_object($result)) {
				if($result->num_rows > 0 ){
					while($com = $result->fetch_assoc()) {
						$bug_info[] = $com;
					}
					return $bug_info;
				}
			} else 
				return $result;
			
		}
		
		else if($tag == 2) {
			
			$sql = "select * from app_feedback_bug_info order by bugid desc limit 0,5;";
			$result = $this->dbObj->query($sql);
			
			if(is_object($result)) {
				if($result->num_rows > 0 ){
					while($com = $result->fetch_assoc()) {
						$bug_info[] = $com;
					}
					return $bug_info;
				}
			} else 
				return $result;
			
		}
	}
	public function bug_info($var,$tag) {
		if($tag == 'bugid') {
			$sql = "select name,title,content,method,modifytime,status from app_feedback_bug_info,cs_user where app_feedback_bug_info.uid=cs_user.uid and bugid='$var';";
			$result = $this->dbObj->query($sql);
		}

		if($result == false) {
			return false;
		} else {
			while($com = $result->fetch_assoc()) {
				$bug_info[] = $com;
			}
			return $bug_info;
		}
	}

/*
*		查询相关bug信息
*/

	public function bug_search($title) {
		$sql = "select * from app_feedback_bug_info where title like '%$title%';";
		$result = $this->dbObj->query($sql);
		if($result == false)
			return false;
		else {
			while( $com = $result->fetch_assoc()){
				$search[]  = $com;
			}
			return $search;
		}
	}

/*
*		通过uid查询与自己相关的bug
*/
	public function bug_mine($uid) {
		$sql = "select * from app_feedback_bug_info where uid='$uid';";
		$result = $this->dbObj->query($sql);
		if($result->num_rows <= 0)
			return false;
		else {
			while( $com = $result->fetch_assoc()){
				$mine[] = $com;
			}
			return $mine;
		}
	}
/*
*	tag=1,查询未修复以及新发布bug数量，tag=2,查询已修复以及已关闭bug数量
*/
	public function bug_count($tag) {
		
		if($tag == 0) {
			
			$sql = "select count(bugid) from app_feedback_bug_info where status='0' or status='1';";
			$result = $this->dbObj->query($sql);
			if($result == false)
				return false;
			else 
				return $result->fetch_assoc();
		}
		else if($tag == 1 ) {
			
			$sql = "select count(bugid) from app_feedback_bug_info where status='2' or status='3';";
			$result = $this->dbObj->query($sql);
			if($result == false)
				return false;
			else 
				return $result->fetch_assoc();
		}
	}
}

?>
