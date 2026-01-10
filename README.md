# LeafOK BBS

Chinese version: [README.zh_CN.md](README.zh_CN.md)

## Table of Contents
- [Program Overview](#program-overview)
- [Installation and Usage Instructions](#installation-and-usage-instructions)
  - [Prerequisites and Required Libraries](#1-prerequisites-and-required-libraries)
  - [Database Setup](#2-database-setup)
  - [Configuration](#3-configuration)
  - [Site Customization](#4-site-customization)
  - [Directory Permissions](#5-directory-permissions)
  - [Account Creation](#6-account-creation)
  - [Additional Database Setup](#7-database-setup-additional)
  - [Management and Background Jobs](#8-management-and-background-jobs)
- [Docker Deployment](#docker-deployment)
  - [Quick Start](#quick-start)
  - [Build from Source](#build-from-source)
  - [Using Pre-built Images](#using-pre-built-images)
  - [Configuration for Docker](#configuration-for-docker)
  - [Docker Compose Services](#docker-compose-services)
  - [Common Docker Commands](#common-docker-commands)
  - [Persistent Data](#persistent-data)
- [Copyright Information](#copyright-information)
- [License](#license)

## Program Overview

**Development Language:** PHP (8.2) + MySQL (8.4)  
**Platform:** Linux / Windows  
**License:** Source code released under GNU GPL license  

**Features:**
- Web-based article browsing, posting, searching, and other basic functions
- Support for multiple categories and sections, each with discussion areas, digest areas, and featured areas
- Comprehensive moderator management support
- Optional Telnet access for login, article viewing, games, etc. (see [lbbs](https://github.com/leafok/lbbs) for details)

**Demo site:** https://fenglin.info/bbs/

## Installation and Usage Instructions

### 1. Prerequisites and Required Libraries
- **PHP 8.2+** and **MySQL 8.4+** installed
- Install Composer using your package manager (e.g., `apt`, `yum`, or from [getcomposer.org](https://getcomposer.org/))
- Run the following command in the project root directory:
```bash
composer install --prefer-dist --no-scripts --no-progress
```

### 2. Database Setup
- Import the database structure from `TODO/sql/db_stru.sql`
- *(Optional)* Import sample data from `TODO/sql/sample_data.sql`
  - Test account: `sysop`
  - Temporary password (must be changed upon first login): `3anzHaNg`

### 3. Configuration
- Copy files from `TODO/conf/` directory to `conf` directory (create if it doesn't exist)
- Modify the following files:
  - Site information: Edit `conf/site.conf.php`
  - Database connection: Edit `conf/db_conn.conf.php`
  - Email sending: Edit `conf/smtp.conf.php` (supports both SMTP and local sendmail)

### 4. Site Customization
- Modify `lib/common.inc.php` for site-specific configurations

### 5. Directory Permissions
- Create directories (if they don't exist):
  - `bbs/cache`
  - `bbs/upload`
  - `stat`
- Ensure the web server user has write permissions for:
  - `bbs/cache`
  - `bbs/upload`
  - `gen_ex`
  - `stat`

### 6. Account Creation
- Create administrator and initial accounts through the registration page
- *Note:* Involves multiple database tables; not recommended to create directly in the database

### 7. Database Setup (Additional)
- Add administrator accounts, categories, and sections in the database
- Relevant tables: `admin_config`, `section_class`, `section_config`

### 8. Management and Background Jobs
- Management programs are located in the `manage` directory
- Scheduled background tasks require adding to crontab

## Docker Deployment

### Quick Start
```bash
# Clone the repository
git clone https://github.com/leafok/leafok_bbs.git
cd leafok_bbs

# Start with Docker Compose
docker compose up -d
```

### Build from Source
```bash
docker compose up --build -d
```

### Using Pre-built Images
```bash
# Pull the latest images from Docker Hub
docker compose pull

# Start the containers
docker compose up -d
```

### Configuration for Docker
1. The web application will be available at `http://localhost:8080`
2. Configuration files should be placed in `conf/` directory (mounted to `/var/www/html/conf` in the container)
3. To modify configuration:
   - Copy files from `TODO/conf/` to `conf/` directory
   - Edit the configuration files as needed
   - Restart the container: `docker compose restart`

### Docker Compose Services
- **web**: Apache HTTP Server with PHP 8.2
- **db**: MySQL 8.4 database
- **phpmyadmin**: Database management interface (optional, available at `http://localhost:8081`)

### Common Docker Commands
```bash
# View logs
docker compose logs -f

# Stop containers
docker compose down

# Rebuild and restart
docker compose up --build -d

# Access container shell
docker compose exec web bash
```

### Persistent Data
- Database data is stored in a Docker volume (`leafok_bbs_db_data`)
- Uploaded files and cache are stored in mounted host directories

## Copyright Information
Copyright (C) 2004-2026 Leaflet <leaflet@leafok.com>

## License
This program is free software; you can redistribute it and/or modify it under the terms of the [GNU General Public License](LICENSE) as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.