<?php
require_once("conn.php");
require_once("error_log.php");

$m = new Mail(1030);
$array = json_decode($m->cs_get_mail(283, 1, 1), true);
var_dump($array);

class Mail{
	private $uid;

	function __construct($uid)
	{
		// code...
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
		unset($result);

		$lower_sql_str = strtolower($sql_str);
		$result = $link->query($sql_str);

		$flag = preg_match("/select|show|describe|explain/", $lower_sql_str);

		if ($result != false && $flag != false)
		{
			if ($result->num_rows > 1)
			{
				for ($i = 0; $i < $result->num_rows; $i++) 
				{
					//$result->field_seek((int)$i);
					$array = $result->fetch_assoc();
					$return_var[$i] = $array;
				}
			}
			else 
			{
				$return_var = $result->fetch_assoc();
			}
			return $return_var;
		}

		if ($result == false)
		{
			$error = new Error_log($error_str);
		}
	}

	public function cs_send_mail($info_json)
	{
		$info = json_decode($info_json, true);
		$title = $info["title"];
		$content = $info["content"];
		$touid_arr = $info["touid"];
		$this->link_result("insert into cs_mail (fromuid,sdate,title,content) values ($this->uid,now(),'$title','$content');",
		   	"send mail -> insert cs_mail error");

		$return = $this->link_result("select max(mid) from cs_mail;",
			"send mail-> select mid error");

		$mid = $return["max(mid)"];

		foreach ($touid_arr as $touid)
		{
			$this->link_result("insert into cs_mail_user (mid, touid) values (".$mid.",". $touid.")", 
			   	"send mail -> insert cs_mail_user error");
		}
	}

	public function cs_get_recvmids($tag = 0)
	{
		if ($tag == 0)
			$result = $this->link_result("select mid, status from cs_mail_user where touid = $this->uid",
			   	"get_recvmids -> select tag=0 error");
		if ($tag == 1)
			$result = $this->link_result("select mid, status from cs_mail_user where touid = $this->uid and status = 0",
				"get_recvmids -> select tag=1 error");
		if ($tag == 2)
			$result = $this->link_result("select mid, status from cs_mail_user where touid = $this->uid and status = 1",
				"get_recvmids -> select tag=2 error");	
	
		if ($result == null)
			return null;
		return json_encode($result);
	}

	public function cs_get_sendmids($tag = 0)
	{
		if ($tag == 0)
			$result = $this->link_result("select mid from cs_mail where fromuid =$this->uid",
			   	"get_sendmids -> select tag=0 error");
		if ($tag == 1)
			$result = $this->link_result("select mid from cs_mail where fromuid = $this->uid",
				"get_sendmids -> select tag=1 error");
		if ($tag == 2)
			$result = $this->link_result("select mid from cs_mail where fromuid = $this->uid",
				"get_rsendmids -> select tag=2 error");	
	
		return json_encode($result);
	}

	private function combine_mid($data)
	{
		// code...
		$mid = array();
		foreach($data as $row)
		{
			$mid[] = $row["touid"];
		}
		$data[0]["touid"] = $mid;
		return $data[0];
	}

	/*$tag == 0,   消息仍未未读
	 *$tag == other, 消息标记未已读
	 *$flag = 0,寻找$uid的未读信息
	 *$flag == other,寻找$uid的已读信息
	 * */
	public function cs_get_mail($mid, $tag = 0, $flag = 0)
	{	

		if ($flag == 0)
		{
			$result = $this->link_result("select id,fromuid, sdate, touid, title, content from cs_mail,cs_mail_user where cs_mail.mid = $mid and cs_mail_user.mid = $mid and touid = $this->uid", "get_mail -> select error");
		}else 
		{
			$result =  $this->link_result("select id,fromuid, sdate, touid, title, content from cs_mail,cs_mail_user where cs_mail.mid = $mid and cs_mail_user.mid = $mid", "get_mail -> select error");

		$result = $this->combine_mid($result);
			
		}


		if ($result != false)
		{
			if ($tag == 1)
			{
				$this->link_result("update cs_mail_user set status = 1 where mid = $mid;",
					"get_mail -> update error");	
			}

			return json_encode($result);
		}
	}
}
?>
