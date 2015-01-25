<?php
/**
 * 主要用于admin_xxxx页所需的接口
 * Created by PhpStorm.
 * User: andrew
 * Date: 14-12-27
 * Time: 下午4:20
 */
error_reporting(E_ALL^E_NOTICE^E_WARNING);

require_once('conn.php');
require_once('inject.php');
$admin = new Admin();
//var_dump($admin->getMemberNameByGrade(2012));

class Admin{
    private $con;
    private $inject;

    public function __construct(){
        $this->con = new Csdb();
        $this->inject = new Inject();
    }

    public function getAllGrade(){
        $sql = 'SELECT DISTINCT grade FROM `cs_user` ORDER BY grade DESC ';
        $result = $this->con->query($sql);

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

    public function getMemberNameByGrade($grade){
        if(($grade = $this->inject->inject_number($grade)) == false){
            return false;
        }

        $sql = 'SELECT name,uid FROM `cs_user` WHERE grade='.$grade.' ORDER BY name';
        $result = $this->con->query($sql);

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