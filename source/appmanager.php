<?php

require_once("inc/conn.php");
require_once("inc/inject.php");

$inject = new Inject;

if (isset($_POST{"func"}))
{
	$func = $_POST["func"];
	$func = $inject->jundge($func);
}
if (isset($_POST["name"]))
{
	$name = $_POST["name"];		//应用名
	$name = $inject->jundge($name);

}

function jundge($func, $name)
{
	if (!$func)
		exit("<o_o>");
	if (!$name)
		exit("<o_o>");
}
if (isset($func) && isset($name))
	jundge($func, $name);

if (isset($func))
{
	switch($func)
	{
		case "get_app_name":
			$names = get_name();
			foreach($names as $name)
				echo ".".$name;
			break;
		case "change_status":
			echo change_status($name);
			break;
		case "get_status":
			echo get_status($name);
			break;
		default:
			exit("<o_o>");
	}
}

function get_name()
{	
	$link = new Csdb;
	$sql = "select name from cs_app order by name";
	$result = $link->query($sql);

	if ($result == false)
		exit("查询应用名字出错");

	if (is_object($result))
	{
		while($row = $result->fetch_assoc())
			$names[] = $row["name"];
		return $names;
	}
	return $result;
}

function get_status($name)
{
	$link = new Csdb;
	$sql = "select status from cs_app where name='$name';";
	$result = $link->query($sql);

	if ($result == false)
		exit("查询应用状态错误");
	if(is_object($result))
	{
		$info = $result->fetch_assoc();
		$status = $info["status"];

		return $status;
	}
	return $result;
}

function change_status($name)
{
	$link = new Csdb;
	$sql = "update cs_app set status=1-status where name='$name'";
	$result = $link->query($sql);

	if ($result == false)
		exit("应用状态信息更新错误");
	if ($result == true) {
		return "应用状态更新成功";
	}

	return $result;
}
?>
