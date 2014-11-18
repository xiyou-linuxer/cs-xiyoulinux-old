<?php

require_once("conn.php");

$a =  new Plugin();
$a->get_app_list();

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
					$args = $this->checkApp("../plugins/$file/config");
					if( is_file("../plugins/$file/config") && $args){
						$name = $this->get_name("../plugins/$file/config");
						$status = $this->conn->query("SELECT `status` FROM `cs_app` where name='$name';");
						$status = $status->fetch_array();
						$status = $status[0];
						if($status == '1')
							$list .= ' 已启用';
						else if($status == '0')
							$list .= ' 未启用';
						else{
							$this->conn->query("insert into cs_app values($args);");
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
		if( is_file("../plugins/$file/config") && $this->checkApp("../plugins/$file/config")){	
			$this->conn = new Csdb();
			$query_str = "update `cs_app` set status=$status where name='$file';";
			$result = $this->conn->query($query_str);
			if($result)
				print ' 已启用';
			else
				print ' 未启用';
		}
	}

	private function get_name($path){
		$content = file_get_contents($path);
		$result = (preg_match("/\bname: (.+)\b/",$content,$matches) > 0);
		if(!$result)
			return false;
		return $matches[1];
	}

	private function checkApp($path){
		$content = file_get_contents($path);
		$a = "NULL,";
		$result = (preg_match("/\bname: (.+)\b/",$content,$matches) > 0);
		$a .= "'$matches[1]','0',";
		$result &= (preg_match("/\bicon: (.+)\b/",$content,$matches) > 0);	
		$a .= "'$matches[1]'";
		$result &= (preg_match("/\bindex: (.+)\b/",$content,$matches) > 0);
		if(!$result)
			return false;
		return $a;
	}
}

?>
