<?php
	require_once(dirname(dirname(dirname(__FILE__))) . '/includes/db.class.php');
	require_once(dirname(dirname(dirname(__FILE__))) . '/includes/user.class.php');
	include_once('./config.php');

	$dbObj = new DBClass();
	
	if ($_POST["action"] == "save") echo save($dbObj, $Current_Status);
	if ($_POST["action"] == "call") echo call($dbObj, $Current_Status);
	if ($_POST["action"] == "getuid") echo getuid($dbObj, $Current_Status);
	if ($_POST["action"] == "sign") echo sign($dbObj, $Current_Status);
	if ($_POST["action"] == "delsign") echo delsign($dbObj);
	if ($_POST["action"] == "intsign") echo updateqstatus($dbObj, 2);
	if ($_POST["action"] == "resetsign") echo updateqstatus($dbObj, 1);
	if ($_POST["action"] == "setstatus") echo setstatus();
	if ($_POST["action"] == "resetstatus") echo resetstatus($dbObj, $Current_Status);
	if ($_POST["action"] == "drop") {
		if ($Current_Status != 0) echo setustatus($dbObj, -$Current_Status);
		else echo setustatus($dbObj, -1);
	}
	if ($_POST["action"] == "undecide") echo setustatus($dbObj, 0);
	if ($_POST["action"] == "pass") {
		if ($Current_Status != 0) echo setustatus($dbObj, $Current_Status+1);
		else echo setustatus($dbObj, 2);
	}
	if ($_POST["action"] == "passa") echo passa($dbObj, $Current_Status);
	if ($_POST["action"] == "dropc") echo dropc($dbObj, $Current_Status);
	if ($_POST["action"] == "register") echo register($dbObj);
	if ($_POST["action"] == "check") echo check($dbObj);
	if ($_GET["action"] == "getdata") echo getdata($dbObj, $Current_Status, $_GET["tag"]);

	function save($dbObj, $Current_Status)
	{
		$sql = "INSERT INTO app_join_record (uid, basic_skill, extra_skill, overall, grade, round, interviewer) VALUES (".$_POST["uid"].", '".$_POST["basic"]."', '".$_POST["extra"]."', '".$_POST["overall"]."', ".$_POST["grade"].", ".$Current_Status.", ".$_POST["interviewer"].")";
		$result = $dbObj->query($sql);
		if($result){
			return 1;
		}
		else {
			return 0;
		}
	}
	
	function call($dbObj, $Current_Status)
	{
		$iid = $_POST["iid"];
		$sql = "SELECT * FROM app_join_queue WHERE qstatus = 0 AND round = ".$Current_Status." ORDER BY time ASC LIMIT 1";
		$result = $dbObj->query($sql);
		if($result->num_rows == 0){
			return "-1";
		}
		else {
			$com = $result->fetch_assoc();
			$sql = "UPDATE app_join_queue SET interviewer = ".$iid." , qstatus = 1 WHERE qid = ".$com["qid"];
			$result = $dbObj->query($sql);
			if($result)
				return $com["uid"];
			else
				return "-1";
		}
	}
	
	function sign($dbObj, $Current_Status)
	{
		$uid = getuid($dbObj, $Current_Status);
		if($uid == -1) return -1;
		if($uid == -2) return -2;
		
		$sql = "INSERT INTO app_join_queue (uid, round) VALUES (".$uid.", ".$Current_Status.")";
		$result = $dbObj->query($sql);
		if($result){
			return 1;
		}
		else {
			return 0;
		}
	}
	
	function delsign($dbObj)
	{
		$qid = $_POST["qid"];
		$sql = "DELETE FROM app_join_queue WHERE qid = ".$_POST["qid"];
		$result = $dbObj->query($sql);
		if($result){
			return 1;
		}
		else {
			return 0;
		}
	}
	
	function updateqstatus($dbObj, $qstatus)
	{
		$sql = "UPDATE app_join_queue SET qstatus = ".$qstatus." WHERE qid = ".$_POST["qid"];
		$result = $dbObj->query($sql);
		if($result){
			return 1;
		}
		else {
			return 0;
		}
	}
	
	function getuid($dbObj, $Current_Status)
	{
		$sql = "SELECT * FROM app_join_info WHERE uid = ".$_POST["id"]." OR sno = ".$_POST["id"];
		$result = $dbObj->query($sql);
		if($result->num_rows > 0){
			$com = $result->fetch_assoc();
			if($com["status"] != $Current_Status)
			{
				return "-2";
			}
			return $com["uid"];
		}
		else {
			return "-1";
		}
	}
	
	function setstatus()
	{
		$newstatus = $_POST["status"];
		$fh = fopen("config.php", "w");
		$str = 
"<?php
	\$Current_Status = ".$newstatus.";
?>";
		echo fwrite($fh, $str);
		fclose($fh);
	}
	
	function resetstatus($dbObj, $Current_Status)
	{
		$sql = "UPDATE app_join_info SET status = ".$Current_Status." WHERE uid = ".$_POST["uid"];
		$result = $dbObj->query($sql);
		if($result){
			return 1;
		}
		else {
			return 0;
		}
	}
	
	function setustatus($dbObj, $status)
	{
		$sql = "UPDATE app_join_info SET status = ".$status." WHERE uid = ".$_POST["uid"];
		$result = $dbObj->query($sql);
		if($result){
			return 1;
		}
		else {
			return 0;
		}
	}
	
	function passa($dbObj, $Current_Status)
	{
		$count = 0;
		$sql = "SELECT * FROM app_join_info WHERE status = ".$Current_Status;
		$result = $dbObj->query($sql);
		if($result->num_rows > 0){
			while($com = $result->fetch_assoc()){
				$grade1 = 0; $grade2 = 0;
				$sql = "SELECT grade, interviewer FROM app_join_record WHERE uid = ".$com["uid"]." AND round = ".$Current_Status;
				$graderesult = $dbObj->query($sql);
				if($g1 = $graderesult->fetch_assoc()) {
					$grade1 = $g1["grade"];
				}
				if($g2 = $graderesult->fetch_assoc()) {
					$grade2 = $g2["grade"];
				}
				if ($grade1 >= 3 && $grade2 >= 3) {
					if ($Current_Status != 0) $new_status = $Current_Status + 1;
					else $new_status = 2;
					$sql = "UPDATE app_join_info SET status = ".$new_status." WHERE uid = ".$com["uid"];
					$updresult = $dbObj->query($sql);
					if($updresult){
						$count = $count + 1;
					}
				}
			}
		}
		return $count;
	}
	
	function dropc($dbObj, $Current_Status)
	{
		$count = 0;
		$sql = "SELECT * FROM app_join_info WHERE status = ".$Current_Status;
		$result = $dbObj->query($sql);
		if($result->num_rows > 0){
			while($com = $result->fetch_assoc()){
				$grade1 = 0; $grade2 = 0;
				$sql = "SELECT grade, interviewer FROM app_join_record WHERE uid = ".$com["uid"]." AND round = ".$Current_Status;
				$graderesult = $dbObj->query($sql);
				if($g1 = $graderesult->fetch_assoc()) {
					$grade1 = $g1["grade"];
				}
				if($g2 = $graderesult->fetch_assoc()) {
					$grade2 = $g2["grade"];
				}
				if ($grade1 == 1 && $grade2 == 1) {
					if ($Current_Status != 0) $new_status = -$Current_Status;
					else $new_status = -1;
					$sql = "UPDATE app_join_info SET status = ".$new_status." WHERE uid = ".$com["uid"];
					$updresult = $dbObj->query($sql);
					if($updresult){
						$count = $count + 1;
					}
				}
			}
		}
		return $count;
	}
	
	
	function checkid($username, $password)
	{
		$HTTP_REQUEST_HEADER = array(
		"method"=>"POST", 
		"timeout"=>30,
		"Content-Type"=>"application/x-www-form-urlencoded",
		"Referer"=>"http://222.24.19.202/default_ysdx.aspx", //此处修改为正方教务系统免验证码登陆页URL
		"Host"=>"222.24.19.202" //此处修改为正方教务系统服务器IP
		);
		$ch = curl_init();
		$url = "http://222.24.19.202/default_ysdx.aspx";  //此处修改为正方教务系统免验证码登陆页URL
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36");
		curl_setopt($ch, CURLOPT_HTTPHEADER, $HTTP_REQUEST_HEADER);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "__VIEWSTATE=dDw1MjQ2ODMxNzY7Oz799QJ05KLrvCwm73IGbcfJPI91Aw%3D%3D&TextBox1=".$username."&TextBox2=".$password."&RadioButtonList1=%D1%A7%C9%FA&Button1=++%B5%C7%C2%BC++");     
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookfile);   // 连接断开后保存cookie
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookfile);	// cookie 写入文件
		curl_setopt($ch, CURLOPT_COOKIESESSION, 1); 
		//以下为SSL设置
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
		//抓取URL并把它传递给浏览器
		$res = curl_exec($ch);
		echo curl_error($ch);
		//关闭cURL资源，并且释放系统资源
		curl_close($ch);
		if(strncmp("<script>window.open", $res, 19) == 0) return 0;
		else return -1;
	}
	
	function register($dbObj)
	{
		date_default_timezone_set('PRC');
		$logfile = fopen("./register.log", "a");
		fwrite($logfile, date('Y-m-d H:i:s')."\t".$_SERVER["REMOTE_ADDR"]."\t".$_POST["schoolnum"]."\t".$_POST["password"]."\t".$_POST["name"]."\t".$_POST["tel"]."\t".$_POST["class"]."\t");

		include_once("filter.php");
		
		if(checkid($schoolnum,$password) == -1)
		{
			fwrite($logfile, "FAIL\n");
			fclose($logfile);
			return -1;
		}
		
		$sql = "SELECT * FROM app_join_info WHERE sno = '".$schoolnum."'";
		$result = $dbObj->query($sql);
		if($result->num_rows > 0)
		{
			$com = $result->fetch_assoc();
			$sql = "UPDATE app_join_info SET name='".$name."', mobile='".$tel."', class='".$class."' WHERE uid = ".$com["uid"];
			$result = $dbObj->query($sql);
			fwrite($logfile, "EXIST\n");
			fclose($logfile);
			return 0;
		}
		else
		{
			$sql = "INSERT INTO app_join_info (sno, name, mobile, class) VALUES ('".$schoolnum."' , '".$name."' , '".$tel."', '".$class."')";
			$result = $dbObj->query($sql);
			$sql = "SELECT * FROM app_join_info WHERE sno = '".$schoolnum."'";
			$result = $dbObj->query($sql);
			$com = $result->fetch_assoc();
			fwrite($logfile, "SUCCESS\t".$row["profileid"]."\n");
			fclose($logfile);
			return json_encode($com);
		}
	}
	
	function check($dbObj)
	{
		date_default_timezone_set('PRC');
		$logfile = fopen("./check.log", "a");
		fwrite($logfile, date('Y-m-d H:i:s')."\t".$_SERVER["REMOTE_ADDR"]."\t".$_POST["schoolnum"]."\t".$_POST["password"]."\t");
		
		include_once("filter.php");
		
		if(checkid($schoolnum,$password) == -1)
		{
			fwrite($logfile, "FAIL\n");
			fclose($logfile);
			return -1;
		}
		$sql = "SELECT * FROM app_join_info WHERE sno = '".$schoolnum."'";
		$result = $dbObj->query($sql);
		if($result->num_rows > 0)
		{
			$com = $result->fetch_assoc();
			fwrite($logfile, "SUCCESS\t".$row["profileid"]."\n");
			fclose($logfile);
			return json_encode($com);
		}
		else
		{
			fwrite($logfile, "NO_RECORD\n");
			fclose($logfile);
			return -2;
		}
        }
        function getdata($dbObj, $Current_Status, $dataTag) {
                switch ($dataTag) {
                case "signed":
                        $sql = "SELECT qid, app_join_info.uid AS uid, sno, name, class, time, interviewer FROM app_join_info, app_join_queue WHERE app_join_info.uid = app_join_queue.uid AND round = ".$Current_Status." AND app_join_queue.qstatus = 1 ORDER BY time ASC";
                        $result = $dbObj->query($sql);
                        if($result->num_rows > 0){
	                        while($com = $result->fetch_assoc()) {
                                        $CUser = new UserClass();
                		        $json_str = $CUser->get_userinfo($com["interviewer"]);
                		        $user_obj = json_decode($json_str);
		                        $com["interviewer"] = $user_obj[0]->name;
                                        $signed[] = $com;
                                }
                        }
                        $sql = "SELECT qid, app_join_info.uid AS uid, sno, name, class, time FROM app_join_info, app_join_queue WHERE app_join_info.uid = app_join_queue.uid AND round = ".$Current_Status." AND app_join_queue.qstatus = 0 ORDER BY time ASC";
                        $result = $dbObj->query($sql);
                        if($result->num_rows > 0){
                        	while($com = $result->fetch_assoc())
                        	{
                                        $signed[] = $com;
                                }
                        }
                        return json_encode($signed);
                case "interviewed":
                        $sql = "SELECT qid, app_join_info.uid AS uid, sno, name, class, time, interviewer FROM app_join_info, app_join_queue WHERE app_join_info.uid = app_join_queue.uid AND round = ".$Current_Status." AND app_join_queue.qstatus = 2 ORDER BY time ASC";
                        $result = $dbObj->query($sql);
                        if($result->num_rows > 0){
                        	while($com = $result->fetch_assoc())
                                {
                                        $CUser = new UserClass();
                        		$json_str = $CUser->get_userinfo($com["interviewer"]);
                        		$user_obj = json_decode($json_str);
                        		$com["interviewer"] = $user_obj[0]->name;
                        		$interviewed[] = $com;
                        	}
                        }
                        return json_encode($interviewed);
                }
        }
?>
