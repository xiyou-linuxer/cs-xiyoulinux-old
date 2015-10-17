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
