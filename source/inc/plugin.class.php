<?php

require_once("conn.php");

class Plugin{
	private $conn;

	public function __construct(){
		$this->conn = new Csdb();
	}
	public function get_app_list(){
		$handle = opendir("/usr/share/nginx/html/cs/plugins");
		$list = "";
		if($handle){
			while (false !== ($file = readdir($handle))){
				if($file != '..' && $file != '.'){
					$xml = $this->parse_app("/usr/share/nginx/html/cs/plugins/$file/config");
					if( $xml ){
						$status = $this->conn->query("SELECT status FROM cs_app where name='$file';");
						$status = $status->fetch_array();
						$status = $status[0];
						if($status == '1')
							$status = 'on';
						else if($status == '0')
							$status = 'off';
						else{
							//$this->conn->query("insert into cs_app values(NULL,'$xml->name',0,$xml->icon,'$xml->index');");
							$status = 'off';
						}
						$xml['status'] = $status;
						$list[] = $xml;
					}
					else{
						print "配置错误 !\n";
						return false;
					}
				}
			}
		}else
			return false;
		return $list;
	}
	public function change_app($file,$status){
		if( is_file("../plugins/$file/config") ){	
			$query_str = "update `cs_app` set status=$status where name='$file';";
			$result = $this->conn->query($query_str);
			if($result)
				return true;
			return false;
		}
	}

	private function parse_app($path){
		$xml = simplexml_load_file($path);
		return $this->simplexml2array($xml);
	}
	private function simplexml2array($obj){    
	    if( count($obj) >= 1 ){
		$result = $keys = array();
		
		foreach( $obj as $key=>$value){   
		    isset($keys[$key]) ? ($keys[$key] += 1) : ($keys[$key] = 1);
		    
		    if( $keys[$key] == 1 )
			$result[$key] = $this->simplexml2array($value);
		    elseif( $keys[$key] == 2 )
			$result[$key] = array($result[$key], $this->simplexml2array($value));
		    else if( $keys[$key] > 2 )
			$result[$key][] = $this->simplexml2array($value);
		}
		return $result;
	    }
	    else if( count($obj) == 0 )
		return (string)$obj;
	}
}

?>
