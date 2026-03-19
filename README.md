# Task Manager Application

A comprehensive task management system with user authentication, task tracking, reminders, and analytics.

## Installation Guide

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- Web browser (Chrome, Firefox, etc.)

### Installation Steps

1. **Download the Project**
   - Download all project files to your local machine
   - Extract the files if they are in a compressed format

2. **Upload to Web Server**
   - Upload all files to your web server's root directory
   - Common directories:
     - XAMPP: `htdocs/task-manager/`
     - WAMP: `www/task-manager/`
     - Live server: `public_html/task-manager/`

3. **Configure Database Connection**
   - Navigate to `config/database.php`
   - Update the database credentials:
     ```php
     $host = 'localhost';        // Your database host

DEMO Link - https://sandramlworks.liveblog365.com/auth/register.php?i=1     
     $dbname = 'your_database';  // Your database name
     $username = 'your_username'; // Your database username
     $password = 'your_password'; // Your database password
