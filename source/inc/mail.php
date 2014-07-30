<?php
require_once("conn.php");

class Mail{
	private $uid;

	public function __construct($uid)
	{
		$this->uid = $uid;
	}

	private function getlink()
	{
		// code...
		return new Csdb;
	}

	private function link_result($sql_str, $error_str)
	{
		$link = $this->getlink();

		$result = $link->query($sql_str);

		if ($result == false)
			echo $error_str;

		if (is_object($result))
		{
			if($result->num_rows > 0)
			{
				while( $row = $result->fetch_assoc() )
					$array[] = $row;
			}

			return $array;
		}

		return $result;
	}

	private function name_to_uid($name)
	{
		$link = $this->getlink();

		$result = $link->query("select uid from cs_user where name = '$name';");

		if ($result == false)
			return $result;

		$array = $result->fetch_assoc();
		return $array["uid"];
	}

	private function uid_to_name($uid)
	{
		$link = $this->getlink();

		$result - $link->query("select name from cs_user where uid = $uid;");

		if ($result == false)
			return $result;

		$array = $result->fetch_assoc();
		$uid = $array["name"];
	}

	private function insert_mail($fromuid, $touid, $title, $content, $mid)
	{
		if ( $mid < 0 ) {
			
		}

		$this->link_result("insert into cs_mail(fromuid,title,content) values($this->uid,'$title','$content');",
			"insert mail -> insert cs_mail error");

		$this->link_result("insert into cs_mail_user(mid,touid) values ('$mid','$touid');",
			"insert mail -> insert cs_mail error");
	}

	public function get_mail_count($tag = 0)		//G
	{
		
		switch($tag) {
			case 0:
				$sql = "select count(mid) from cs_mail where touser like '%$this->uid%';";
				$result = $this->link_result($sql,"get mail count -> tag = 0 error");
				$count = $result[0]["count(mid)"];
				break;
			case 1: 
				$sql = "select touser from cs_mail where touser like '%$this->uid%' and isdraft=0;";
				$result = $this->link_result($sql,"get mail count -> tag = 1 error");
				$count = 0;
				for ( $i = 0; $i < count($result); $i++ ) {
					$row_json = $result[$i]['touser'];
					$result_json = json_decode($row_json);
					foreach( $result_json as $key=>$value) {
						if ( $key == $this->uid && $value == 0 )
							$count ++;
					}
				}
				break;
			case 2:
				$sql = "select touser from cs_mail where touser like '%$this->uid%' and isdraft=0;";
				$result = $this->link_result($sql,"get mail count -> tag = 2 error");
				$count = 0;
				for ( $i = 0; $i < count($result); $i++ ) {
					$row_json = $result[$i]['touser'];
					$result_json = json_decode($row_json);
					foreach( $result_json as $key=>$value) {
						if ( $key == $this->uid && $value == 1 )
							$count ++;
					}
				}
				break;
			case 3:
				$sql = "select count(mid) from cs_mail where touser like '%$this->uid%' and isdraft=1;";
				$result = $this->link_result($sql,"get mail count -> tag = 3 error");
				$count = $result[0]['count(mid)'];
				break;
		}
		return json_encode(array("count"=>$count));
	}

	public function del_mail($mid)		//G
	{
		$sql = "select touser from cs_mail where mid=$mid";
		$result = $this->link_result($sql, "select touser from cs_mail error");
		$result_json = $result[0]['touser'];
		$array = array();
		$array = json_decode($result_json);
		foreach( $array as $key=>$value) {
			if( $key == $this->uid)
				$value=2;
			$array->{$key} = "$value";
		}
		$new_json = json_encode($array);
		$sql = "update cs_mail set touser='$new_json' where mid=$mid;";
		$result = $this->link_result($sql, "update touser json error");
		return json_encode(array("result"=>$result));
	}

	public function save_draft()	//G
	{
		$fromuid = $this->uid;
		$toname = $_POST["name"];
		$title = $_POST["title"];
		$content = $_POST["content"];

		if (empty($toname) && empty($title) && empty($content))
			return true;

		$users=explode(',',$toname);
		$array = array();
		for( $i = 0; $i < count($users); $i++ ) {
			$tempuid = $this->name_to_uid($users[$i]);
			$array[$tempuid] = "0";
		}
		$user_json = json_encode($array);
		$sql = "insert into cs_mail(fromuid,title,content,isdraft,touser) values($fromuid,'$title','$content',1,'$user_json');";
		$result = $this->link_result($sql, "save_draft error");
		return json_encode(array("result"=>$result));
	}

	public function send_mail()		//G
	{
		$fromuid = $this->uid;
		$toname = $_POST["touser"];
		$title = $_POST["title"];
		$content = $_POST["content"];
		$mid = $_POST["mid"];

		$users=explode(',',$toname);
		for ( $i = 0; $i < count($users); $i++ ) {
			$tempuid = $this->name_to_uid($users[$i]);
			if ( $tempuid == "" ) {
				$unfind[] = $users[$i];
			}
			else {
				$find[$tempuid] = "0";
			}
		}
		$user_json = json_encode($find);
		$sql = "insert into cs_mail(fromuid,title,content,touser) values($fromuid,'$title','$content','$user_json');";
		$result = $this->link_result($sql, "send mail error");
        if ( $unfind == NULL ) {
            $str = ($result == true) ? "true":"false";
			return json_encode(array("result"=>$str));
		}
		else {
            $str = implode(",",$unfind);
            return json_encode(array("result"=>$str));
		}
	}

