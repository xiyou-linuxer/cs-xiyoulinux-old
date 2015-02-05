<?php
require_once(dirname(dirname(__FILE__)) . '/config.php');

class DBClass{
	private $hostname;
	private $dbuser;
	private $dbpwd;
	private $dbname;
	private $charName;
	private $db;

	private $res;
	
	function __construct()
	{
		$hostname = "localhost";
		$dbuser = MYSQL_USER_NAME;
		$dbpwd = MYSQL_USER_PASSWORD;
		$dbname = MYSQL_DB_NAME;
		$charName = MYSQL_CHARSET;

		$this->db = new mysqli($hostname, $dbuser, $dbpwd, $dbname);

		if (mysqli_connect_errno())
		{
			echo "链接失败".mysqli_connect_errno();
			exit();
		}
		$this->db->query("set names $charName;");

		return $this->db;
	}

	public function query($sql)
	{
		$this->res = $this->db->query($sql);
		return $this->res;
	}

	function __destruct()
	{
		if( is_object($this->res) )
			$this->res->free();
		$this->db->close();
	}
}
?>
