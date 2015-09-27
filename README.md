### Xiyou Linux Group Collaboration System(CS)

CS系统旨在提供一个方便小组历届成员沟通交流的平台。CS系统分为两大部分：基础服务平台，和应用模块。基础服务平台主要提供数据库的连接服务，以及面向上层应用的RESTful开放接口；应用模块的定义为：和具体业务逻辑紧密相关的模块，包括项目、问答、招聘、基金、活动等。

线上地址：http://cs.xiyoulinux.org

[![Build Status](https://travis-ci.org/xiyou-linuxer/cs-xiyoulinux.svg?branch=master)](https://travis-ci.org/xiyou-linuxer/cs-xiyoulinux)

#### 开发指南

1. **环境搭建**

  ```
  PHP >= 5.5.9 
    - OpenSSL PHP 扩展
    - PDO PHP 扩展
    - Mbstring PHP 扩展
    - Tokenizer PHP 扩展
  Nginx >= 1.9.1
  ```

1. **环境配置**

  ```
  1. nginx虚拟主机配置：

    server {
      listen       80;
      server_name dev.cs.xiyoulinux.org;
      // root为项目代码中public文件夹所在的路径
      root /home/web/cs.xiyoulinux.org/public;
      
      location / {
        index  index.html index.php index.htm;
        try_files $uri $uri/ /index.php?$query_string;
      }

      location ~ \.php$ {
        fastcgi_pass    127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param   SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        include         fastcgi_params;
      }
    }

  2. hosts文件设置
    
    127.0.0.1 dev.xiyoulinux.org
  ```

1. **代码部署**

  ```
  // 拉取线上代码
  git clone https://github.com/xiyou-linuxer/cs-xiyoulinux.git
  
  // 移动代码
  mv cs-xiyoulinux /home/web/cs.xiyoulinux.org
  
  // 安装依赖
  composer install
  
  // 修改权限
  // 注：这里的nginx为启动nginx的用户名，如果没有配置的话，默认为nobody
  chown nginx.nginx storage -R
  chown nginx.nginx bootstrap/cache -R
  
  // 生成配置文件
  cp .env.sample .env
  
  // 生成App Key
  php artisan key:generate
  
  // 更新缓存
  php artisan config:cache
  ```
  
1. **协作开发**

  ```
  // 基于master分支创建新的分支
  // 新功能使用feat-前缀命名, 例如：feat-profile
  // bug修复使用fix-前缀命名，例如：fix-csrf
  git checkout -b xxx
  
  // 编辑代码
  
  // 执行单元测试
  phpunit
  
  // 添加代码
  // git add filename添加单个文件
  // git add . 添加当前文件下所有文件
  // git add -A 添加所有更改（包括删除动作）
  git add xxx
  
  // 提交代码， 评论信息格式同分支名称
  // 新功能使用FEAT-前缀，bug修复使用FIX-前缀
  git commit
  
  // 切换到master分支
  git checkout master
  
  // 拉取线上最新代码
  git pull origin master
  
  // 切换到正在开发的分支
  git checkout xxx
  
  // 使用rebase命令合并master分支，同时可根据需要修改提交历史
  git rebase -i master
  
  // 将开发分支提交到远程分支上
  // 如需覆盖线上分支代码，可加参数-f（注意不要轻易覆盖别人创建的分支）
  git push origin xxx
  
  // 在github上创建pull request，经管理员review之后，并入master分支
  ```
