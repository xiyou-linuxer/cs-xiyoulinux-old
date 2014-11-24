cs-xiyoulinux
=============


###西邮linux兴趣小组内部交流平台项目


 - doc目录

	关于该项目的**文档**
	
 - source目录
 
 	该项目的**源代码**
 	 - **关键文件说明**
 	 
 	 	- init.php
 	 	
 	 		初始化smarty模板
 	 	- header.php
 	 	
 	 		初始导航栏
 	 	- aside.php
 	 	
 	 		初始化侧栏
 	 	- footer.php
 	 	
 	 		初始化footer
 	 	- index.php
 	 	
 	 		将主页面分成不同的文件，分别引用来显示
 	 	- load_adduser.php
 	 	
 	 		加载小组负责人管理页面
 	 		
 	 	- **templates**
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
 	 		- admin_adduser.html
 	 		
 	 			小组负责人管理页面。这是添加用户页面
