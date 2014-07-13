/**********************************************************************************
* File Name: db_linux.sql
*----------------------------------------------------------------------------------
* Created Date: 2014-05-28 20:42:37
* Created By:Jensyn
* Version: 1.0
*----------------------------------------------------------------------------------
* Modified Date:2014-06-07 15:20:22
* Modified By:Jensyn
* Version:1.1
***********************************************************************************/

-- --------------------------------------------------------------------------------
-- create the database if not exists
-- [linux_project] database name 
-- --------------------------------------------------------------------------------

DROP DATABASE IF EXISTS `linux_project`;

CREATE DATABASE `linux_project` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;


use `linux_project`;


-- --------------------------------------------------------------------------------
-- create user table
-- [tb_user] table name
-- --------------------------------------------------------------------------------
-- columns
-- [uid]        the unique identification of user, auto incrment, and start from 1001
-- [name]       user name not null, and unchanged
-- [permisson]  0: normal; 1:admin
-- [password]   user password
-- [sex]        unchanged
-- [phone]
-- [mail]
-- [qq]
-- [wechat]
-- [blog]
-- [github]
-- [native]     native place, birth place
-- [graduation] graduation year
-- [major]
-- [workplace]
-- [job]
-- --------------------------------------------------------------------------------
DROP TABLE IF EXISTS `sys_user`;

CREATE TABLE `sys_user` (
	uid         INT UNSIGNED  PRIMARY KEY AUTO_INCREMENT NOT NULL, 
	name        CHAR(10)  NOT NULL,
	permisson   INT(1)    NOT NULL DEFAULT 0,
	password    CHAR(32)  NOT NULL, 
	sex         INT(1)    NOT NULL, 
	phone       CHAR(20)  NULL, 
	mail        CHAR(50)  NOT NULL, 
	qq          CHAR(12)  NULL, 
	wechat      CHAR(32)  NULL,
	blog        CHAR(128) NULL, 
	github      CHAR(128) NULL, 
	native      CHAR(128) NULL, 
	grade       CHAR(4)   NOT NULL, 
	major       CHAR(32)  NOT NULL, 
	workplace   CHAR(128) NULL,
	job         CHAR(32)  NULL
) AUTO_INCREMENT=1001; 

-- --------------------------------------------------------------------------------
-- create mail table
-- [tb_user_mail] table name
-- --------------------------------------------------------------------------------
-- columns
-- [umid]    the unique identification of mail, auto incrment, and start from 1
-- [fromuid] from_user' uid
-- [touid]   to_user' uid
-- [sdate]   send date
-- [status]  read status, 0: not read; 1: read yet
-- [title]   mail title
-- [content] mail context
-- --------------------------------------------------------------------------------

DROP TABLE IF EXISTS `sys_mail`;

CREATE TABLE `sys_mail` (
	mid     INT UNSIGNED  PRIMARY KEY AUTO_INCREMENT NOT NULL, 
	fromuid INT UNSIGNED  NOT NULL DEFAULT 1000,
	touid   INT UNSIGNED  NOT NULL,
	sdate   DATETIME      NOT NULL DEFAULT now(),
	status  INT(1)        NOT NULL DEFAULT 0,
	title   CHAR(64)      NOT NULL,
	content TEXT          NOT NULL
) AUTO_INCREMENT=1; 

-- --------------------------------------------------------------------------------
-- create user app table
-- [tb_user_app] table name
-- --------------------------------------------------------------------------------
-- columns
-- [uid]     user id
-- [aid]     app id
-- [status]  app status 0: not active; 1: active
-- [path]    app path
-- --------------------------------------------------------------------------------

DROP TABLE IF EXISTS `tb_user_app`;

CREATE TABLE `tb_user_app` (
	uid     INT UNSIGNED  PRIMARY KEY NOT NULL, 
	aid     INT UNSIGNED  NOT NULL,
	status  INT           NOT NULL DEFAULT 0,
	path    CHAR(128)     NOT NULL
); 

-- --------------------------------------------------------------------------------
-- create app list table
-- [tb_app_list] table name
-- --------------------------------------------------------------------------------
-- columns
-- [aid]   app id
-- [name]  app name
-- [path]  app path
-- [status]  app status 0: not active; 1: active
-- --------------------------------------------------------------------------------

DROP TABLE IF EXISTS `sys_app`;

CREATE TABLE `sys_app` (
	aid     INT UNSIGNED  PRIMARY KEY AUTO_INCREMENT NOT NULL, 
	name    CHAR(32)      NOT NULL,
	path    CHAR(128)     NOT NULL,
	status  INT(1)        NOT NULL DEFAULT 1,
)AUTO_INCREMENT=1; 

-- insert test
-- user
INSERT INTO `tb_user` (name, password, sex, mail, grade, major) VALUES('张森', 'TdfsF3425DFD4SEW32dfT', '男', 'zhangsen@xoyoulinux.org', '12级', '软件工程');
INSERT INTO `tb_user` (name, password, sex, phone, mail, qq, blog, github, native, grade, major) VALUES('张永军', 'TdfsF3425DFD4SEW32dfT', '男', '130********', 'zhangyongjun@xoyoulinux.org', '910******', '***.zhangyongjun.org', 'https://github.com/***', '陕西', '12级', '计算机科学与技术');

-- mail
INSERT INTO `tb_user_mail` (touid, sdate, status, title, content) VALUES(1001, now(), 0, '第二次会议记录', '本次会议到此结束，谢谢');

INSERT INTO `tb_user_app` VALUES(1001, 1, 0, 'app/donate/');
