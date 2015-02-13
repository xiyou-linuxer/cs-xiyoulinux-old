<?php
require_once(dirname(dirname(__FILE__)) . '/config.php');
require_once(BASE_PATH . '/includes/user.class.php');
require_once(BASE_PATH . '/includes/activity.class.php');

$action = $_POST['action'];

switch($action)
{
    case 'update_userinfo':
        $uid = $_POST['uid'];
        $phone = $_POST['phone'];
        $mail = $_POST['mail'];
        $workplace = $_POST['workplace'];
        $job = $_POST['job'];
        $grade = $_POST['grade'];
        $major = $_POST['major'];
        $qq = $_POST['qq'];
        $wechat = $_POST['wechat'];
        $blog = $_POST['blog'];
        $github = $_POST['github'];
        //$native = "西安";
        $native = null;
        $grade = trim($grade);
        $workplace = trim($workplace);

        $userObj = new UserClass();
        print $userObj->update_userinfo($uid,$phone,$mail,$qq,$wechat,$blog,$github,$native,$major,$workplace,$job);
        exit;
    case 'refresh_activity':
        $mid = $_POST['mid'];
        $uid = $_POST['uid'];

        $result = "";
        for($i = 0; $i < 5; ++$i){
            $b = get_message($uid, $mid, $i);
            if($b == 'false'){
                if($result == "")
                    $result = 'false';
                break;
            }
            $result .= $b;
        }
        print $result;
        exit;

    default :
        return ;
}

function get_message($uid, $mid, $start){
    $a = new ActivityClass();
    $m = $a->get_activity("uid_mid", $uid, $mid, $start);

    if(!$m)
        return 'false';
    $result="<article class='comment-item' mid=" . $m['mid']  . ">
            <a class='pull-left thumb-sm avatar'>
                <img src='" . $m['avatar']  . "' alt='...'></a>
            <span class='arrow left'></span>
            <section class='comment-body panel panel-default'>
            <header class='panel-heading'>
            <a href='" . $m['profile']  . "'>".$m['name']."
            </a>
            <label class='label " . $m['actioncolor']  . " m-l-xs'>" . $m['actiontext'] . "</label>
            <span class='text-muted m-l-sm pull-right'> <i class='fa fa-clock-o'></i>
            ".$m['time']."</span>
            </header>
            <div class='panel-body'>
            <h4><a href=\"".$m['href']."\">".$m['mdescribe']."</a></h4>
            <div class='panel-body'>
                <blockpanel-bodyquote>
                    <p>".$m['message']."</p>
                </blockquote>
            </div>
            </div>
            </section>
            </article>";

    return $result;
}
?>
