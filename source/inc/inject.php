<?php

function daddslashes($string, $force = 1) 
{
	if (is_array($string)) {
		$keys = array_keys($string);
		foreach ($keys as $key) {
			$val = $string[$key];
			unset($string[$key]);
			$string[addslashes($key)] = daddslashes($val, $force);
		}
	} else {
		$string = htmlspecialchars(addslashes(trim($string)));
	}
	return $string;
}

/*
 *对字符串进行匹配，若有敏感字符返回true,反之false
 * */
function inject_commen($str)
{
    $str = daddslashes($str);
	$lower_str = strtolower($str);

	if (preg_match("/select|insert|update|delete|drop|alter|grant|exec|\'|\/\*|\/\/|\.\.\/|\.\/|union|into|load_file|outfile/", $lower_str))
		return true;
	return false;
}

// 对字符串进行匹配，若能匹配出email地址，则返回email地址，若不能则返回false
function inject_email($str)
{
    $str = daddslashes($str);
	if (preg_match("/[\w!#$%&'*+\/=?^_`{|}~-]+(?:\.[\w!#$%&'*+\/=?^_`{|}~-]+)*@(?:[\w](?:[\w-]*[\w])?\.)+[\w](?:[\w-]*[\w])?/", $str, $matches))
		return $matches[0];
	return false;
}

//对字符串进行匹配，若能匹配出数字，则返回第一串数字，若无数字，则返回false
function inject_number($str)
{
    $str = daddslashes($str);
	if (preg_match("/\d+/", $str, $matches))
	   return $matches[0];
	return false;
}

//对字符串进行匹配，若能匹配出中文，则返回第一串中文字符串，若无中文字符串则返回false。
//注传入中文字符串必须是UTF-8格式否则匹配不出。转化字符集可用iconv
function inject_zh($str)
{
    $str = daddslashes($str);
	if (preg_match("/[\x{4e00}-\x{9fa5}]+/u", $str, $matches))
        return $matches[0];
	return false;

}
?>
