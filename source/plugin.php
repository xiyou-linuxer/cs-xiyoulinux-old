<?php

	require_once("inc/conn.php");
	get_app_list();

function get_app_list(){
	$handle = opendir("plugin");
	if($handle != false){
		while (false !== ($file = readdir($handle))){
			if($file != '..' && $file != '.'){
				print "$file: ";
				if( is_file("plugin/$file/config.ini") && checkApp("plugin/$file/config.ini")){
					print '正常';
					$conn = new Csdb();
					$status = $conn->query("SELECT `status` FROM `cs_app` where name='$file';");
					if($status == '1')
						print ' 已启用';
					else
						print ' 未启用';
					print "\n";
				}
				else{
					print "配置错误 !\n";
					return false;
				}
			}
		}
    }else{
		print "上层应用目录错误 !\n";
		return false;
	}
		
	return true;
}

function able_app($file){
	if( is_file("plugin/$file/config.ini") && checkApp("plugin/$file/config.ini")){	
		$conn = new Csdb();
		$status = $conn->query("update `cs_app` set status=1 where name='$file';");
		if($status)
			print ' 已启用';
		else
			print ' 未启用';
	}
}

function disable_app($file){
	if( is_file("plugin/$file/config.ini") && checkApp("plugin/$file/config.ini")){	
		$conn = new Csdb();
		$status = $conn->query("update `cs_app` set status=0 where name='$file';");
		if($status)
			print ' 已关闭';
		else
			print ' 未关闭';
	}
}

function checkApp($path){
	$content = file_get_contents($path);
	$result = (preg_match("/\bapp_name: (.+)\b/",$content,$matches) > 0);
	if( !is_file($matches[1]) )
		return false;
	$result &= (preg_match("/\bapp_description: (.+)\b/",$content,$matches) > 0);	
	if( !is_file($matches[1]) )
		return false;
	$result &= (preg_match("/\bperson_path: (.+)\b/",$content,$matches) > 0);	
	if( !is_file($matches[1]) )
		return false;
	$result &= (preg_match("/\badmin_path: (.+)\b/",$content,$matches) > 0);
	if( !is_file($matches[1]) )
		return false;
	return $result;
}

?>
