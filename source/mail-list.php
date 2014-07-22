<table class="table tabel-striped table-bordered table-hover" id="mail_table">
    <thead>
        <tr>
            <th width="300">标题</th>
            <th width="150">时间</th>
            <th width="120">发送者</th>
            <th width="120">状态</th>
		    <th>预览</th>
        </tr>
    </thead>
    <tbody id="mail_table_body" style="cursor:pointer;">
<?php
require_once('inc/conn.php');
require_once('inc/mail.php');

$mailClass = new Mail(1001);

$select = $_GET['select'];

switch($select){
case 'all':
    $var = 3;			//
    cs_all_info($var);
    break;
case 'read':
    $var = 1;
    cs_all_info($var);
    break;
case 'unread':
    $var = 0;
    cs_all_info($var);
    break;
case 'draft':
    $var = 2;
    cs_all_info($var);
    break;
default:
    cs_all_info(3);
}

function cs_all_info($var) {
    $userClass = new Csdb();
    $query_str = "SELECT * FROM cs_mail,cs_mail_user WHERE cs_mail.fromuid = cs_mail_user.touid ;";
    $result = $userClass->query($query_str);
    if( $result->num_rows <= 0 ){
        echo 'false';
        if( is_object($result) )
            $result->close();
        return;
    }

    while( $row = $result->fetch_array(MYSQLI_ASSOC) ){
        $com[] = $row;
    }
    if( is_object($result) )
        $result->close();
    $count_json = count($com);

    for($i = 0;$i < $count_json; $i++)
    {

        $mid = $com[$i]['mid'];
        $title = $com[$i]['title'];
        $sdate = $com[$i]['sdate'];
        $fromuid = $com[$i]['fromuid'];
        $status = $com[$i]['status'];
        $content = $com[$i]['content'];
        
        //
        if($var != 3)
        {
            if($var != $status)
                continue;
        }


        //获取发件人信息
        $query_str = "SELECT name FROM cs_mail_user,cs_user WHERE cs_mail_user.touid=cs_user.uid AND cs_mail_user.touid = $fromuid;";

        $result = $userClass->query($query_str);
        if( $result->num_rows <= 0 ){
            echo 'false';
            if( is_object($result) )
                $result->close();
        }

        while( $row = $result->fetch_array(MYSQLI_ASSOC) ){
            $con[] = $row;
        }
        if( is_object($result) )
            $result->close();

        $fromuser =  $con[0]['name'];

        //获取状态
        if($status == 0)
            $status = "未读";
        else if($status == 1)
            $status = "已读";
        else if($status == 2)
            $status = "草稿";

        echo "	<tr onclick='OnMailClick(this,{$mid})'>";
        echo "<td>{$title}</td>";
        echo "    <td>{$sdate}</td>";
        echo "    <td>{$fromuser}</td>";
        echo "	  <td>{$status}</td>";
        echo "<td>{$content}</td></tr>";

    }
}
?>
    </tbody>
</table>
