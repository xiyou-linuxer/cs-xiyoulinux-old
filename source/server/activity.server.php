<?php
session_start();
require_once(dirname(dirname(__FILE__)) . '/config.php');
include_once(BASE_PATH . "/includes/activity.class.php");

$action = $_POST["action"];
$action = htmlentities($action,ENT_QUOTES,'UTF-8');
$user_id = $_SESSION["uid"];
$user_id = htmlentities($user_id,ENT_QUOTES,'UTF-8');
//最好用正则过滤，恩
$res = array('state'=>'', 'msg'=>'');

if (!isset($action)) {
    $res['state'] = 'failed';
    $res['msg'] = '非法操作';
    echo json_encode($res);
    exit;
}

if ($action == 'new_act') {
    $msg = $_POST["activity_text"];

    $msg = htmlentities($msg, ENT_QUOTES, 'UTF-8');
    if($msg == "") {
        $res['state'] = 'failed';
        $res['msg'] = '不能发表空动态';
        echo json_encode($res);
        exit;
    }

    $message = "话题：";
    preg_match_all('/#([^#\s]+)#/is', $msg, $topics);
    foreach($topics[1] as $topic) {
        $message = $message.'<label class="label label-info m-l-xs"><a href="' . SITE_DOMAIN . '/search.php?wd=%23' . $topic . '%23" style="color:#fff">' . $topic . '</a></label>';
    }

    if ($message == "话题：") $message = "";

    $activityObj = new ActivityClass();
    $activityObj -> insert_activity($user_id, 0, $msg, "label-success", "发表动态", $message, "#");

    $res['state'] = 'success';
    $res['msg'] = '动态发表成功';
    echo json_encode($res);
}

if ($action == 'new_comment') {
    $act_id = $_POST["act_id"];
    $content = $_POST["content"];
    $content = htmlentities($content, ENT_QUOTES, 'UTF-8');
    if($content == "") {
        $res['state'] = 'failed';
        $res['msg'] = '评论信息不能为空';
        echo json_encode($res);
        exit;
    }

    $activityObj = new ActivityClass();
    $activityObj -> insert_comment($act_id, $user_id, $content);

    $res['state'] = 'success';
    $res['msg'] = '评论发表成功';
    echo json_encode($res);
}

?>
