# LeafOK BBS

Chinese version: [README.zh_CN.md](README.zh_CN.md)

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

### 1. Database Setup
- Import the database structure from `TODO/sql/db_stru.sql`
- *(Optional)* Import test data from `TODO/sql/sample_data.sql`
  - Test account: `sysop`
  - Temporary password (must be changed upon login): `3anzHaNg`

### 2. Configuration
- Copy files from `TODO/conf/` directory to `conf` directory (create if it doesn't exist)
- Modify the following files:
  - Site information: Edit `conf/site.conf.php`
  - Database connection: Edit `conf/db_conn.conf.php`
  - Email sending: Edit `conf/smtp.conf.php` (supports both SMTP and local sendmail)

### 3. Site Customization
- Modify `lib/common.inc.php` for site-specific configurations

### 4. Directory Permissions
- Create directories (if they don't exist):
  - `bbs/cache`
  - `bbs/upload`
  - `stat`
- Ensure the web server user has write permissions for:
  - `bbs/cache`
  - `bbs/upload`
  - `gen_ex`
  - `stat`

### 5. Account Creation
- Create administrator and initial accounts through the registration page
- *Note:* Involves multiple database tables; not recommended to create directly in the database

### 6. Database Setup (Additional)
- Add administrator accounts, categories, and sections in the database
- Relevant tables: `admin_config`, `section_class`, `section_config`

### 7. Management and Background Jobs
- Management programs are located in the `manage` directory
- Scheduled background tasks require adding to crontab

## Docker Users

### Build from Source
```bash
docker compose up --build -d
```

### Download from Docker Hub
```bash
docker compose pull
```

### Configuration
Modify or import configuration files in the container's `/var/www/html/conf` directory.

## Copyright Information
Copyright (C) 2004-2026 Leaflet <leaflet@leafok.com>

## License
This program is free software; you can redistribute it and/or modify it under the terms of the [GNU General Public License](LICENSE) as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.