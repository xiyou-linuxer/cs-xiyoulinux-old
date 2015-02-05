<?php
require_once('init.php');

$search = trim($_GET['wd']);
$uidarray = array();
$dbObj = new DBClass();
$userObj = new UserClass();

$sql = "select * from `cs_activity` where message like '%". $search . "%' or mdescribe like '%". $search ."%'";
$result = $dbObj->query($sql);
$sql = "select * from `cs_user` where name like '%". $search ."%';";
$mansql = $dbObj->query($sql);
if($result->num_rows==0 || $search == "")
{
    if($serch == "")
    {    
    $smarty->assign('mannum', 0);
        $smarty->assign('quesnum',0);
    }
    else
    {
        $smarty->assign('mannum', $result->num_rows);
        $smarty->assign('quesnum', $result->num_rows);
    }
    $searcharray[] = array("picture"=>"","href"=>"","title"=>"", "writer"=>"","answer"=>"没有相关搜索结果。。。","time"=>"");
    /*if($mansql->num_rows==0)
    {
    $smarty->assign('mannum', $result->num_rows);
        $manArray[] = array("type"=>"","manhref"=>"","manname"=>"", "inf"=>"无相关人物信息");
    }*/
} else {
    $smarty->assign('quesnum',$result->num_rows);
    while($row = $result->fetch_assoc())
    {
        $uid= $row['uid'];
        $sql = "select * from `cs_user` where uid = '$uid'";
        $namesql = $dbObj->query($sql);
        $rowi = $namesql->fetch_assoc();
        $image = $userObj->get_avatar($uid);
        $writerhref = "profile.php?uid=".$uid;
        $searcharray[] = array("picture"=>"$image","writerhref"=>$writerhref,"href"=>$row['href'],"title"=>$row['mdescribe'], "writer"=>$rowi['name'],"answer"=>$row['message'],"time"=>$row['rdate']);
        /*  if(in_array($uid,$uidarray))
        {
          continue;
        }
        $uidarray[] = $uid;
        if(check_online($uid))
        {
                $type = "text-success";
        }
        else
        {
                $type = "";
        }
        $image = $userObj->get_avatar($uid);
       $manhref = "profile.php?uid=".$uid;
        $manArray[] = array("type"=>$type,"manhref"=>$manhref,"manname"=>$rowi['name'], "inf"=>$rowi['grade'],"picture"=>$image);
        */ 
    }
}
if($mansql->num_rows>0 && $search !="") {
    while($rowi = $mansql->fetch_assoc()) {   
        $uid = $rowi['uid'];
        if(in_array($uid,$uidarray)) {   
            continue;
        }    

        $uidarray[] = $uid;
        $image = $userObj->get_avatar($uid);
        
        if(check_online($uid)) {   
            $type = "text-success";
        } else {   
            $type = ""; 
        } 
        $manhref = SITE_DOMAIN . "/profile.php?uid=".$uid;  
        $manArray[] = array("type"=>$type,"manhref"=>$manhref,"manname"=>$rowi['name'], "inf"=>$rowi['workplace'],"picture"=>$image);
    }   
} else {
    if($search == "") {
        $smarty->assign('mannum', 0);
    } else {
        $smarty->assign('mannum', $mansql->num_rows);
    }
    
    $manArray[] = array("type"=>"","manhref"=>"","manname"=>"", "inf"=>"无相关人物信息");

}

function check_online($uid){
    $dbObj = new DBClass();
    $time = time()-600;
    $sql = "select * from cs_online where uid=$uid and time>$time;";
    $result = $dbObj->query($sql);
    if($result->num_rows)
        return true;
    else
        return false;
}

$smarty->assign('mannum', count($uidarray));
$smarty->assign('search', $search);
$smarty->assign('quesArray', $searcharray);
$smarty->assign('manArray', $manArray);

$smarty->display('search.tpl');
?>

