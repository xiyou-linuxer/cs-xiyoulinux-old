<?php

require_once("conn.php");

class Plugin{
	private $conn;

	public function __construct(){
		$this->conn = new Csdb();
	}

	function get_app_list(){
		$handle = opendir("../plugins");
		$list = "";
		if($handle){
			while (false !== ($file = readdir($handle))){
				if($file != '..' && $file != '.'){
					$list .= "$file: ";
					$xml = $this->parse_app("../plugins/$file/config");
					if( is_file("../plugins/$file/config") && $xml){
						$status = $this->conn->query("SELECT status FROM cs_app where name='$xml->name';");
						$status = $status->fetch_array();
						$status = $status[0];
						if($status == '1')
							$list .= ' 已启用';
						else if($status == '0')
							$list .= ' 未启用';
						else{
							$this->conn->query("insert into cs_app values(NULL,'$xml->name',
								0,$xml->icon,'$xml->index');");
						}
						$list .= "\n";
					}
					else{
						print "配置错误 !\n";
						return false;
					}
				}
			}
		}else
			return false;
		print $list;
		return true;
	}

	public function change_app($file,$status){
		if( is_file("../plugins/$file/config") && $this->parse_app("../plugins/$file/config")){	
			$this->conn = new Csdb();
			$query_str = "update `cs_app` set status=$status where name='$file';";
			$result = $this->conn->query($query_str);
			if($result)
				print ' 已启用';
			else
				print ' 未启用';
		}
	}

	private function parse_app($path){
		$xml = simplexml_load_file($path);
		if(!$xml->icon || !$xml->name || !$xml->index)
			return false;
		return $xml;
	}
}

?>
