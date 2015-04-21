<?php
require_once(BASE_PATH . "/includes/db.class.php");
require_once(BASE_PATH . "/includes/user.class.php");
include_once(BASE_PATH . "/includes/activity.class.php");

class LectureClass{
    private $Csdb;

    public function __construct(){
        $this->Csdb = new DBClass();
    }    

    public function add_lecture($uid, $title, $time, $location, $tag, $description, $slide) {
        
        $sql = "INSERT INTO `app_lecture_info` (uid, title, time, location, tag, description, slide) values($uid, '$title', '$time', '$location', '$tag', '$description', '$slide');";

        $result = $this->Csdb->query($sql);
        
        if ($result) {
            $appid_sql = "SELECT appid FROM `cs_app` WHERE name = 'lecture';";
            $appid_result = $this->Csdb->query($appid_sql);
            $row = $appid_result->fetch_assoc();

            $lid_sql = "SELECT lid FROM `app_lecture_info` WHERE uid = '$uid' AND title = '$title' AND time = '$time';";
            $lid_result = $this->Csdb->query($lid_sql);
            $lid_row = $lid_result->fetch_assoc();
            
            $message = "时间：$time<br/>地点：$location";
            
            $activityObj = new ActivityClass();
            $activityObj -> insert_activity($uid, $row["appid"], "《".$title."》", "label-info", "发起讲座", $message, "app/lecture/index.php?lid=".$lid_row["lid"]);
        }

        return $result;
    }
    
    public function del_lecture($lid) {
        $sql = "DELETE FROM `app_lecture_info` WHERE lid = $lid;";

        $result = $this->Csdb->query($sql);

        return $result;
    }
    
    public function update_lecture($lid, $title, $time, $location, $tag, $description, $slide) {
        $sql = "UPDATE `app_lecture_info` SET title = '$title', time = '$time', location = '$location', tag = '$tag', description = '$description', slide = '$slide' WHERE lid = $lid;";

        $result = $this->Csdb->query($sql);

        return $result;
    }

    public function get_lecture_info($lid){
        $sql = "SELECT * FROM `app_lecture_info` WHERE lid=$lid;";
        $result = $this->Csdb->query($sql);
        if( $result->num_rows <= 0 ){
            if( is_object($result) )
                $result->close();
            return false;
        } else {
            $row = $result->fetch_assoc();
            $CUser = new UserClass();
            $json_str = $CUser->get_userinfo($row["uid"]);
            $author = json_decode($json_str);

            $row["lecture_author"] = $author[0]->name;
            $row["lecture_author_avatar"] = $CUser->get_avatar($row["uid"]);

            return $row;
        }
    }
    
    public function get_recent_list(){
        $sql = "SELECT * FROM `app_lecture_info` WHERE time >= now() ORDER BY time ASC;";
        $result = $this->Csdb->query($sql);
        if( $result->num_rows <= 0 ){
            if( is_object($result) )
                $result->close();
            return false;
        } else {
            $lecture_list = array();
            while ($row = $result->fetch_assoc()) {
                $CUser = new UserClass();
                $json_str = $CUser->get_userinfo($row["uid"]);
                $author = json_decode($json_str);

                $row["lecture_author"] = $author[0]->name;
                $row["lecture_author_avatar"] = $CUser->get_avatar($row["uid"]);
                array_push($lecture_list, $row);
            }

            return $lecture_list;
        }
    }
    
    public function get_pass_list(){
        $sql = "SELECT * FROM `app_lecture_info` WHERE time < now() ORDER BY time DESC;";
        $result = $this->Csdb->query($sql);
        if( $result->num_rows <= 0 ){
            if( is_object($result) )
                $result->close();
            return false;
        } else {
            $lecture_list = array();
            while ($row = $result->fetch_assoc()) {
                $CUser = new UserClass();
                $json_str = $CUser->get_userinfo($row["uid"]);
                $author = json_decode($json_str);

                $row["lecture_author"] = $author[0]->name;
                $row["lecture_author_avatar"] = $CUser->get_avatar($row["uid"]);
                array_push($lecture_list, $row);
            }

            return $lecture_list;
        }
    }
    
    public function get_my_list($uid){
        $sql = "SELECT * FROM `app_lecture_info` WHERE uid = $uid;";
        $result = $this->Csdb->query($sql);
        if( $result->num_rows <= 0 ){
            if( is_object($result) )
                $result->close();
            return false;
        } else {
            $lecture_list = array();
            while ($row = $result->fetch_assoc()) {
                $CUser = new UserClass();
                $json_str = $CUser->get_userinfo($row["uid"]);
                $author = json_decode($json_str);

                $row["lecture_author"] = $author[0]->name;
                $row["lecture_author_avatar"] = $CUser->get_avatar($row["uid"]);
                array_push($lecture_list, $row);
            }

            return $lecture_list;
        }
    }
}
?>
