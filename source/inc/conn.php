<?php
	
class Csdb{		//封装成类,对外目前就一个query接口
	private $link;
	private $host;
	private $user;
	private $pwd;
	private $dbName;
	private $charset;
	
	public function __construct(){	//自动初始化
		$this->host = 'xxx';
		$this->user = 'xxx';
		$this->pwd = 'xxx';
		$this->dbName = 'xxx';
		$this->charset = 'utf8';		
		$this->connect($this->host,$this->user,$this->pwd,$this->dbName,$this->charset);
	}
	
	private function connect($h,$u,$p,$d,$c){
		$this->link = new mysqli($h,$u,$p,$d);		
		if (mysqli_connect_errno()) {
			printf("数据库连接错误: %s\n", mysqli_connect_error());
			exit();
        }else{
			$this->link->query('set names ' . $c);
		}
	}
	
	public function query($query_string){
		$result = $this->link->query($query_string);
		return $result;
	}
	
	public function __destruct(){		//自动释放
		$this->link->close();
	}
}

?>
