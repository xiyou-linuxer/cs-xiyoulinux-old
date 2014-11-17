<?php
class Csdb{
	private $hostname;
	private $dbuser;
	private $dbpwd;
	private $dbname;
	private $charName;
	private $db;

	private $res;
	
	function __construct()
	{
		$hostname = "";
		$dbuser = "";
		$dbpwd = "";
		$dbname = "";
		$charName = "utf8";

		$this->db = new mysqli($hostname, $dbuser, $dbpwd, $dbname);

		if (mysqli_connect_errno())
		{
			echo "链接失败".mysqli_connect_errno();
			exit();
		}
		$this->db->query("set name $charName;");

		return $this->db;
	}

	public function query($sql)
	{
		$this->res = $this->db->query($sql);
		return $this->res;
	}

	function __destruct()
	{
		$this->res->free();
		$this->db->close();
	}
}
?>