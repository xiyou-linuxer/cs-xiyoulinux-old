<?

include_once('init.php');

//测试数据
//$Dynamics_name = '林达意';
//$Dynamics_action = '提问';
//$Dynamics_time = '1小时';
//$Dynamics_contents = "挖掘机到底哪家强?";

$script_list = array(
	'js/jquery.mousewheel.js',
	'js/fresh.js'
);
$tpl->assign('script_list', $script_list);
	
$Dynamics_array = array(
array( "name" => "林达意", "action" => "提问", "time" => "1小时前", "contents" => "挖掘机到底哪家强？" ),
array( "name" => "李翔", "action" => "回答", "time" => "1小时前","contents" => "挖掘机到底哪家强?</br>皇家西邮！" ),
array( "name" => "林达意", "action" => "发表", "time" => "1小时前", "contents" => "《浅谈挖掘机技术》</br>咱就是实打实的学本领，不玩虚的，你学挖掘机就把地挖好，你学厨师就把菜做好，你学裁缝就把衣服做好。咱们蓝翔如果不踏踏实实学本事，那跟清华北大还有什么区别呢？" )
);



//$tpl->assign( 'Dynamics_name', $Dynamics_name );
//$tpl->assign( 'Dynamics_action', "提问");
//$tpl->assign( 'Dynamics_time', $Dynamics_time );
//$tpl->assign( 'Dynamics_content', $Dynamics_contents);

$tpl->assign( "Dynamics_array", $Dynamics_array );

?>