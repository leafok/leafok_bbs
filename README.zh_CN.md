# LeafOK BBS

英文版本: [README.md](README.md)

## 目录
- [程序简介](#程序简介)
- [安装和使用说明](#安装和使用说明)
  - [前置条件和所需库](#1-前置条件和所需库)
  - [数据库设置](#2-数据库设置)
  - [配置文件](#3-配置文件)
  - [站点个性化配置](#4-站点个性化配置)
  - [目录权限](#5-目录权限)
  - [账户创建](#6-账户创建)
  - [附加数据库设置](#7-数据库设置附加)
  - [管理和后台作业](#8-管理和后台作业)
- [Docker部署](#docker部署)
  - [快速开始](#快速开始)
  - [从源代码构建](#从源代码构建)
  - [使用预构建镜像](#使用预构建镜像)
  - [Docker配置](#docker配置)
  - [Docker Compose服务](#docker-compose服务)
  - [常用Docker命令](#常用docker命令)
  - [持久化数据](#持久化数据)
- [版权信息](#版权信息)
- [授权许可](#授权许可)

## 程序简介

**开发语言：** PHP (8.2) + MySQL (8.4)  
**运行平台：** Linux / Windows  
**授权许可：** 源代码采用 GNU GPL 授权发布  

**功能说明：**
- 基于Web的文章浏览、发表、查找等基本功能和其它各种实用功能
- 支持多类别多版块，各版块分设讨论区、文摘区、精华区
- 提供全面的版主管理支持
- **高级搜索功能：**
  - 支持中文的Solr全文搜索
- **现代架构：**
  - 重构的轻量级标记语言（LML）渲染器，性能更优
  - 支持用户时区，本地化日期/时间显示
  - 主要功能支持主题定制
- 可选Telnet方式的登陆访问、文章查看、游戏等功能（详见[lbbs](https://github.com/leafok/lbbs)）

**演示站点：** https://fenglin.info/bbs/

## 安装和使用说明

### 1. 前置条件和所需库
- **PHP 8.2+** 和 **MySQL 8.4+** 已安装
- 使用包管理器安装 Composer（例如 `apt`、`yum`，或从 [getcomposer.org](https://getcomposer.org/) 下载）
- 在项目根目录运行以下命令：
```bash
composer install --prefer-dist --no-scripts --no-progress
```

### 2. 数据库设置
- 导入数据库结构文件 `TODO/sql/db_stru.sql`
- *(可选)* 导入测试数据 `TODO/sql/sample_data.sql`
  - 测试账户：`sysop`
  - 临时密码（首次登陆时需修改）：`3anzHaNg`

### 3. 配置文件
- 将 `TODO/conf/` 目录下的文件复制到 `conf` 目录下（如不存在）
- 修改以下文件：
  - 站点信息：编辑 `conf/site.conf.php`
  - 数据库连接：编辑 `conf/db_conn.conf.php`
  - 邮件发送：编辑 `conf/smtp.conf.php`（支持SMTP和本地sendmail两种方式）
- **Solr搜索**（可选）：如需使用Solr进行高级搜索，编辑 `conf/solr.conf.php`
  - 默认配置假设Solr运行在 `localhost:8983`，核心为 `lbbs`
  - 根据需要更新主机名、端口、认证信息和路径
  - 将 `TODO/solr/schema.json` 中的架构导入到核心 `lbbs`
  - 使用PHP扩展安装工具PIE安装pecl/solr扩展

### 4. 站点个性化配置
- 修改 `lib/common.inc.php` 文件

### 5. 目录权限
- 创建目录（如果不存在）：
  - `bbs/cache`
  - `bbs/upload`
  - `stat`
- 确保Web服务器运行账户对以下目录有写权限：
  - `bbs/cache`
  - `bbs/upload`
  - `gen_ex`
  - `stat`

### 6. 账户创建
- 通过注册页面创建管理员账号等初始账号
- *注意：* 涉及多张数据表，不建议直接在数据库中创建

### 7. 数据库设置（附加）
- 在数据库中添加管理员帐号、栏目、版块等
- 相关数据表：`admin_config`、`section_class`、`section_config`

### 8. 管理和后台作业
- 管理程序位于 `manage` 目录下
- 定时后台作业需要自行添加crontab

## Docker部署

### 快速开始
```bash
# 克隆仓库
git clone https://github.com/leafok/leafok_bbs.git
cd leafok_bbs

# 使用 Docker Compose 启动
docker compose up -d
```

### 从源代码构建
```bash
docker compose up --build -d
```

### 使用预构建镜像
```bash
# 从 Docker Hub 拉取最新镜像
docker compose pull

# 启动容器
docker compose up -d
```

### Docker配置
1. Web 应用将在 `http://localhost:8080` 可用
2. 配置文件应放置在 `conf/` 目录（在容器中挂载到 `/var/www/html/conf`）
3. 修改配置：
   - 将文件从 `TODO/conf/` 复制到 `conf/` 目录
   - 根据需要编辑配置文件
   - 重启容器：`docker compose restart`

### Docker Compose服务
- **web**: Apache HTTP 服务器与 PHP 8.2
- **db**: MySQL 8.4 数据库
- **phpmyadmin**: 数据库管理界面（可选，在 `http://localhost:8081` 可用）

### 常用Docker命令
```bash
# 查看日志
docker compose logs -f

# 停止容器
docker compose down

# 重新构建并重启
docker compose up --build -d

# 进入容器 shell
docker compose exec web bash
```

### 持久化数据
- 数据库数据存储在 Docker 卷中（`leafok_bbs_db_data`）
- 上传的文件和缓存存储在挂载的主机目录中

## 版权信息
版权所有 (C) 2001-2026 Leaflet <leaflet@leafok.com>

## 授权许可
本程序是自由软件；您可以按照自由软件基金会发布的[GNU通用发布许可](LICENSE)的第三版或后续版本的条款，分发和/或修改本程序。
