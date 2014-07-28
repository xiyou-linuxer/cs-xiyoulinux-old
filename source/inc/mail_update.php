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
		 
//	echo "sql_str:<br/>".$sql_str."<br/>";
		if ($result == $false)
			echo $error_str;

		if (is_object($result))
		{
			if($result->num_rows > 0)
			{
				$array[] = $result->fetch_assoc();
			}

			return $array;
		}

		return $result;
	}

	private function name_to_uid($name)
	{
		$link = $this->getlink();

		$result = $link->query("select uid from cs_user where name = $name;");

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
		return $array["name"];
	}

	private function insert_mail($fromuid, $touid, $title, $content, $mid)
	{
		$this->link_result("insert into cs_mail(fromuid,title,content) values($this->uid,'$title','$content');",
			"insert mail -> insert cs_mail error");

//	$return = $this->link_result("select max(mid) from cs_mail;",
//			"insert mail -> insert cs_mail error");
		
//$mid = $return["max(mid)"];

		$this->link_result("insert into cs_mail_user(mid,touid) values ('$mid','$touid');",
			"insert mail -> insert cs_mail error");
	}

	public function get_mail_count($tag = 0)
	{
		switch($tag)
		{
			case 0:
				$result = $this->link_result("select count(mid) from cs_mail;",
					"get mail count -> tag = 0 error");
				break;
			case 1:
				$result = $this->link_result("select count(mid) from cs_mail where tag = 0",
					"get mail count -> tag = 1 error");
				break;
			case 2:
				$result = $this->link_result("select count(mid) from cs_mail where tag = 1",
					"get mail count -> tag = 2 error");
				break;
			case 3:
				$result = $this->link_result("select count(mid) from cs_mail where is_draft = 1",
					"get mail count -> tag = 3 error");
				break;
			default:
				return false;
		}

		if (is_array($result))
		{
			return json_encode(array("count"=>$result[0]["count(mid)"]));
		}

		return false;

	}

	public function del_mail()
	{
		$mid = $_POST["mid"];

		$result = $this->link_result("update cs_mail_user set status = 2 where mid = $mid;",
			"delete mail error");

		return json_encode(array("result"=>$result));
	}

	public function save_draft()
	{
		$fromuid = $this->uid;
		$toname = $_POST["name"];
		$title = $_POST["title"];
		$content = $_POST["content"];

		if (empty($toname) && empty($title) && empty($content))
			return true;

		$result = $this->link_result("insert into cs_mail (fromuid,title,content,is_draft) values ($this->uid,'$title','$content',1);");

		return $result;
	}

	public function send_mail()
	{
		$fromuid = $this->uid;
		$toname = $_POST["name"];
		$title = $_POST["title"];
		$content = $_POST["content"];
		$mid = $_POST["mid"];

		if (!is_array($toname))
		{
			$touid = $this->name_to_uid($toname);
			if($touid == false)
				return json_encode(array("name" => $toname));

			$this->insert_mail($fromuid, $touid, $title, $content, $mid);
		}
		
		if (is_array($toname))
		{
			foreach($toname as $value)
			{
				$touid = $this->name_to_uid($value);

				if($touid == false)
				{
					$unfind[] = $toname;
					continue;
				}

				$this->insert_mail($fromuid, $touid, $title, $content, $mid);
			}

			if(empty($unfind))
				return json_encode(array("name" => $unfind));
			return json_encode(array("result" => "true"));
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
				$result = $this->get_mail_readed();
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

	private function sub_title_content($info, $length_arr)
	{
		$title_len = $length_arr[0];
		$content_len = $length_arr[1];

		foreach($info as &$value)
		{
			$value["title"] = substr($value["title"], 0, 30);
			$value["content"] = substr($value["content"], 0, 30);
			$result = $this->uid_to_name_all($result);
		}

		unset($value);
		return $info;
	}

	private function get_mail_readed()
	{
		$result = $this->link_result("select * from cs_mail,cs_mail_user where cs_mail.mid=cs_mail_user.mid and touid=$this->uid and status=1 order by sdate desc",
			"get_mail_readed -> select error");

		if (is_array($result))
		{
			$result = $this->remove_repeat($result);
			$result = $this->sub_title_content($result, array(30,30));
			$result = $this->uid_to_name_all($result);
		}

		return json_encode($result);
	}

	private function get_mail_read()
	{
		$result = $this->link_result("select * from cs_mail,cs_mail_user where cs_mail.mid=cs_mail_user.mid and touid=$this->uid and status=0 order by sdate desc",
			"get_mail_read ->select error");
		if (is_array($result))
		{
			$result = $this->remove_repeat($result);
			$result = $this->sub_title_content($result, array(30,30));
			$result = $this->uid_to_name_all($result);
		}

		return json_encode($result);
	}

	private function get_mail_send()
	{
		$result = $this->link_result("select * from cs_mail,cs_mail_user where cs_mail.mid=cs_mail_user.mid and fromuid=$this->uid order by sdate desc",
			"get_mail_send ->select error");
		if (is_array($result))
		{
			$result = $this->remove_repeat($result);
			$result = $this->sub_title_content($result, array(30,30));
			$result = $this->uid_to_name_all($result);
		}

		return json_encode($result);
	}

	private function get_mail_draft()
	{
		$result = $this->link_result("select * from cs_mail where is_draft = 1 order by sdate desc",
			"get_mail_read ->select error");

		$result = $this->sub_title_content($result, array(30,30));
		return json_encode($result);

	}

	private function get_mail_all()
	{
		$result = $this->link_result("select * from cs_mail,cs_mail_user where cs_mail.mid = cs_mail_user.mid and (fromuid=$this->uid or touid=$this->uid) order by sdate desc",
			"get_mail_all ->select error");

//var_dump($result);
	
		if (is_array($result))
		{
			$result = $this->remove_repeat($result);
			$result = $this->sub_title_content($result, array(30,30));
		}
				
		return json_encode($result);	
	}

	// only 2D array can be used
	private function uid_to_name_all($info)
	{
		foreach ($info as &$value)
		{
			$value["fromuser"] = $this->uid_to_name($value["fromuid"]);
			unset($value["fromuid"]);
			$value["touid"] = $this->uid_to_name($value["touid"]);
			unset($value["touid"]);
		}
		unset($value);
	}

	public function get_mail_info($mid)
	{
		$result = $this->link_result("select * from cs_mail,cs_mail_user where cs_mail.mid=$mid and cs_mail_user.mid=$mid order by desc",
			"get_mail_info -> select error");

		$result = $this->remove_repeat($result);
		$result = $this->uid_to_name_all($result);

		return json_encode($result[0]);
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
