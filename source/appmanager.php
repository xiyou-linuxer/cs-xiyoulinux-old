<?php

require_once("inc/conn.php");
require_once("inc/inject.php");

$func = $_POST["func"];
$name = $_POST["name"];		//应用名

$inject = new Inject;
$func = $inject->jundge($func);
$name = $inject->jundge($name);

function jundge($func, $name)
{
	if (!$func)
		exit("<o_o>");
	if (!$name)
		exit("<o_o>");
}

jundge($func, $name);

switch($func)
{
	case "get_app_name":
		get_name();
	case "change_status":
		change_status($name);
	case "get_status":
		get_status($name);
	default:
		exit("<o_o>");
}

function get_name()
{	
	$link = new Csdb;
	$sql = "select name from cs_app order by asc";
	$result = $link->query($sql);

	if ($result == false)
		exit("查询应用名字出错");

	if (is_object($result))
	{
		if($result->rows)
			while($row = $result->fetch_assoc())
				$names[] = $row["name"];
		return $names;
	}
	return $result;
}

function get_status($name)
{
	$link = new Csdb;
	$sql = "select status from cs_app where name=$name;";
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
	$sql = "update cs_app set status=1-status where name=$name";
	$result = $link->query($sql);

	if ($result == false)
		exit("应用状态信息更新错误");
	if ($result == true) {
		return "应用状态更新成功";
	}

	return $result;
}
?>
