<?php
	require_once("inc/conn.php");
	require_once("inc/function.php");	
	
class User{
	private $uid;
		
	public __construct($uid){
		$this->$uid = $uid;
	}	
		
	private function add_user($name,$password,$sex,$phone,$mail,$qq,$wechat,
		$blog,$github,$native,$grade,$major,$workplace,$job)
	{
		$permisson = 0;
		if( empty($name) || empty($password) || $sex=="" || empty($mail) || empty($grade) || empty($major) )
			return false;
		$password = md5($password);
		
		$checkArr = array(
			"$name" => "chinese",
			"$password" => 'normal',
			"$sex" => 'digit',
			"$phone"	=> 'phone',
			"$mail" => 'mail',
			"$qq" => 'normal',
			"$wechat" => 'normal',
			"$blog" => 'site',
			"$github" => 'site',
			"$native" => 'chinese',
			"$grade" => 'chinese',
			"$major" => 'chinese',
			"$workplace" => 'chinese',
			"$job"  => 'chinese'
		);
		if( !checkArr($checkArr) )
			return false;
		global $conn;
		$query_str = "SELECT * FROM `cs_user` where name='$name';";
		$result = $conn->query($query_str);
		if( $result->num_rows > 0 ){
			if( is_object($result) )
				$result->close();
			return false;
		}
		$query_str = "INSERT INTO `cs_user`(`name`,`permisson`,`password`,`sex`,`phone`,`mail`,`qq`,`wechat`,`blog`,`github`,`native`,`grade`,`major`,`workplace`,`job`) VALUES ('$name','$permisson','$password','$sex','$phone','$mail','$qq','$wechat','$blog','$github','$native','$grade','$major','$workplace','$job');";
		
		if( is_object($result) )
			$result->close();

		if( $conn->query($query_str) )
			return true;
		return false;
	}
	function del_user(){
		$uid = $this->uid;
		if( !checkStr('digit',$uid) )
			return false;
		
		global $conn;
		$query_str = "SELECT * FROM `cs_user` WHERE uid='$uid';";
		$result = $conn->query($query_str);
		if( $result->num_rows <= 0 ){
			if( is_object($result) )
				$result->close();
			return false;
		}
		$query_str = "DELETE FROM `cs_user` WHERE uid='$uid';";
		
		if( is_object($result) )
			$result->close();

		if( $conn->query($query_str) )
			return true;
		return false;
		
	}
	function get_userinfo($uid){
		if( !checkStr('digit',$uid) ){
			echo 'false';
			exit;
		}	
		
		global $conn;
		$query_str = "SELECT * FROM `cs_user` WHERE uid='$uid';";
		$result = $conn->query($query_str);
		if( $result->num_rows <= 0 ){
			if( is_object($result) )
				$result->close();
			return false;
		}
		while( $row = $result->fetch_assoc() ){
			$com[] = $row;
		}
		unset($com[0]['password']);
		if( is_object($result) )
			$result->close();
		return json_encode($com);
	}
	function update_userinfo($uid,$password,$phoen,$mail,$qq,$wechat,
		$blog,$github,$native,$major,$workplace,$job){
		
		$checkArr = array(
			"$uid" => 'digit', 
			"$password" => 'normal',
			"$phone" => 'phone',
			"$mail" => 'mail',
			"$qq" => 'normal',
			"$wechat" => 'normal',
			"$blog" => 'site',
			"$github" => 'site',
			"$native" => 'chinese',
			"$major" => 'chinese',
			"$workplace" => 'chinese',
			"$job"  => 'chinese'
		);
		if( !checkArr($checkArr) )
			return false;
		
		global $conn;
		$query_str = "SELECT * FROM `cs_user` where uid='$uid';";
		$result = $conn->query($query_str);
		if( $result->num_rows <= 0 ){
			if( is_object($result) )
				$result->close();
			return false;
		}	
		
		$infoArr = array(
			'password' => "'$password'",
			'phone'	=> "'$phone'",
			'mail' => "'$mail'",
			'qq' => "'$qq'",
			'wechat' => "'$wechat'",
			'blog' => "'$blog'",
			'github' => "'$github'",
			'native' => "'$native'",
			'major' => "'$major'",
			'workplace' => "'$workplace'",
			'job' => "'$job'"
		);
		$flag = false;
		while( $value = current($infoArr) ){
			if( $value != "''" ){
				$query_str = "UPDATE `cs_user` set `".key($infoArr)."`=$value;";
				if( !$conn->query($query_str) )
					return false;
				else
					$flag = true;
			}
			next($infoArr);
		}
		if( is_object($result) )
			$result->close();
		if($flag)
			return true;
		return false;
	}
	function get_privilege(){
		$uid = $this->uid;
		if( !checkStr('digit',$uid) )
			return false;
		
		global $conn;
		$query_str = "SELECT * FROM `cs_user` WHERE uid=$uid;";
		$result = $conn->query($query_str);
		if( $result->num_rows <= 0 ){
			if( is_object($result) )
				$result->close();
			return false;
		}
		$row = $result->fetch_assoc();
		return $row['permisson'];
		
		if( is_object($result) )
			$result->close();	
	}
	function deliver_privilege($uid_now,$uid_next){
		if( !checkStr('digit',$uid_now) || !checkStr('digit',$uid_next) )
			return false;
		
		global $conn;
		$query_str1 = "SELECT * FROM `cs_user` WHERE uid=$uid_now;";
		$query_str2 = "SELECT * FROM `cs_user` WHERE uid=$uid_next;";
		$result1 = $conn->query($query_str1);
		$result2 = $conn->query($query_str2);	
		if( $result1->num_rows <= 0 || $result2->num_rows <= 0){
			echo 'false';
			if( is_object($result1) )
				$result1->close();
			if( is_object($result2) )
				$result2->close();
			exit;
		}
		$row1 = $result1->fetch_assoc();
		$row2 = $result2->fetch_assoc();
		if($row1['permisson'] != '1' ||$row2['permisson'] != '0')
			return false;
		$query_str1 = "UPDATE `cs_user` SET permisson=0 WHERE uid=$uid_now;";
		$query_str2 = "UPDATE `cs_user` SET permisson=1 WHERE uid=$uid_next;";	
		$conn->query($query_str1);
		$conn->query($query_str2);
		return true;
		
		if( is_object($result1) )
			$result1->close();
		if( is_object($result2) )
			$result2->close();
	}
	function get_avatar(){
		$uid = $this->uid;
		global $conn;
		$query = "SELECT `mail` FROM `cs_user` WHERE `uid`=$uid;";
		$result = $conn->query($query);
		if( $result->num_rows <= 0)
			return false;
		$row = $result->fetch_assoc();
		$mail = $row['mail'];
		$default = "http://xdth.sinaapp.com/img/man.jpg";
		$size = 150;
		$grav_url = "http://www.gravatar.com/avatar/" .md5(strtolower(trim($mail))) .
			"?d=" .urlencode($default) . "&s=" . $size;
		return $grav_url;
	}
	function check_user(){
		if (checkUser() == false)
			return false;
	}
}
?>
