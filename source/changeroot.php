<?php
require_once("inc/inject.php");
require_once("inc/conn.php");

if(isset($_COOKIE["uid"]))
	$uid = $_COOKIE["uid"];

if(isset($_POST["func"]))
	$func = $_POST["func"];
if(isset($_POST["name"]))
	$name = $_POST["name"];
if(isset($_POST["year"]))
	$year = $_POST["year"];

//过滤
$inject = new Inject;
if(isset($name))
	$name = $inject->jundge($name, "zh");
if(isset($year))
	$year = $inject->jundge($year, "number");

//判断运行的函数
if(isset($func))
	switch($func)
	{
		case "get_year":
			$years = get_year();
			foreach($years as $year)
				echo ".".$year;
			break;
		case "get_name":
			$names = get_name($year);
			foreach($names as $name)
				echo ".".$name;
			break;
		case "change_user":
			echo change_user($year, $name);
			break;
		default:
			echo "<o_o>";
	}


//得到所有年份
function get_year()
{
	$link = new Csdb;
	$sql = "select distinct grade from cs_user order by grade desc";
	$result = $link->query($sql);
	
	if ($result == false)
		exit("查询年份错误");

	if (is_object($result))
	{
			while($row = $result->fetch_assoc())
				//$years[] = $row["grade"];
				$years[] = $row["grade"];
			//	return json_encode($years);
			return $years;
	}
	return $result;
}

//根据年份获得当年所有的成员名单
function get_name($year)
{
	$link = new Csdb;
	$sql = "select name from cs_user where grade=".$year." order by name";
	$result = $link->query($sql);

	if ($result == false)
		exit("查询姓名错误");
	
	if(is_object($result))
	{
			while ($row = $result->fetch_assoc())
				$names[] = $row["name"];
			//return json_encode($names);
			return $names;
	}

	return $result;
}

//根据级别和姓名移交超级用户
function change_user($year,$name)
{
	$link = new Csdb;
	$sql = "select uid from cs_user where year=$year and name='$name'";
	$result = $link->query($sql);
	if (!$result)
		exit("查询用户出错");

	$info = $result->fetch_assoc();
	$new_root_uid = $info["uid"];
	$sql = "update cs_user set permission = case uid
			when $uid then 0
			when $new_root_uid then 1 end";
	$result = $link->quiry($sql);

	if(!$result)
		return("移交出错");
	return "移交成功";

}

?>
