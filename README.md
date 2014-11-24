cs-xiyoulinux
=============


###西邮linux兴趣小组内部交流平台项目


 - doc目录

	关于该项目的**文档**
	
 - source目录
 
 	该项目的**源代码**
 	 - ###**源码目录关键文件说明**
 	 
 	 	- init.php
 	 	
 	 		初始化smarty模板
 	 	- header.php
 	 	
 	 		初始并加载导航栏
 	 	- aside.php
 	 	
 	 		初始化并加载侧栏
 	 	- footer.php
 	 	
 	 		初始化并加载footer
 	 	- index.php
 	 	
 	 		将主页面分成不同的文件，分别引用来显示

 	 	- load_ 前缀仅负责加载相应地管理页面，内容从templates里面加载。
 	 	
 	 	     load前缀文件名 |      加载的页面         |加载页面源代码
		  ----------------|------------------------|------------
		  load_adduser.php|**添加用户**页面   |templates/admin_adduser.html
		  load_deluser.php|**删除用户**页面   |templates/admin_deluser.html
		  load_appmanager.php|**应用管理**页面|templates/admin_appmanager.html
		  load_reflash.php|**权限移交**页面   |templates/admin_reflash.html

		- mail- 前缀页面说明

			 mail前缀文件名 | 功能说明
		  ----------------|--------------------
		  	 mail-edit.php|
		 	 mail-read.php|
		   mail-unread.php|
		  	 mail-view.php| 	 
		  	 		
 	 	- ####templates目录(非常重要，所有静态内容都从中加载)
 	 		- header.html
 	 		
 	 			该网页的头，引用的css文件。以及包含最上面的的搜索栏、站内信提醒、用户登录头像。
 	 		- aside.html
 	 		
 	 			最左侧边栏，包含各个应用的按钮。
 	 		- content.html
 	 		
 	 			中间主页面块显示的内容。目前是最新动态。
 	 		- footer.html
 	 		
 	 			文档末尾，包括基本的script标签以及文档闭合标签。
 	 		- mini_aside.html
 	 		
 	 			中间主页面右边小块。
 	 		- chat.html
 	 		
 	 			最右侧的在线列表块。
 	 		- footer.html
 	 		
 	 			补齐上面的html标签，以及引用js文件。
 	 		- admin_ 前缀页面说明，见load_前缀说明。

 	 	- ####server目录(非常重要，负责处理所有的后台逻辑)
