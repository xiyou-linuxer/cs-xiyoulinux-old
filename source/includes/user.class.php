<?php
    require_once(dirname(__FILE__) . "/db.class.php");
    require_once(dirname(__FILE__) . "/functions.php");
    
class UserClass{
    private $dbObj;

    public function __construct(){
        $this->dbObj = new DBClass();
    }    
        
    public function add_user($name,$password,$sex,$phone,$mail,$qq,$wechat,
        $blog,$github,$native,$grade,$major,$workplace,$job)
    {
        $privilege = 0;
        if( empty($name) || empty($password) || $sex=="" || empty($mail) || empty($grade) || empty($major) )
            return false;
        $password = md5($password);
        
        $checkArr = array(
            "$name" => "chinese",
            "$password" => 'normal',
            "$sex" => 'digit',
            "$phone"=> 'phone',
            "$mail" => 'mail',
            "$qq" => 'qq',
            "$wechat" => 'weixin',
            "$blog" => 'site',
            "$github" => 'site',
            "$native" => 'chinese',
            "$grade" => 'digit',
            "$major" => 'chinese',
            "$workplace" => 'chinese',
            "$job"  => 'chinese'
        );
        if( !checkArr($checkArr) )
            return false;

        if (!empty($mail) && $this->check_data($mail, 'mail', $uid))
            return false;
         
        if (isset($phone) && $this->check_data($phone, 'phone', $uid)){
            return false;
        }

        $query_str = "SELECT * FROM `cs_user` where name='$name';";
        $result = $this->dbObj->query($query_str);
        if( $result->num_rows > 0 ){
            if( is_object($result) )
                $result->close();
            return false;
        }
        $query_str = "INSERT INTO `cs_user`(`name`,`privilege`,`password`,`sex`,`phone`,`mail`,`qq`,`wechat`,`blog`,`github`,`native`,`grade`,`major`,`workplace`,`job`) VALUES ('$name','$privilege','$password','$sex','$phone','$mail','$qq','$wechat','$blog','$github','$native','$grade','$major','$workplace','$job');";
        if( is_object($result) )
            $result->close();

        if( $this->dbObj->query($query_str) )
            return true;
        return false;
    }

    public function del_user($uid){
        if( !checkStr('digit',$uid) )
            return false;
        
        $query_str = "SELECT * FROM `cs_user` WHERE uid='$uid';";
        $result = $this->dbObj->query($query_str);
        if( $result->num_rows <= 0 ){
            if( is_object($result) )
                $result->close();
            return false;
        }
        $query_str = "DELETE FROM `cs_user` WHERE uid='$uid';";
        
        if( is_object($result) )
            $result->close();

        if( $this->dbObj->query($query_str) )
            return true;
        return false;
        
    }
    
