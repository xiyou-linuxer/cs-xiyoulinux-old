<?php

require_once(dirname(__FILE__) . "/db.class.php");

class PluginClass {
	private $dbObj;

	public function __construct(){
		$this->dbObj = new DBClass();
	}
	public function flush_app_list(){
		$handle = opendir(BASE_PATH . "/app");
		if($handle){
			while (false !== ($file = readdir($handle))){
				if($file != '..' && $file != '.'){
					$xml = $this->parse_app(BASE_PATH . "/app/$file/config");
					if( $xml ){
						$status = $this->dbObj->query("SELECT * FROM cs_app where name='$file';");
						if($status->num_rows == 0){
							$attr = json_encode($xml, JSON_UNESCAPED_UNICODE);
							$this->dbObj->query("insert into cs_app values(NULL,'$file',1,'$attr');");
						}
					}
					else
						return false;
				}
			}
		}else
			return false;
		return true;
	}
	public function get_app_list(){
		//$this->flush_app_list();
		$result = $this->dbObj->query("select * from cs_app where status = 1;");
		$list = "";
		while( ($arr = $result->fetch_assoc()) )
			$list[] = $arr;
		if($list === "")
			return false;
		return $list;
        }
        public function get_all_app_list(){
                $result = $this->dbObj->query("select * from cs_app;");
                $list = "";
                while( ($arr = $result->fetch_assoc()) )
                        $list[] = $arr;
                if($list == "")
                        return false;
                return $list;
        }
	public function change_app($file,$status){
		if( is_file(BASE_PATH . "/app/$file/config") ){	
			$query_str = "update `cs_app` set status=$status where name='$file';";
			$result = $this->dbObj->query($query_str);
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
