cs-xiyoulinux
=============

###西邮linux兴趣小组内部交流平台项目


本项目为西邮linux兴趣小组11~12级成员合作开发的小组内部交流平台项目


###文件结构

 - doc目录

	关于该项目的**需求文档**、**接口文档**等等
	
 - source目录
 
 	该项目的**源代码**

  	- init.php
  	
  		初始化smarty模板、登录判别
  	- header.php
  	
  		包含init.php文件、顶部导航栏模板变量赋值
  	- aside.php
  	
  		左侧导航栏模板变量赋值
  	- footer.php
  	
  		暂无。。。
	--config.php
		项目运行环境配置文件，详情请参见[配置文件](readme.md)

  	- 管理后台模块
  	
  	  文件名               |功能                    |模板页面
	  ---------------------|------------------------|------------
	  load_adduser.php     |**添加用户**页面        |templates/admin_adduser.tpl
	  load_deluser.php     |**删除用户**页面        |templates/admin_deluser.tpl
	  load_appmanager.php  |**应用管理**页面        |templates/admin_appmanager.tpl
	  load_reflash.php     |**权限移交**页面        |templates/admin_reflash.tpl

	- 站内信模块

	  文件名               | 功能                   |模板页面
	  ---------------------|------------------------|-------------
	  mail_edit.php        |**写站内信**页面        |templates/mail_edit.tpl
	  mail_all.php         |**所有站内信**页面      |templates/mail_list.tpl
	  mail_unread.php      |**未读站内信**页面      |templates/mail_list.tpl
	  mail_read.php        |**已读站内信**页面      |templates/mail_list.tpl
	  mail_draft.php       |**站内信草稿**页面      |templates/mail_list.tpl
	  mail_view.php        |**站内信阅读**页面      |templates/mail_view.tpl	 
	  	 		
  	- ####templates目录(存放smarty模板文件)
  	
	  文件名               |描述
	  ---------------------|-------------------------------------
 	  header.tpl           |文档类型、head标签(包含页面设置，共用css文件等。***[未闭合]***)
  	  header_nav.tpl       |head标签闭合、body标签（***[未闭合]***）、header标签（顶部导航栏）
  	  aside.tpl            |aside标签（左侧导航栏）
  	  chat.tpl             |aside标签（右侧在线成员列表）
  	  script.tpl           |共用js文件加载、共用js代码
	  footer.tpl           |body标签闭合、html标签闭合

  	- ####server目录(异步请求处理脚本文件)
  	
	  文件名               |描述
          ---------------------|--------------------------------------
