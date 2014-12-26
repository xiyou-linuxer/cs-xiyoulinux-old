<?php
	require_once("conn.php");	
	
class Updata {
	private function getlink() {
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

	public function insert_updata($uid, $appid, $mdescribe, $action_color, $action_text, $message, $href) {
		$sql = "insert into cs_updata_info (uid, appid, mdescribe, action, message, href)
			 values($uid, $appid, '$mdescribe', '{\"color\":\"$action_color\",\"text\":\"$action_text\"}', '$message', '$href');";
		$this->link_result($sql, "insert updata error");
	}

}
?>
