# LeafOK BBS

Copyright (C) LeafOK.com, 2001-2026

演示站点位于：https://fenglin.info/bbs/

程序简介
=================
开发语言：PHP (8.2) + MySQL (8.4)  
运行平台：Linux / Windows  
软件性质：源代码采用 GNU GPL 授权发布  
功能说明：  
    基于Web的文章浏览、发表、查找等基本功能和其它各种实用功能，可开设多类别多版块，各版块分设讨论区、文摘区、精华区，并提供全面的版主管理支持。  
    Telnet方式的登陆访问、文章查看、游戏等功能（可选，详见[lbbs](https://github.com/leafok/lbbs)）  


安装和使用说明
=================
1) 数据库结构位于 TODO/sql/db_stru.sql ，需先导入  

2) 将 TODO/conf/ 目录下的文件复制到 conf 目录下（如不存在），并修改  
   数据库连接需要修改conf/db_conn.conf.php  
   邮件发送支持SMTP和本地sendmail两种方式，需要修改conf/smtp.conf.php  

3) 修改 lib/common.inc.php 文件（站点个性化配置）  

4) 创建目录 bbs/cache bbs/upload stat（如果不存在的话），并确保web服务器运行账户拥有写目录 bbs/cache bbs/upload gen_ex stat 的权限  

5) 通过注册页面创建管理员账号等初始账号（涉及多张数据表，不建议直接在数据库中创建）  

6) 在数据库中添加管理员帐号、栏目、版块等（分别位于admin_config、section_class、section_config表）  

7) 管理程序和定时后台作业（需要自行添加crontab）位于 manage 目录下  


Docker用户
=================
可以从源代码位置修改配置后，直接生成镜像并启动容器  
   docker compose up --build -d  

也可以从Docker Hub下载镜像文件  
   docker compose pull  

需要在容器的/var/www/html/conf目录下，修改或导入配置文件  


报告Bug/参与改进
=================
由于本程序源代码采用 GNU GPL 授权发布，如果您发现任何错误或者愿意加入本BBS的开发，请与我们联系。  
E-mail: leaflet@leafok.com  
