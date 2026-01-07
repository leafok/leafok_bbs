# LeafOK BBS

## Program Overview
=================
**Development Language:** PHP (8.2) + MySQL (8.4)  
**Platform:** Linux / Windows  
**License:** Source code released under GNU GPL license  
**Features:**  
    - Web-based article browsing, posting, searching, and other basic functions  
    - Support for multiple categories and sections, each with discussion areas, digest areas, and featured areas  
    - Comprehensive moderator management support  
    - Optional Telnet access for login, article viewing, games, etc. (see [lbbs](https://github.com/leafok/lbbs) for details)  
Demo site: https://fenglin.info/bbs/

## Installation and Usage Instructions
=================
1) **Database Setup:** Import the database structure from `TODO/sql/db_stru.sql`  
   *(Optional)* Import test data from `TODO/sql/sample_data.sql`. Test account: `sysop`, temporary password (must be changed upon login): `3anzHaNg`  

2) **Configuration:** Copy files from `TODO/conf/` directory to `conf` directory (create if it doesn't exist), then modify:  
   - Database connection: Edit `conf/db_conn.conf.php`  
   - Email sending: Supports both SMTP and local sendmail. Edit `conf/smtp.conf.php`  

3) **Site Customization:** Modify `lib/common.inc.php` for site-specific configurations  

4) **Directory Permissions:** Create directories `bbs/cache`, `bbs/upload`, and `stat` (if they don't exist). Ensure the web server user has write permissions for directories: `bbs/cache`, `bbs/upload`, `gen_ex`, and `stat`  

5) **Account Creation:** Create administrator and initial accounts through the registration page (involves multiple database tables; not recommended to create directly in the database)  

6) **Database Setup:** Add administrator accounts, categories, and sections in the database (tables: `admin_config`, `section_class`, `section_config`)  

7) **Management and Background Jobs:** Management programs and scheduled background tasks (requires adding to crontab) are located in the `manage` directory  

## Docker Users
=================
You can build and start the container directly from the source code location after modifying configurations:  
   ```bash
   docker compose up --build -d
   ```

Alternatively, download the image from Docker Hub:  
   ```bash
   docker compose pull
   ```

Modify or import configuration files in the container's `/var/www/html/conf` directory  

## Copyright Information
=================
Copyright (C) 2004-2026 Leaflet <leaflet@leafok.com>  

## License
==================
This program is free software; you can redistribute it and/or modify 
it under the terms of the [GNU General Public License](LICENSE) as published by 
the Free Software Foundation; either version 3 of the License, or    
(at your option) any later version.   
