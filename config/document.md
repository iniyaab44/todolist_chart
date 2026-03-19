# Task Manager Application Documentation

## Table of Contents
1. [Project Definition](#project-definition)
2. [Features Overview](#features-overview)
3. [Installation Guide](#installation-guide)
4. [Database Structure](#database-structure)
5. [Script Changes and Updates](#script-changes-and-updates)
6. [How to Run](#how-to-run)
7. [Usage Guide](#usage-guide)
8. [Conclusion](#conclusion)

---

## Project Definition

### Project Overview
Task Manager is a comprehensive web-based application designed to help users organize, track, and manage their daily tasks efficiently. The system provides user authentication, task management, and visual analytics to enhance productivity and task organization.

### Purpose
The primary purpose of this application is to provide users with a centralized platform to:
- Create and manage personal tasks
- Track task completion and progress
- Analyze task patterns through visual charts
- Maintain organized records of all activities

### Target Users
- Individuals managing personal tasks
- Small teams coordinating work
- Students organizing assignments
- Professionals tracking deadlines
- Anyone needing task organization tools

---

## Features Overview

### Core Features
1. **User Authentication**
   - Secure registration and login
   - Password hashing for security
   - Session management
   - Show/hide password toggle with eye icon

2. **Task Management**
   - Create new tasks with details
   - Add task numbers, titles, descriptions
   - Set dates and times (12-hour format)
   - View all tasks in organized table

3. **Analytics Dashboard**
   - Pie charts for task distribution
   - Line charts for task trends
   - Visual representation of data
   - Multi-color chart displays

4. **Responsive Design**
   - Mobile-friendly interface
   - Tablet and desktop optimized
   - 800px width containers for forms
   - Adaptive layouts

### New Features Added
- **Show/Hide Password Toggle**: Eye icon inside password fields for better UX
- **Improved Form Spacing**: CSS-based spacing instead of `<br>` tags
- **Header Customization**: Hidden header on login/register pages for cleaner interface
- **Centered Titles**: "Task Manager" title centered in body
- **Left-aligned Navigation**: Navigation links on left corner in home page
- **Black Text**: Improved visibility with black text in header and footer

---

## Installation Guide

### System Requirements
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- Modern web browser

### Step-by-Step Installation

#### 1. Server Setup
- Install XAMPP/WAMP/MAMP for local development
- Or configure live hosting with PHP/MySQL support
- Ensure all services are running

#### 2. File Deployment
- Download all project files
- Upload to web server directory
- Maintain folder structure as provided
- Set appropriate file permissions (folders: 755, files: 644)

#### 3. Configuration
- Navigate to `config/database.php`
- Update database connection parameters:
  ```php
  $host = 'localhost';
  $dbname = 'your_database_name';
  $username = 'your_username';
  $password = 'your_password';
