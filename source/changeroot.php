<?php
require_once("inc/inject.php");
require_once("inc/conn.php");

if (isset($_COOKIE["uid"]))
	$uid = $_COOKIE["uid"];

$func = $_POST["func"];
$name = $_POST["name"];
$year = $_POST["year"];

//过滤
$inject = new Inject;
$name = $inject->jundge($name, "zh");
$year = $inject->jundge($year, "number");

//判断运行的函数
switch($func = "default")
{
case "get_year":
	return get_year();
case "get_name":
	return get_name($year);
case "change_user":
	return change_user($year, $name);
default:
	return "<o_o>";
}

//得到所有年份
function get_year()
{
	$link = new Csdb;
	$sql = "select distinct grade from cs_user order by asc";
	$result = $link->query($sql);
	
	if ($result == false)
		exit("查询年份错误");

	if (is_object($result))
	{
		if ($result->num > 0)
		{
			while($row = $result->fetch_assoc())
				$years[] = $row["grade"];
		}
		return $years;
	}
	return $result;
}

//根据年份获得当年所有的成员名单
function get_name($year)
{
	$link = new Csdb;
	$sql = "select name grade from cs_user where grade=".$year." order by asc";
	$result = $link->query($sql);

	if ($result == false)
		exit("查询姓名错误");
	
	if(is_object($result))
	{
		if($result->num > 0)
		{
			while ($row = $result->fetch_assoc())
				$names[] = $row["name"];
		}
		return $names;
	}

	return $result;
}

//根据级别和姓名删除成员信息
function change_user($year,$name)
{
	$link = new Csdb;
	$sql = "select uid from cs_user where year=$year and name=$name";
	$result = $link->query($sql);
	if (!$result)
		exit("查询uid出错");
	$info = $result->fetch_assoc();
	$new_root_uid = $info["uid"];

	$sql = "update cs_user set permisson = case uid
		when $uid then 0
		when $new_root_uid then 1 end;";
	$result = $link->query($sql);

	if(!$result)
		exit("移交信息出错");
	return "移交成功";

}

?>
