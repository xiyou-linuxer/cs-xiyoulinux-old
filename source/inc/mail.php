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
		$result = $this->link_result("select name from cs_user where uid=$uid", "select name error");
		$name = $result[0]["name"];
		return $name;
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

	public function get_mail_count()		//G
	{
		$sql = "select count(mid) from cs_mail where (touser like '%\"$this->uid\":\"0\"%' or touser like '%\"$this->uid\":\"1\"%') and isdraft=0;";
				$result = $this->link_result($sql,"get mail count -> tag = 0 error");
				$all_count = $result[0]["count(mid)"];

				$sql = "select count(mid) from cs_mail where touser like '%\"$this->uid\":\"0\"%' and isdraft=0;";
				$result = $this->link_result($sql,"get mail count -> tag = 1 error");
                $unread_count = $result[0]["count(mid)"];
/*
				for ( $i = 0; $i < count($result); $i++ ) {
					$row_json = $result[$i]['touser'];
					$result_json = json_decode($row_json);
					foreach( $result_json as $key=>$value) {
						if ( $key == $this->uid && $value == 0 )
							$unread_count ++;
					}
				}
*/	
				$sql = "select count(mid) from cs_mail where touser like '%\"$this->uid\":\"1\"%' and isdraft=0;";
				$result = $this->link_result($sql,"get mail count -> tag = 2 error");
				$read_count = $result[0]["count(mid)"];
/*
				for ( $i = 0; $i < count($result); $i++ ) {
					$row_json = $result[$i]['touser'];
					$result_json = json_decode($row_json);
					foreach( $result_json as $key=>$value) {
						if ( $key == $this->uid && $value == 1 )
							$read_count ++;
					}
				}
*/
				$sql = "select count(mid) from cs_mail where fromuid=$this->uid and isdraft=1;";
				$result = $this->link_result($sql,"get mail count -> tag = 3 error");
				$draft_count = $result[0]['count(mid)'];
		return json_encode(array("all"=>$all_count, "unread"=>$unread_count, "read"=>$read_count, "draft"=>$draft_count));
	}

	public function del_mail($mid)		//G
	{
		$sql = "select touser,isdraft from cs_mail where mid=$mid";
		$result = $this->link_result($sql, "select touser from cs_mail error");

		$isdraft = $result[0]['isdraft'];
		if ( $isdraft == 1 ) {
			$sql = "delete from cs_mail where mid=$mid;";
		}
		else {
			$result_json = $result[0]['touser'];
			$array = json_decode($result_json);
			foreach( $array as $key=>$value) {
				if( $key == $this->uid)
					$value=2;
				$array->{$key} = "$value";
			}
			$new_json = json_encode($array);
			$sql = "update cs_mail set touser='$new_json' where mid=$mid;";
		}
		$result = $this->link_result($sql, "del mail error");
		if ( $result == 1 ) {
			return json_encode(array("result"=>"true"));
		}
		else {
			return json_encode(array("result"=>"false"));
		}
	}

	public function save_draft()	//G
	{
		$fromuid = $this->uid;
		$toname = $_POST["touser"];
		$title = $_POST["title"];
		$content = $_POST["content"];
		$mid = $_POST["mid"];

		if ( empty($toname) && empty($title) && empty($content) ) {
			return json_encode(array("result"=>"false"));
		}

		$users=explode(',',$toname);
		$array = array();
		for( $i = 0; $i < count($users); $i++ ) {
			$tempuid = $this->name_to_uid($users[$i]);
			$array[$tempuid] = "0";
		}
		$user_json = json_encode($array);
		if ( $mid != "" ) {
			$sql = "update cs_mail set fromuid=$fromuid,title='$title',content='$content',isdraft=1,touser='$user_json' where mid=$mid;";
		}
		else {
			$sql = "insert into cs_mail(fromuid,title,content,isdraft,touser) values($fromuid,'$title','$content',1,'$user_json');";
		}
		$result = $this->link_result($sql, "save_draft error");
		if ( $result == 1 ) {
			return json_encode(array("result"=>"true"));
		}
		else {
			return json_encode(array("result"=>"false"));
		}
	}

	public function send_mail()		//G
	{
		$fromuid = $this->uid;
		$toname = $_POST["touser"];
		$title = $_POST["title"];
		$content = $_POST["content"];
		$mid = $_POST["mid"];

		if ( empty($title) || empty($toname) || empty($content)  ) {
			return json_encode(array("result"=>"false"));
		}

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
		if ( $mid != "" ) {
			$sql = "update cs_mail set fromuid=$fromuid,title='$title',content='$content',touser='$user_json' where mid=$mid;";
		}
		else {
			$sql = "insert into cs_mail(fromuid,title,content,touser) values($fromuid,'$title','$content','$user_json');";
		}
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
		$sql = "select mid,title,sdate as date,name as fromuser,touser,content from cs_mail,cs_user where cs_mail.touser like '%\"$this->uid\":\"0\"%' and cs_mail.fromuid=cs_user.uid and cs_mail.isdraft=0 order by sdate desc;";
		$result = $this->link_result($sql, "get mail unread error");

		if ( $result == null ) {
			return json_encode(array("result"=>"false"));
		}
		//$result = $this->sub_title_content($result, array(30,30));

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
		$sql = "select mid,title,sdate as date,name as fromuser,touser,content from cs_mail,cs_user where cs_mail.touser like '%\"$this->uid\":\"1\"%' and cs_mail.fromuid=cs_user.uid and cs_mail.isdraft=0 order by sdate desc;";
		$result = $this->link_result($sql, "get mail unread error");
		if ( $result == null ) {
			return json_encode(array("result"=>"false"));
		}
		//$result = $this->sub_title_content($result, array(30,30));
		
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
		if ( $result == null ) {
			return json_encode(array("result"=>"false"));
		}
		//$result = $this->sub_title_content($result, array(30,30));
		return json_encode($result);
	}

	private function get_mail_draft()		//G
	{
		$sql = "select mid,title,sdate as date,name as fromuser,touser,content from cs_user,cs_mail where cs_mail.isdraft=1 and cs_mail.fromuid=$this->uid and cs_mail.fromuid=cs_user.uid order by sdate desc;";
		$result = $this->link_result($sql, "get mail draft error");
		if ( $result == null ) {
			return json_encode(array("result"=>"false"));
		}
		for ( $i = 0; $i < count($result); $i++ ) {
			foreach ( $result[$i] as $key=>$value ) {
				if ( $value == "" ) {
					$value=" ";
				}
				$new_result[$i]["$key"] = "$value";
			}
			$new_result[$i]["status"] = "草稿";
		}
		for ( $i = 0; $i < count($result); $i++ ) {
			$touser = $result[$i]["touser"];
			$touser = json_decode($touser);
			foreach ( $touser as $key=>$value) {
				$users[] = $this->uid_to_name($key);
			}
			$user = implode(",",$users);
			$new_result[$i]["touser"] = "$user";
			unset($users);
		}
		//$new_result = $this->sub_title_content($new_result, array(30,30));
		return json_encode($new_result);
	}

	private function get_mail_all()			//G
	{
		$sql = "select mid,title,sdate as date,name as fromuser,touser,content from cs_mail,cs_user where (cs_mail.touser like '%\"$this->uid\":\"0\"%' or cs_mail.touser like '%\"$this->uid\":\"1\"%') and cs_user.uid=cs_mail.fromuid and cs_mail.isdraft=0 order by sdate desc;";
		$result = $this->link_result($sql, "get mail all error");
		if ( $result == null ) {
			return json_encode(array("result"=>"false"));
		}
		//$result = $this->sub_title_content($result, array(30,30));

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
		$sql = "select isdraft from cs_mail where mid=$mid;";
		$result = $this->link_result($sql, "select isdraft error");
		$isdraft = $result[0]['isdraft'];

		$sql = "select mid,title,sdate as date,name as fromuser,content from cs_mail,cs_user where cs_mail.mid=$mid and cs_user.uid=cs_mail.fromuid;";
		$result = $this->link_result($sql, "get mail info error");
		if ( $result == null ) {
			return json_encode(array("result"=>"false"));
		}
		$touser_json = $this->link_result("select touser from cs_mail where mid=$mid;", "select touser error");
		$touser = json_decode($touser_json[0]["touser"]);
		if ( $isdraft == 0 ) {
			$touser->{$this->uid} = "1";
			$touser_json = json_encode($touser);
			$sql = "update cs_mail set touser='$touser_json' where mid=$mid;";
			$this->link_result($sql, "update mail info error");
			return json_encode($result);
		}
		else {
			foreach ( $touser as $key=>$value) {
				$users[] = $this->uid_to_name($key);
			}
			$users = implode(",",$users );
			$result[0]["touser"] = "$users";
			return json_encode($result);
		}
	}


	public function get_name_match($name)
	{
		$result = $this->link_result("select name from cs_user where name like '%$name%' limit 5;", "get name match error");
	
		if ( $result == null ) {
			return json_encode(array("result"=>"false"));
		}
		for ( $i = 0; $i < count($result); $i++ ) {
			$new_result[$i]["username"] = $result[$i]["name"];
		}
		return json_encode($new_result);
	}
}

?>
