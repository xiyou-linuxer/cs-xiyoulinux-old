<?php
require_once("conn.php");
require_once("error_log.php");

class Mail{
	private $uid;
    private $num;
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
				$return_var[] = $result->fetch_assoc();
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

    /* $tag == 0, 获取所有邮件mid
     * $tag == 1, 获取未读邮件Mid
     * $tag == 2, 获取已读邮件mid
     */

	public function cs_get_recvmids($tag = 0)
	{
		if ($tag == 0)
			$result = $this->link_result("select distinct mid from cs_mail_user where touid = $this->uid",
			   	"get_recvmids -> select tag=0 error");
		if ($tag == 1)
			$result = $this->link_result("select mid from cs_mail_user where touid = $this->uid and status = 0",
				"get_recvmids -> select tag=1 error");
		if ($tag == 2)
			$result = $this->link_result("select cs_mail.mid from cs_mail, cs_mail_user where cs_mail.mid = cs_mail_user.mid and cs_mail_user.touid = $this->uid and cs_mail_user.status = 1 order by  cs_mail.sdate desc",
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
    
    /* 接口名称: get_mail_num
     * 功能描述: 获取站内信数目
     * 参数描述:
     * $tag = 0, 获取接收的所有信息的数量
     * $tag = 1，获取接收的未读信息的数量
     * $tag = 2，获取接收的已读信息的数量
     * $tag = 3, 获取发送的所有信息的数量
     * $tag = other, 获取草稿的数量
     *
     *
     */

    function get_mail_num($tag = 0) {
        $link = $this->getlink();
        switch ($tag) {
        case 0:
            $sql_str = "select mid from cs_mail_user where touid= {$this->uid}";
            break;
        case 1:
            $sql_str = "select mid from cs_mail_user where touid= {$this->uid} and status = 0";
            break;
        case 2:
            $sql_str = "select mid from cs_mail_user where touid= {$this->uid} and status = 1";
            break;
        case 3:
            $sql_str = "select mid from cs_mail where fromuid= {$this->uid}";
            break;
//        case 4:
 //           $sql_str = "select count(mid) from cs_mail where fromuid= {$this->uid}";
        default:
            return;
        }

        $result = $link->query($sql_str);
        
        return $result->num_rows;
    }


    /* $tag == 0,       获取接受的消息
     * $tag == other,   获取发送的消息
     * $flag == 0,      不改变消息状态
	 * $flag == other,  改变消息阅读状态为已读
	 * */
	public function cs_get_mail($mid, $tag = 0, $flag = 0)
	{	

        if (tag == 0)
        {
		    $result = $this->link_result("select id,fromuid, sdate, touid, title, content, status from cs_mail,cs_mail_user where cs_mail.mid = $mid and cs_mail_user.mid = $mid and touid = $this->uid limit 1", "get_mail -> select error");
        } else {
		    $result = $this->link_result("select id,fromuid, sdate, touid, title, content, status from cs_mail,cs_mail_user where cs_mail.mid = $mid and cs_mail_user.mid = $mid and fromuid = $this->uid", "get_mail -> select error");
        }

		if ($result != false && $tag == 0 && $flag != 0)
		{
			$this->link_result("update cs_mail_user set status = 1 where mid = $mid;", "get_mail -> update error");	
        }
        
        //一个mid对应一份站内，为了调用方处理方便，没有以数组的形式返回 
        $result = $result[0];

        return json_encode($result);
	}
}
?>
