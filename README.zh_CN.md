# LeafOK BBS

## 程序简介
=================
**开发语言：** PHP (8.2) + MySQL (8.4)  
**运行平台：** Linux / Windows  
**授权许可：** 源代码采用 GNU GPL 授权发布  
**功能说明：**  
    - 基于Web的文章浏览、发表、查找等基本功能和其它各种实用功能  
    - 支持多类别多版块，各版块分设讨论区、文摘区、精华区  
    - 提供全面的版主管理支持  
    - 可选Telnet方式的登陆访问、文章查看、游戏等功能（详见[lbbs](https://github.com/leafok/lbbs)）  
演示站点：https://fenglin.info/bbs/

## 安装和使用说明
=================
1) **数据库设置：** 导入数据库结构文件 `TODO/sql/db_stru.sql`  
   *(可选)* 导入测试数据 `TODO/sql/sample_data.sql`。测试账户：`sysop`，临时密码（登陆时需修改）：`3anzHaNg`  

2) **配置文件：** 将 `TODO/conf/` 目录下的文件复制到 `conf` 目录下（如不存在），然后修改：  
   - 数据库连接：编辑 `conf/db_conn.conf.php`  
   - 邮件发送：支持SMTP和本地sendmail两种方式，编辑 `conf/smtp.conf.php`  

3) **站点个性化配置：** 修改 `lib/common.inc.php` 文件  

4) **目录权限：** 创建目录 `bbs/cache`、`bbs/upload` 和 `stat`（如果不存在）。确保Web服务器运行账户对以下目录有写权限：`bbs/cache`、`bbs/upload`、`gen_ex`、`stat`  

5) **账户创建：** 通过注册页面创建管理员账号等初始账号（涉及多张数据表，不建议直接在数据库中创建）  

6) **数据库设置：** 在数据库中添加管理员帐号、栏目、版块等（分别位于 `admin_config`、`section_class`、`section_config` 表）  

7) **管理和后台作业：** 管理程序和定时后台作业（需要自行添加crontab）位于 `manage` 目录下  

## Docker用户
=================
可以从源代码位置修改配置后，直接生成镜像并启动容器：  
   ```bash
   docker compose up --build -d
   ```

也可以从Docker Hub下载镜像文件：  
   ```bash
   docker compose pull
   ```

需要在容器的 `/var/www/html/conf` 目录下，修改或导入配置文件  

## 版权信息
=================
版权所有 (C) 2004-2026 Leaflet <leaflet@leafok.com>  

## 授权许可
==================
本程序是自由软件；  
您可以按照自由软件基金会发布的[GNU通用发布许可](LICENSE)  
的第三版或后续版本的条款，分发和/或修改本程序。