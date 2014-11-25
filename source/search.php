<?php
include_once('init.php');
include_once('header.php');
include_once('aside.php');
include_once('footer.php');
include_once('inc/conn.php');
//session_start();
$search = trim($_GET['wd']);
$uidarray = array();
/*$con = mysql_connect("localhost", "root", "15237325183");
if (!$con)
{
  die('Could not connect: ' . mysql_error());
}
mysql_query("SET NAMES 'UTF8'"); 
mysql_query("SET CHARACTER SET UTF8"); 
mysql_query("SET CHARACTER_SET_RESULTS=UTF8'"); 
mysql_select_db("cs_linux", $con);*/
$conn = new Csdb;
$sql = "select * from `cs_updata_info` where message like '%" . $search . "%';";
$result = $conn->query($sql);
if($result->num_rows==0)
{
    $tpl->assign('mannum', $result->num_rows);
    $tpl->assign('quesnum', $result->num_rows);
    $searcharray[] = array("picture"=>"","title"=>"", "writer"=>"","answer"=>"没有相关搜索结果。。。","time"=>"");
    $manArray[] = array("type"=>"","manname"=>"", "inf"=>"无相关人物信息");
}
else
{
        print $result->num_rows;
        $tpl->assign('quesnum',$result->num_rows);
        while($row = mysql_fetch_array($result))
        {
                if($row['appid'] == 1)
                  $picture = "images/w.png";
                else if($row['appid'] == 2)
                  $picture = "images/xm.png";
                else if($row['appid'] == 3)
                  $picture = "images/p.png";
                $uid= $row['uid'];
                $sql = "select * from `cs_user` where uid = '$uid'";
                $namesql = $conn->query($sql);
                $rowi = mysql_fetch_array($namesql);
                if($row['action'] != 1)
                {
                  $searcharray[] = array("picture"=>"$picture","title"=>$row['mdescribe'], "writer"=>$rowi['name'],"answer"=>$row['message'],"time"=>$row['rdate']);
                }      
                if(in_array($uid,$uidarray))
                {
                 // echo "aaa";
                  continue;
                }    
                $uidarray[] = $uid; 
                $manArray[] = array("type"=>"text-success","manname"=>$rowi['name'], "inf"=>$rowi['grade']);
        } 
        $tpl->assign('mannum', count($uidarray));      
}
//mysql_close($con);
$script_list = array('js/search.js');
$tpl->assign('script_list',$script_list);
$tpl->assign('search', $search);
//$tpl->assign('quesnum', 4);
//$tpl->assign('mannum', 3);
$tpl->assign('quesArray', $searcharray);
$tpl->assign('manArray', $manArray);
$tpl->display('header.html');
$tpl->display('aside.html');
$tpl->display('search.html');
$tpl->display('footer.html');
?>
