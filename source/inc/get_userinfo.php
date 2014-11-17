<?php
include 'conn.php';
include 'inject.php';

function get_userinfo($uid)
{
	$sql = new Csdb;

	$result = $sql->query("select * from cs_user");

	if (!is_object($result)) 
	{
		// code...
		return false;
	}

	$array = $result->fetch_assoc();
	return json_encode($array);
}

function inject_this($str_arr, $flag_arr)
{
	// code...
	$result_arr = array();
	foreach($str_arr as $str)
	{
		$flag = current($flag_arr);
		if(($result =$inject_class = new Inject(substr($str,3), $flag)) == false)
		{
			return false;
		}
		next($flag_arr);
		$result_arr[substr($str,0,3)] ="$result";
	}
		
		
}

function add_user($json)
{
	$info_arr = json_decode($json, true);

	$name = $info_arr["name"];
	$password = $info_arr["password"];
	$mail = $info_arr["mail"];
	$grade = $info_arr["grade"];
	$major = $info_arr["major"];
	$sex = $info_arr["sex"];

	$password = md5($password);

	$result_arr = inject_this(array("nam".$name,"pas".$password,"mai".$mail,"gra".$grade,"maj".$major,"sex".$sex), 
				array("zh", "common", "email", "common", "zh", "zh"));

///* if (($password = inject_commen($password)) == false)
/*	{
		return false;
	}

	if(($name = inject_commen($name)) == false)
	{
		return false;
	}

	if (($mail = inject_email($mail)) == false)
	{
		return false;
	}

	if (($grade = inject_zh($grade)) == false)
	{
		return false;
	}

	if (($major = inject_commen($major)) == false)
	{
		return false;
	}

	if (($sex = inject_zh($sex)) == false) 
	{
		return false;
	}*/

	if ((!$result_arr['pas'])|| (!$result_arr['nam']) ||(!$result_arr['mai'])|| (!$result_arr['gra'])||(!$result_arr['sex']))
	{
		 return false;
	}else
	{
		$name = $result_arr['nam'];
	}

	if ($sex == '男')
		$sex = 1;
	else
		$sex = 0;

	$link = new Csdb;

	$result = $link->query("insert into cs_user (password,name,sex,mail,grade,major) values($password,'$name',$sex,'$mail','$grade','$major')");
	if ($result == false)
		return false;
}

function updata_userinfo($json)
{
	$info = json_decode($json, true);

	$phone = $info['phone'];
	$mail = $info["mail"];
	$qq = $info["qq"];
	$wechat = $info["wechat"];
	$blog = $info["blog"];
	$github = $info["github"];
	$native = $info["native"];
	$major = $info["major"];
	$workplace = $info["workplace"];
	$job = $info["job"];

	$query_str = "INSERT INTO `cs_user`(`password`,`sex`,`phone`,`mail`,`qq`,`wechat`,`blog`,`github`,`native`,`major`,`workplace`,`job`) VALUES ('$password','$sex','$phone','$mail','$qq','$wechat','$blog','$github','$native','$major','$workplace','$job');";
	
	$link = new Csdb;
	$result = $link->query($query_str);

	if ($result == false)
		return false;
}

?>
