        <div class="panel panel-default mail-list-panel">
            <table class="table table-striped table-bordered table-hover" id="mail_table">
                <thead>
                    <tr>
                        <th width="300">标题</th>
                        <th class="text-center" width="150">时间</th>
                        <th class="text-center" width="120">发送者</th>
                        <th class="text-center" width="120">状态</th>
		                <th>预览</th>
                    </tr>
                </thead>
                <tbody id="mail_table_body" style="cursor:pointer;">
<?php
$select = $_GET['select'];

switch($select){
case 'all':
    $var = 0;			
    break;
case 'unread':
    $var = 1;
    break;
case 'read':
    $var = 2;
    break;
case 'draft':
    $var = 3;
    break;
default:
    exit;
}

set_mail_list($var);

function set_mail_list($var) {
    $mailClass = new Mail($_SESSION['uid']);
    $mid_json = $mailClass->cs_get_recvmids($var);
    $mid_array = json_decode($mid_json);

    if (count($mid_array) == 0) {
        return;
    }

    //var_dump($mid_array);

    foreach ($mid_array as $mid_obj) {
        if ($mid_obj == null) {
            continue;
        }
  //      echo $mid_obj->mid;
        $mail_json = $mailClass->cs_get_mail($mid_obj->mid, 0, 0);
        $mail_obj = json_decode($mail_json);
        
        if (mail_obj == null) {
            continue;
        }

        if ($mail_obj->status == 0) {
            $mail_obj->status = '未读'; 
            $label_class = 'label-warning';
        } else {
            $mail_obj->status ='已读';
            $label_class = 'label-success';
        }
        $mail_obj->content = substr_utf8($mail_obj->content, 0, 25, 1);
        $user_json = cs_get_userinfo($mail_obj->fromuid);
        $user_obj = json_decode($user_json);

        echo "<tr onclick='OnMailClick({$mid_obj->mid})'>";
        echo "  <td>{$mail_obj->title}</td>";
        echo "  <td class='text-center'>{$mail_obj->sdate}</td>";
        echo "  <td class='text-center'>{$user_obj->name}</td>";
        echo "	<td class='text-center'><span class=\"label {$label_class}\">&nbsp;{$mail_obj->status}&nbsp;</label></td>";
        echo "  <td>{$mail_obj->content}</td>";
        echo "</tr>";
    }
}
?>
                </tbody>
            </table>
        </div>
        <!--END PANEL-->
    <!--END COL-MD-10 -->

<!--END ROW-->
