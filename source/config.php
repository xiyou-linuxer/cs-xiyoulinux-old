<?php
/*配置文件
 * 
 * 此文件主要配置一些常量等等
 * 
 * */

/*网站根目录*/
define('BASE_PATH', dirname(__FILE__));
/**/
define('SITE_DOMAIN','http://dev.xiyoulinux.org/cs_zyj');

/*数据库用户名*/
define('MYSQL_USER_NAME', 'root');
/*数据库密码*/
define('MYSQL_USER_PASSWORD', 'cs-linux');
/*数据库名*/
define('MYSQL_DB_NAME', 'cs_linux');
/*数据库字符集*/
define('MYSQL_CHARSET', 'utf8');

/*Smary相关配置*/
define('SMARTY_HOME_PATH', '/usr/local/lib/php/smarty');
define('SMARTY_CLASS_PATH', SMARTY_HOME_PATH . 'Smarty.class.php');

?>
