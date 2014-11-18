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

-- DROP DATABASE IF EXISTS `cs_linux`;

-- CREATE DATABASE `cs_linux` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;


use `cs_linux`;


-- --------------------------------------------------------------------------------
-- create user table
-- [cs_user] table name
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
DROP TABLE IF EXISTS `cs_user`;

CREATE TABLE `cs_user` (
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
) AUTO_INCREMENT=1001, DEFAULT CHARSET=utf8; 

-- --------------------------------------------------------------------------------
-- create cs_mail table
-- [cs_mail] table name
-- --------------------------------------------------------------------------------
-- columns
-- [mid]  identification
-- [fromuid] from uid
-- [sdate] Date
-- [title] title
-- [content] content
-- [isdraft] point to whether draft
-- [touser] json string,like {'uid' => 'status'}
-- --------------------------------------------------------------------------------
DROP TABLE IF EXISTS `cs_mail`;

CREATE TABLE `cs_mail` (
	mid     INT UNSIGNED  PRIMARY KEY AUTO_INCREMENT NOT NULL, 
	fromuid INT UNSIGNED  NOT NULL DEFAULT 1000,
	sdate   TIMESTAMP      NOT NULL DEFAULT now(),
	title   CHAR(64)      NOT NULL,
	content TEXT          NOT NULL,
	isdraft INT(1)		NOT NULL DEFAULT 0,
	touser	MEDIUMTEXT	NOT NULL
) AUTO_INCREMENT=1, DEFAULT CHARSET=utf8; 

-- --------------------------------------------------------------------------------
-- create app list table
-- [cs_app_list] table name
-- --------------------------------------------------------------------------------
-- columns
-- [name]  app name
-- [status]  app status 0: not active; 1: active
-- --------------------------------------------------------------------------------
DROP TABLE IF EXISTS `cs_app`;

CREATE TABLE `cs_app` (
	name    CHAR(32)      NOT NULL,
	status  INT(1)        NOT NULL DEFAULT 1
)AUTO_INCREMENT=1, DEFAULT CHARSET=utf8; 
