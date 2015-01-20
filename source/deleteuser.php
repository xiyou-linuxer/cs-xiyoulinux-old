<?php
require_once("inc/inject.php");
require_once("inc/conn.php");

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
			/*
			foreach($_POST as $post)
				echo $post;*/
			$names = get_name($year);
			foreach($names as $name)
				echo ".".$name;
			break;
		case "delete_user":
			echo delete_user($year, $name);
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
				$years[] = $row["grade"];
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
			return $names;
	}

	return $result;
}

//根据级别和姓名删除成员信息
function delete_user($year,$name)
{
	$link = new Csdb;
	$sql = "delete from cs_user where grade=$year and name='$name';";
	$result = $link->query($sql);

	if(!$result)
		return("删除信息出错");
	return "删除成功";

}

?>
