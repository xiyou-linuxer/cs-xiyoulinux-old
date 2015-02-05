<?php
require_once('init.php');

$mailObj = new MailClass($_COOKIE['uid']);

$json_str = $mailObj->get_mail_list(3);
$mail_info_array = json_decode($json_str);

$mail_info_list= array();
if (!isset($mail_info_array->result)) {
    foreach ( $mail_info_array as $mail_obj ) {
        $item = array(
            'mid'=>$mail_obj->mid,
            'title'=>$mail_obj->title,
            'date'=>$mail_obj->date,
            'fromuser'=>$mail_obj->fromuser,
            'status'=>$mail_obj->status
        );
        array_push($mail_info_list, $item);
    }
}
/*
$last_page = basename($_SERVER['SCRIPT_FILENAME']);
setcookie('last_page',$last_page, time()+3600);
setcookie('mail_type','read', time()+3600);
*/
$smarty->assign('mail_info_list', $mail_info_list);

$smarty->display('mail_list.tpl');
?>
