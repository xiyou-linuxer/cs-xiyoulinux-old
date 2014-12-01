<?php
include_once('init.php');
include_once('header.php');
include_once('aside.php');
include_once('footer.php');
include_once('chat.php');
include_once('inc/conn.php');
include_once('check_online.php');
include_once('inc/user.class.php');
$search = trim($_GET['wd']);
$uidarray = array();
$conn = new Csdb;
$user = new User;
$sql = "select * from `cs_updata_info` where message like '%". $search . "%' or mdescribe like '%". $search ."%'";
$result = $conn->query($sql);
$sql = "select * from `cs_user` where name like '%". $search ."%';";
$mansql = $conn->query($sql);
if($result->num_rows==0 || $search == "")
{
    if($serch == "")
    {	
	$tpl->assign('mannum', 0);
    	$tpl->assign('quesnum',0);
    }
    else
    {
    	$tpl->assign('mannum', $result->num_rows);
        $tpl->assign('quesnum', $result->num_rows);
    }
    $searcharray[] = array("picture"=>"","href"=>"","title"=>"", "writer"=>"","answer"=>"没有相关搜索结果。。。","time"=>"");
    /*if($mansql->num_rows==0)
    {
	$tpl->assign('mannum', $result->num_rows);
    	$manArray[] = array("type"=>"","manhref"=>"","manname"=>"", "inf"=>"无相关人物信息");
    }*/
}
else
{
        $tpl->assign('quesnum',$result->num_rows);
        while($row = $result->fetch_assoc())
        {
                $uid= $row['uid'];
                $sql = "select * from `cs_user` where uid = '$uid'";
                $namesql = $conn->query($sql);
                $rowi = $namesql->fetch_assoc();
		$image = $user->get_avatar($uid);
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
                $image = $user->get_avatar($uid);
	        $manhref = "profile.php?uid=".$uid;
                $manArray[] = array("type"=>$type,"manhref"=>$manhref,"manname"=>$rowi['name'], "inf"=>$rowi['grade'],"picture"=>$image);
       */ }
}
if($mansql->num_rows>0 && $search !="")
{
        while($rowi = $mansql->fetch_assoc())
        {   
                $uid = $rowi['uid'];
                if(in_array($uid,$uidarray))
                {   
                        continue;
                }    
                $uidarray[] = $uid;
                $image = $user->get_avatar($uid);
                if(check_online($uid))
                {   
                $type = "text-success";
                }   
                else
                {   
                $type = ""; 
                } 
	        $manhref = "profile.php?uid=".$uid;  
                $manArray[] = array("type"=>$type,"manhref"=>$manhref,"manname"=>$rowi['name'], "inf"=>$rowi['workplace'],"picture"=>$image);
                }   
}
else
{
	if($search == "")
	{
		$tpl->assign('mannum', 0);
	}
	else
	{
	        $tpl->assign('mannum', $mansql->num_rows);
        }
	$manArray[] = array("type"=>"","manhref"=>"","manname"=>"", "inf"=>"无相关人物信息");

}
$tpl->assign('mannum', count($uidarray));
$tpl->assign('search', $search);
$tpl->assign('quesArray', $searcharray);
$tpl->assign('manArray', $manArray);
$tpl->display('header.html');
$tpl->display('aside.html');
$tpl->display('search.html');
$tpl->display('chat.html');
$tpl->display('footer.html');
?>