	public function get_mail_list($tag = 0)
	{
		switch($tag)
		{
			case 0:
				$result = $this->get_mail_all();
				break;
			case 1:
				$result = $this->get_mail_unread();
				break;
			case 2:
				$result = $this->get_mail_read();
				break;
			case 3:
				$result = $this->get_mail_send();
				break;
			case 4:
				$result = $this->get_mail_draft();
				break;
			default :
				return ;
		}

		return $result;
	}

	private function remove_repeat($array)
	{
		$touid = array();

		$i = 0;

		$mid = $array[0]["mid"];
		$return_array[$i] = $array[0];

		foreach ($array as $value)
		{
			if ($value["mid"] != $mid)
			{
				$mid = $value["mid"];
				$value["touid"] = $touid;
				$return_array[$i++] = $value;
				unset($touid);
				continue;
			}
			$touid[] = $value["touid"];
		}
		
		var_dump($return_array);
		return $return_array;
	}

	private function sub_title_content($info, $length_arr)	//g
	{
		$title_len = $length_arr[0];
		$content_len = $length_arr[1];

		foreach($info as &$value)
		{
			$value["title"] = substr($value["title"], 0, 30);
			$value["content"] = substr($value["content"], 0, 30);
		}

		unset($value);
		return $info;
	}

	private function get_mail_unread()		//G
	{
		$sql = "select mid,title,sdate as date,name as fromuser,touser,content from cs_mail,cs_user where cs_mail.touser like '%\"$this->uid\":\"0\"%' and cs_mail.fromuid=cs_user.uid order by sdate desc;";
		$result = $this->link_result($sql, "get mail unread error");
		$result = $this->sub_title_content($result, array(30,30));

		for ( $i = 0; $i < count($result); $i ++ ) {
			foreach ( $result[$i] as $key=>$value) {
				if ( $key == "touser" ) {
					$touser = json_decode($value);
					$status = $touser->{"$this->uid"};
					if ( $status == 0 ) {
						$status = "未读";
					}
					$new_result[$i]["status"] = $status;
					continue;
				}
				$new_result[$i]["$key"] = "$value";
			}
		}
		return json_encode($new_result);
	}

	private function get_mail_read()		//G
	{
		$sql = "select mid,title,sdate as date,name as fromuser,touser,content from cs_mail,cs_user where cs_mail.touser like '%\"$this->uid\":\"1\"%' and cs_mail.fromuid=cs_user.uid order by sdate desc;";
		$result = $this->link_result($sql, "get mail unread error");
		$result = $this->sub_title_content($result, array(30,30));
		
		for ( $i = 0; $i < count($result); $i ++ ) {
			foreach ( $result[$i] as $key=>$value) {
				if ( $key == "touser" ) {
					$touser = json_decode($value);
					$status = $touser->{"$this->uid"};
					if ( $status == 1 ) {
						$status = "已读";
					}
					$new_result[$i]["status"] = $status;
					continue;
				}
				$new_result[$i]["$key"] = "$value";
			}
		}
		return json_encode($new_result);
	}

	private function get_mail_send()		//G
	{
		$sql = "select mid,title,sdate as date,name as fromuser,touser,content from cs_user,cs_mail where cs_mail.isdraft=0 and cs_mail.fromuid=$this->uid and cs_mail.fromuid=cs_user.uid order by sdate desc;";
		$result = $this->link_result($sql, "get mail draft error");
		$result = $this->sub_title_content($result, array(30,30));
		return json_encode($result);
	}

	private function get_mail_draft()		//G
	{
		$sql = "select mid,title,sdate as date,name as fromuser,touser,content from cs_user,cs_mail where cs_mail.isdraft=1 and cs_mail.fromuid=$this->uid and cs_mail.fromuid=cs_user.uid order by sdate desc;";
		$result = $this->link_result($sql, "get mail draft error");
		$result = $this->sub_title_content($result, array(30,30));
		return json_encode($result);
	}

	private function get_mail_all()			//G
	{
		$sql = "select mid,title,sdate as date,name as fromuser,touser,content from cs_mail,cs_user where cs_mail.touser like '%$this->uid%' and cs_user.uid=cs_mail.fromuid order by sdate desc;";
		$result = $this->link_result($sql, "get mail all error");
		$result = $this->sub_title_content($result, array(30,30));

		for ( $i = 0; $i < count($result); $i ++ ) {
			foreach ( $result[$i] as $key=>$value) {
				if ( $key == "touser" ) {
					$touser = json_decode($value);
					$status = $touser->{"$this->uid"};
					if ( $status == 0 ) {
						$status = "未读";
					}
					else if ( $status == 1 ) {
						$status = "已读";
					}
					$new_result[$i]["status"] = $status;
					continue;
				}
				$new_result[$i]["$key"] = "$value";
			}
		}
		return json_encode($new_result);
	}

	public function get_mail_info($mid)		//G
	{
		$sql = "select mid,title,sdate as date,name as fromuser,content from cs_mail,cs_user where cs_mail.mid=$mid and cs_user.uid=cs_mail.fromuid;";
		$result = $this->link_result($sql, "get mail info error");
		$touser_json = $this->link_result("select touser from cs_mail where mid=$mid;", "select touser error");
		$touser = json_decode($touser_json[0]["touser"]);
		$touser->{$this->uid} = "1";
		$touser_json = json_encode($touser);
		$sql = "update cs_mail set touser='$touser_json' where mid=$mid;";
		$this->link_result($sql, "update mail info error");
		return json_encode($result);
	}

	public function get_name_match($json)
	{
		$info = json_decode($json, true);
		$name = $info["username"];

		$match_arr = $this->link_result("select name from cs_user where name like '$name\_';");

		if (is_array($match_arr))	
			return json_encode(array("name" => $match_arr[0]));
		return $match_arr;
	}
}

?>
