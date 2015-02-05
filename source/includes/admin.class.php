<?php
/**
 * 主要用于admin_xxxx页所需的接口
 * Created by PhpStorm.
 * User: andrew
 * Date: 14-12-27
 * Time: 下午4:20
 */
error_reporting(E_ALL^E_NOTICE^E_WARNING);

require_once(dirname(__FILE__) . '/db.class.php');
require_once(dirname(__FILE__) . '/inject.class.php');

class AdminClass{
    private $dbObj;
    private $injectObj;

    public function __construct(){
        $this->dbObj = new DBClass();
        $this->injectObj = new InjectClass();
    }

    public function get_all_grade(){
        $sql = 'SELECT DISTINCT grade FROM `cs_user` ORDER BY grade DESC ';
        $result = $this->dbObj->query($sql);

        if ($result->num_rows <= 0){
            if(is_object($result)){
                $result->close();
            }
            return false;
        }

        while ($grade = $result->fetch_assoc()){
            $grades[] = $grade;
        }

        if ( is_object($result)){
            $result->close();
        }

        return json_encode($grades);
    }

    public function get_member_name_by_grade($grade){
        if(($grade = $this->injectObj->inject_number($grade)) == false){
            return false;
        }

        $sql = 'SELECT name,uid FROM `cs_user` WHERE grade='.$grade.' ORDER BY name';
        $result = $this->dbObj->query($sql);

        if ($result->num_rows <= 0){
            if ( is_object($result)){
                $result->close();
            }
            return false;
        }

        while ($name = $result->fetch_assoc()){
            $names[] = $name;
        }

        if ( is_object($result)){
            $result->close();
        }

        return json_encode($names);
    }

}
?>