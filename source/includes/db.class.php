<?php
require_once(dirname(dirname(__FILE__)) . '/config.php');

class DBClass {
	private $hostname;
	private $dbuser;
	private $dbpwd;
	private $dbname;
	private $charsetName;
	private $db;

	private $res;
	
	function __construct()
	{
		$hostname = "localhost";
		$dbuser = MYSQL_USER_NAME;
		$dbpwd = MYSQL_USER_PASSWORD;
		$dbname = MYSQL_DB_NAME;
		$charsetName = MYSQL_CHARSET;

		$this->db = new mysqli($hostname, $dbuser, $dbpwd, $dbname);

		if (mysqli_connect_errno())
		{
			echo "数据库连接失败" . mysqli_connect_errno();
			exit();
		}

		$this->db->query("set names " . $charsetName . ";");

		return $this->db;
	}

	public function dhtmlspecialchars($string, $flags = null) 
	{
		if(is_array($string)) {  
    		    foreach($string as $key => $val) {  
    		        $string[$key] = dhtmlspecialchars($val, $flags);  
    		    }  
    		} else {  
    		    if($flags === null) {  
    		        $string = str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string);  
    		        if(strpos($string, '&amp;#') !== false) {  
			    //过滤掉类似&#x5FD7的16进制的html字符  
    		            $string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4}));)/', '&\\1', $string);  
    		        }  
    		    } else {  
    		        if(PHP_VERSION < '5.4.0') {  
    		            $string = htmlspecialchars($string, $flags);  
    		        } else {  
    		            if(strtolower(CHARSET) == 'utf-8') {  
    		                $charset = 'UTF-8';  
    		            } else {  
    		                $charset = 'ISO-8859-1';  
    		            }  
    		            $string = htmlspecialchars($string, $flags, $charset);  
    		        }  
    		    }  
    		}  
    		return $string;  
	}

	public function query($sql)
	{
		$this->res = $this->db->query($sql);
		return $this->res;
	}

	function __destruct()
	{
		if( is_object($this->res) && 
			is_resource($this->res) &&
			$this->res instanceof mysqli_result) {
			$this->res->free();
		}
		$this->db->close();
	}
}
?>
