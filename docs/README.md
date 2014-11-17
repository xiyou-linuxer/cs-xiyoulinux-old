cs-xiyoulinux
=============


###西邮linux兴趣小组内部交流平台项目

## 前后端对接说明
*************************

* 基本上所有的页面都应该遵循以下规范实现对接
	
    ```vim
	<?php

	include_once('init.php');

	include_once('header.php');

	include_once('aside.php');

	include_once('footer.php');
	```
	

* 1. 添加该页面用到的样式文件，以数组的形式替换header.html模板中的style_list变量

	2. 如果页面不需要单独引用任何的外部css文件，可省略改代码段

	```vim
	$style_list = array (

   	 'css/stylesheet1.css',

     'css/stylesheet2.css',

     ...

    'css/stylesheet.css'

	);

	$tpl->assign('style_list', $style_list);
	```


* 1. 添加该页面用到的js脚本文件，以数组的形式替换footer.html模板中的script_list变量
  2. 如果页面不需要单独引用任何的外部JS文件，可省略改代码段
  
  ```vim

	$script_list = array (

    'js/script1.js',

    'js/script2.js',

    ...

    'js/scriptn.js'

	);

$tpl->assign('script_list', $script_list);
	```


* 获取必要的数据，并给相应的模板变量赋值

	[[data] assign]


* **注意这里，header,aside,模板,footer必须以这样的次序，并且一个都不能少（特殊页面除外，如登录页面）**
	```vim

	$tpl->display('header.html');

	$tpl->display('aside.html');

	$tpl->display('模板.html');

	$tpl->display('footer.html');

	?>
	```