    public function get_userinfo($uid){
        if( !checkStr('digit',$uid) ){
            return false;
        }
        
        $query_str = "SELECT * FROM `cs_user` WHERE uid='$uid';";
        $result = $this->dbObj->query($query_str);
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

    public function update_userinfo($uid,$phone,$mail,$qq,$wechat,$blog,$github,$native,$major,$workplace,$job)
    {
        if ( $this->check_user($uid) )
            return false;
        
    	$checkArr = array(
            "$uid" => 'digit',
            "$phone" => 'phone',
            "$mail" => 'mail',
            "$qq" => 'qq',
            "$wechat" => 'weixin',
            "$blog" => 'site',
            "$github" => 'site',
            "$native" => 'chinese',
            "$major" => 'chinese',
            "$workplace" => 'chinese',
            "$job"  => 'chinese'
        );

        if( !checkArr($checkArr) )
                return false;
        if (empty($mail) && $this->check_data($mail, 'mail', $uid))
            return false;

        if (!isset($phone) && $this->check_data($phone, 'phone', $uid)){
            return false;
        }

        $sql = "UPDATE `cs_user` SET phone='$phone',mail='$mail',qq='$qq',wechat='$wechat', blog='$blog',github='$github',native='$native',major='$major',workplace='$workplace',job='$job' WHERE uid='$uid'";

        $link = new DBClass();
        $result = $link->query($sql);

        if ($result)
            return true;
        return false;
    }
    /*public function update_userinfo($uid,$password,$phone,$mail,$qq,$wechat,
        $blog,$github,$native,$major,$workplace,$job){

        if ( $this->check_user($uid) )
            return false;

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
        
        $query_str = "SELECT * FROM `cs_user` where uid='$uid';";
        $result = $this->dbObj->query($query_str);
        if( $result->num_rows <= 0 ){
            if( is_object($result) )
                $result->close();
            return false;
        }    
        
        $infoArr = array(
            'password' => "'$password'",
            'phone'    => "'$phone'",
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
                if( !$this->dbObj->query($query_str) )
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
    */
    public function get_privilege($uid){
        if( !checkStr('digit',$uid) )
            return false;
        
        $query_str = "SELECT * FROM `cs_user` WHERE uid=$uid;";
        $result = $this->dbObj->query($query_str);
        if( $result->num_rows <= 0 ){
            if( is_object($result) )
                $result->close();
            return false;
        }
        $row = $result->fetch_assoc();
        return $row['privilege'];
        
        if( is_object($result) )
            $result->close();    
    }
    public function deliver_privilege($uid_now,$uid_next){
        if( !checkStr('digit',$uid_now) || !checkStr('digit',$uid_next) )
            return false;
        
        $query_str1 = "SELECT * FROM `cs_user` WHERE uid=$uid_now;";
        $query_str2 = "SELECT * FROM `cs_user` WHERE uid=$uid_next;";
        $result1 = $this->dbObj->query($query_str1);
        $result2 = $this->dbObj->query($query_str2);    
        if( $result1->num_rows <= 0 || $result2->num_rows <= 0){
            if( is_object($result1) )
                $result1->close();
            if( is_object($result2) )
                $result2->close();
            return false;

        }
        $row1 = $result1->fetch_assoc();
        $row2 = $result2->fetch_assoc();
        if($row1['privilege'] != '1' ||$row2['privilege'] != '0')
            return false;
        $query_str1 = "UPDATE `cs_user` SET privilege=0 WHERE uid=$uid_now;";
        $query_str2 = "UPDATE `cs_user` SET privilege=1 WHERE uid=$uid_next;";    
        $this->dbObj->query($query_str1);
        $this->dbObj->query($query_str2);

        if( is_object($result1) )
            $result1->close();
        if( is_object($result2) )
            $result2->close();
        return true;

    }

    public function get_avatar($uid){
        $query = "SELECT `mail` FROM `cs_user` WHERE `uid`=$uid;";
        $result = $this->dbObj->query($query);
        if( $result->num_rows <= 0)
            return false;
        $row = $result->fetch_assoc();
        $mail = $row['mail'];
        $size = 150;
        $grav_url = "http://gravatar.duoshuo.com/avatar/" .md5(strtolower(trim($mail))) . "?d=mm&s=" . $size;
        return $grav_url;
    }

    private function check_user($uid){
        if (checkUser($uid) == false)
            return false;
    }

    /*by liaoshengxin 2015.01.14  22:17*/
    /***检查是否存在邮箱或者手机，若存在则返回true,不存在则返回false***/
    public function check_data($data, $tag, $uid=0){
        if (is_null($data) || ($data == '')){
                return false;
        }

        $uid_selector = ($uid == 0) ? "" : " uid != " . $uid;

        if($tag == 'phone'){
            $sql = "select * from cs_user where" . $uid_selector . " phone='$data';";
            $result = $this->dbObj->query($sql);
            if($result->num_rows > 0) {
                return true;
            }
            else {
                return false;
            }
        } else if($tag == 'mail') {
            $sql = "select * from cs_user where" . $uid_selector . " mail='$data';";

            $result = $this->dbObj->query($sql);
            if($result->num_rows > 0)
                return true;
            else
                return false;
		}
        return true;
    }

    public function get_user_list($state="online") {
        $time = time() - 600;

        switch ($state) {
            case 'online':
                $sql = "SELECT cs_user.name, cs_user.uid, cs_user.workplace, cs_online.time FROM cs_user, cs_online WHERE cs_online.uid=cs_user.uid AND cs_online.time > " . $time . ";";
                break;
            case 'offline':
                $sql = "SELECT cs_user.name, cs_user.uid, cs_user.workplace, cs_online.time FROM cs_user, cs_online WHERE cs_online.uid=cs_user.uid AND cs_online.time < " . $time . ";";          
                break;
            case 'all':
                $sql = "SELECT cs_user.name, cs_user.uid, cs_user.workplace, cs_online.time FROM cs_user, cs_online WHERE cs_online.uid=cs_user.uid;";
                break;
            default:
                break;
        }

        $result = $this->dbObj->query($sql) or die(mysql_error());

        return $result;
    }
}
?>
