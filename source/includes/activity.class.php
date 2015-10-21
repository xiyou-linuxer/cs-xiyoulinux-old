<?php
require_once(dirname(__FILE__) . "/db.class.php");
require_once(dirname(__FILE__) . "/user.class.php");

class ActivityClass {
    private $dbObj;

    public function __construct(){
        $this->dbObj = new DBClass();
    }

    public function get_activity($arg, $arg1, $arg2 = "", $arg3 = ""){
        switch($arg){
        case 'index':
            $query_str = "select * from cs_activity order by mid desc limit $arg1," . ($arg1+1)  . ";";
            break;
        case 'mid':
            $query_str = "select * from cs_activity where mid<$arg1 order by mid desc limit $arg2," . ($arg2+1)  . ";";
            break;
        case 'uid':
            $query_str = "select * from cs_activity where uid=$arg1 order by mid desc limit $arg2," . ($arg2+1)  . " ;";
            break;
        case 'uid_mid':
            $query_str = "select * from cs_activity where uid=$arg1 and mid<$arg2 order by mid desc limit $arg3," . ($arg3+1)  . " ;";
            break;
        default:
            return false;
            break;
        }
        $mresult = $this->dbObj->query($query_str)->fetch_assoc();
        if(!isset($mresult['uid']))
            return false;
        $uid = $mresult['uid'];
        $mid = $mresult['mid'];
        $href = $mresult['href'];

        $query_str = "select name from cs_user where uid=$uid;";
        $uresult = $this->dbObj->query($query_str)->fetch_assoc();
    
        $name = $uresult['name'];
        $action = json_decode($mresult['action']);
        $action_text = $action->{'text'};
        $action_color = $action->{'color'};
        $des = $mresult['mdescribe'];
        $message = $mresult['message'];
        $userObj = new UserClass();
        $avatar = $userObj->get_avatar($uid);

        $time = $this->encode_time($mresult['rdate']);

        $array = array(
            "name" => $name,
            "actiontext" => $action_text,
            "actioncolor" => $action_color,
            "mdescribe" => $des,
            "message" => $message,
            "time" => $time,
            "avatar" => $avatar,
            "mid" => $mid,
            "profile" => "profile.php?uid=" . $uid,
            "href" => $href,
        );
        return $array;
    }

    public function insert_activity($uid, $appid, $mdescribe, $action_color, $action_text, $message, $href) {
        $sql = "insert into cs_activity (uid, appid, mdescribe, action, message, href)
             values($uid, $appid, '$mdescribe', '{\"color\":\"$action_color\",\"text\":\"$action_text\"}', '$message', '$href');";
        $this->dbObj->query($sql, "insert updata error");
    }

    public function get_comments($act_id) {
        $query_str = "select * from cs_activity_comment where act_id=$act_id order by create_at desc;";

        $result = $this->dbObj->query($query_str);
        $array = array();
        if (is_object($result)) {
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $array[] = $row;
                }
            }
        }


        $userObj = new UserClass();
        foreach ($array as $key => $item) {
            $author_id = $item['author_id'];
            $query_str = "select name from cs_user where uid=$author_id;";
            $user = $this->dbObj->query($query_str)->fetch_assoc();
            $array[$key]['author_name'] = $user['name'];
            $array[$key]['author_avatar'] = $userObj->get_avatar($author_id);

            $array[$key]['create_at'] = $this->encode_time($item['create_at']);
        }

        return $array;
    }

    public function insert_comment($act_id, $author_id, $content) {
        if (!$act_id || !$author_id || !$content) {
            return false;
        }

        $sql = "insert into cs_activity_comment (act_id, author_id, content)
             values($act_id, $author_id, '$content');";
        $this->dbObj->query($sql, 'insert comment failed');
    }

    private function encode_time($time) {
        date_default_timezone_set("PRC");
        $a = strtotime($time);
        $b = time() - $a;
        if($b < 1*60)
            $ret = ($b-floor($b/60)*60) . "秒前";
        else if($b <= 5*60)
            $ret = floor($b/60) . "分钟" . ($b-floor($b/60)*60) . "秒前";
        else if($b < 1*3600)
            $ret = floor($b/60) . "分钟前";
        else if($b < 24*3600)
            $ret = floor($b/3600) . "小时前";
        else if($b <= 24*3600*7)
            $ret = floor($b/3600/24) . "天前";
        else
            $ret = $time;

        return $ret;
    }
}

?>
