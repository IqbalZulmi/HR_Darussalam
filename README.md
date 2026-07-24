<div align="center">

# HR Darussalam

### Human Resource Management System

A modern web-based Human Resource Management application built with **Laravel 11** and **MySQL**.

<br>

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge\&logo=laravel\&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge\&logo=php\&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge\&logo=mysql\&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-Frontend-646CFF?style=for-the-badge\&logo=vite\&logoColor=white)

<br>

**Employee Management · Attendance · Leave Management · Performance Evaluation**

</div>

---

## About HR Darussalam

**HR Darussalam** is a web-based Human Resource Management System designed to simplify and centralize employee administration within Darussalam.

The application provides an integrated platform for managing employee information, positions, attendance, leave requests, user accounts, and employee performance evaluations.

Built with **Laravel 11**, HR Darussalam provides a structured and maintainable foundation for managing HR operations efficiently.

---

## Key Features

### Employee Management

Centralized employee data management for maintaining accurate and up-to-date employee information.

* Add new employees
* View employee records
* Update employee information
* Delete employee records
* View employee details
* Assign positions to employees

---

### Position Management

Manage organizational positions and employee roles.

* Create new positions
* View available positions
* Update position information
* Delete positions
* Assign positions to employees

---

### Attendance Management

Record and monitor employee attendance through a centralized system.

The attendance module helps administrators track employee presence and maintain organized attendance records.

---

### Leave & Permission Management

Manage employee leave and permission requests digitally.

This feature helps streamline administrative processes related to:

* Leave requests
* Permission requests
* Request history
* Employee absence records

---

### User Management & Authentication

Secure authentication and user account management to control access to the HR system.

Features include:

* User authentication
* Login and logout
* User account management
* Secure application access

---

### Employee Performance Evaluation

Evaluate and monitor employee performance through structured assessment records.

Performance evaluation data can be used to:

* Monitor employee performance
* Maintain evaluation history
* Support employee development
* Assist management decision-making

---

## Tech Stack

| Technology   | Description              |
| :----------- | :----------------------- |
| **Laravel**  | Laravel 11               |
| **PHP**      | PHP 8.2+                 |
| **MySQL**    | Relational Database      |
| **Blade**    | Laravel Template Engine  |
| **Vite**     | Frontend Build Tool      |
| **Node.js**  | JavaScript Runtime       |
| **NPM**      | Frontend Package Manager |
| **Composer** | PHP Dependency Manager   |
| **Git**      | Version Control          |
| **GitHub**   | Source Code Repository   |

---

# Getting Started

Follow the instructions below to install and run **HR Darussalam** on your local development environment.

## Prerequisites

Make sure the following software is installed on your system:

```text
PHP >= 8.2
Composer
MySQL
Node.js
NPM
Git
```

You can use a local development environment such as:

* Laragon
* XAMPP
* Laravel Herd
* Docker
* Native PHP Development Server

---

# Installation

## 1. Clone the Repository

Clone the HR Darussalam repository from GitHub:

```bash
git clone https://github.com/USERNAME/hr-darussalam.git
```

Replace the URL above with the actual GitHub repository URL.

Navigate into the project directory:

```bash
cd hr-darussalam
```

---

## 2. Install PHP Dependencies

Install Laravel dependencies using Composer:

```bash
composer install
```

Wait until all dependencies have been successfully installed.

---

## 3. Install Frontend Dependencies

Install Node.js dependencies:

```bash
npm install
```

---

## 4. Create Environment File

Copy `.env.example` into `.env`.

### Linux / macOS

```bash
cp .env.example .env
```

### Windows CMD

```cmd
copy .env.example .env
```

### Windows PowerShell

```powershell
Copy-Item .env.example .env
```

---

## 5. Generate Application Key

Generate the Laravel application key:

```bash
php artisan key:generate
```

Laravel will automatically add the generated key to your `.env` file.

---

# Database Configuration

## 1. Create the Database

Create a new MySQL database:

```sql
CREATE DATABASE hr_darussalam;
```

You can also create the database using:

* phpMyAdmin
* HeidiSQL
* MySQL Workbench
* TablePlus
* DBeaver

---

## 2. Configure Environment Variables

Open the `.env` file and configure the application:

```env
APP_NAME="HR Darussalam"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000
```

Configure your MySQL connection:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hr_darussalam
DB_USERNAME=root
DB_PASSWORD=
```

If your MySQL server requires a password:

```env
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

Make sure the credentials match your local MySQL configuration.

---

# Database Migration

Run Laravel migrations to create the required database tables:

```bash
php artisan migrate
```

If the project includes database seeders:

```bash
php artisan db:seed
```

Alternatively, run migration and seeding together:

```bash
php artisan migrate --seed
```

> Only run the seeder command if the project provides the required database seeders.

---

## Resetting the Database

During development, you can rebuild the entire database using:

```bash
php artisan migrate:fresh
```

To rebuild and seed the database:

```bash
php artisan migrate:fresh --seed
```

> **Warning:** `migrate:fresh` deletes all existing database tables and their data.

Do not use this command on a production database unless you fully understand the consequences.

---

# Storage Configuration

If HR Darussalam stores employee photos, documents, attachments, or other uploaded files using Laravel Storage, create the symbolic link:

```bash
php artisan storage:link
```

This links:

```text
public/storage
```

to:

```text
storage/app/public
```

---

# Running the Application

## Start Laravel Development Server

Run:

```bash
php artisan serve
```

The application should be available at:

```text
http://127.0.0.1:8000
```

or:

```text
http://localhost:8000
```

---

## Start Vite Development Server

Open another terminal and run:

```bash
npm run dev
```

During development, keep both commands running:

```bash
php artisan serve
```

and:

```bash
npm run dev
```

Then open:

```text
http://localhost:8000
```

in your browser.

---

# Quick Installation

For experienced Laravel developers, the basic installation process is:

```bash
git clone https://github.com/USERNAME/hr-darussalam.git

cd hr-darussalam

composer install
npm install

cp .env.example .env

php artisan key:generate
```

Configure your database inside `.env`, then run:

```bash
php artisan migrate
php artisan storage:link
```

Start Vite:

```bash
npm run dev
```

Open another terminal and start Laravel:

```bash
php artisan serve
```

HR Darussalam should now be available at:

```text
http://localhost:8000
```

---

# Installation Flow

```text
┌───────────────────────────┐
│     Clone Repository      │
└─────────────┬─────────────┘
              │
              ▼
┌───────────────────────────┐
│     Composer Install      │
└─────────────┬─────────────┘
              │
              ▼
┌───────────────────────────┐
│        NPM Install        │
└─────────────┬─────────────┘
              │
              ▼
┌───────────────────────────┐
│      Configure .env       │
└─────────────┬─────────────┘
              │
              ▼
┌───────────────────────────┐
│    Generate APP_KEY       │
└─────────────┬─────────────┘
              │
              ▼
┌───────────────────────────┐
│   Create MySQL Database   │
└─────────────┬─────────────┘
              │
              ▼
┌───────────────────────────┐
│     Run Migrations        │
└─────────────┬─────────────┘
              │
              ▼
┌───────────────────────────┐
│     Storage Linking       │
└─────────────┬─────────────┘
              │
              ▼
┌───────────────────────────┐
│ npm run dev + artisan     │
│          serve            │
└─────────────┬─────────────┘
              │
              ▼
        HR Darussalam
        Ready to Use
```

---

# Project Structure

The project follows the standard Laravel directory structure:

```text
hr-darussalam/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   ├── Models/
│   └── Providers/
│
├── bootstrap/
│
├── config/
│
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
│
├── public/
│
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│
├── routes/
│   ├── console.php
│   └── web.php
│
├── storage/
│
├── tests/
│
├── .env.example
├── .gitignore
├── artisan
├── composer.json
├── package.json
├── phpunit.xml
├── vite.config.js
└── README.md
```

### Important Directories

| Directory              | Purpose                            |
| :--------------------- | :--------------------------------- |
| `app/Http/Controllers` | Application controllers            |
| `app/Models`           | Eloquent models                    |
| `database/migrations`  | Database table structures          |
| `database/seeders`     | Initial database data              |
| `resources/views`      | Blade templates                    |
| `resources/css`        | Application stylesheets            |
| `resources/js`         | JavaScript files                   |
| `routes/web.php`       | Web application routes             |
| `public`               | Publicly accessible assets         |
| `storage`              | Application files, logs, and cache |
| `config`               | Laravel configuration files        |

---

# Production Build

Before deploying the application to production, build the frontend assets:

```bash
npm run build
```

For production environments, make sure your `.env` contains:

```env
APP_ENV=production
APP_DEBUG=false
```

Never enable Laravel debug mode in production.

---

# Useful Artisan Commands

### Clear Application Cache

```bash
php artisan cache:clear
```

### Clear Configuration Cache

```bash
php artisan config:clear
```

### Clear Route Cache

```bash
php artisan route:clear
```

### Clear Compiled Views

```bash
php artisan view:clear
```

### Clear All Optimization Cache

```bash
php artisan optimize:clear
```

### List Application Routes

```bash
php artisan route:list
```

### Run Tests

```bash
php artisan test
```

---

# Updating the Application

To retrieve the latest changes from GitHub:

```bash
git pull origin main
```

Install or update PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Run any new database migrations:

```bash
php artisan migrate
```

Clear Laravel caches:

```bash
php artisan optimize:clear
```

Rebuild frontend assets when required:

```bash
npm run build
```

> Make sure your local changes have been committed or backed up before running `git pull`.

---

# Troubleshooting

## Application Key Error

If you encounter:

```text
No application encryption key has been specified.
```

Run:

```bash
php artisan key:generate
php artisan config:clear
```

---

## Database Connection Error

Verify the database configuration in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hr_darussalam
DB_USERNAME=root
DB_PASSWORD=
```

Make sure:

* MySQL is running.
* The `hr_darussalam` database exists.
* The database username is correct.
* The database password is correct.
* The database port is correct.

After modifying `.env`, run:

```bash
php artisan config:clear
```

---

## Vite Manifest Not Found

If you encounter a Vite manifest error, install the frontend dependencies:

```bash
npm install
```

For development:

```bash
npm run dev
```

For production:

```bash
npm run build
```

---

## Storage Files Are Not Accessible

Create the Laravel storage symbolic link:

```bash
php artisan storage:link
```

On a Linux production server, also make sure the web server has appropriate permissions for:

```text
storage/
bootstrap/cache/
```

---

## Environment Changes Are Not Applied

Clear Laravel's cached configuration:

```bash
php artisan optimize:clear
```

Then restart the application if necessary.

---

# Security

When deploying HR Darussalam, follow standard Laravel security practices.

* Never commit `.env` to Git.
* Never expose database credentials publicly.
* Use strong passwords for user accounts.
* Set `APP_DEBUG=false` in production.
* Use HTTPS in production.
* Restrict access according to user roles and permissions.
* Keep Laravel and dependencies updated.
* Regularly back up the database.
* Protect employee and HR-related information appropriately.

Example production configuration:

```env
APP_ENV=production
APP_DEBUG=false
```

---

# Development

Create a new branch before developing a feature:

```bash
git checkout -b feature/feature-name
```

After making changes:

```bash
git add .
git commit -m "feat: add feature name"
```

Push the branch:

```bash
git push origin feature/feature-name
```

Then create a Pull Request on GitHub.

---

# Contributing

Contributions to HR Darussalam should follow the project's development workflow.

1. Clone the repository.
2. Create a new feature or fix branch.
3. Implement your changes.
4. Test your changes.
5. Commit your changes.
6. Push the branch.
7. Create a Pull Request.

Example branch naming:

```text
feature/attendance
feature/performance-evaluation
feature/employee-management

fix/attendance-validation
fix/login-redirect
fix/employee-form
```

Example commit messages:

```text
feat: add employee performance evaluation

feat: implement leave request

fix: resolve attendance validation issue

refactor: improve employee controller
```

---

# Application Information

| Information             | Details                          |
| :---------------------- | :------------------------------- |
| **Application**         | HR Darussalam                    |
| **Type**                | Human Resource Management System |
| **Platform**            | Web Application                  |
| **Framework**           | Laravel 11                       |
| **Language**            | PHP                              |
| **Database**            | MySQL                            |
| **Frontend Build Tool** | Vite                             |

---

# Main Modules

```text
HR Darussalam
│
├── Authentication
│   ├── Login
│   └── User Management
│
├── Employee Management
│   ├── Employee Data
│   └── Employee Details
│
├── Position Management
│   └── Employee Positions
│
├── Attendance
│   └── Attendance Records
│
├── Leave & Permission
│   ├── Leave Requests
│   └── Permission Requests
│
└── Performance Evaluation
    ├── Employee Evaluation
    └── Evaluation Records
```

---

# Roadmap

Potential future improvements for HR Darussalam may include:

* [ ] Employee dashboard
* [ ] Advanced role and permission management
* [ ] Attendance reports
* [ ] Leave approval workflow
* [ ] Employee performance reports
* [ ] PDF report export
* [ ] Excel report export
* [ ] Email notifications
* [ ] Employee document management
* [ ] HR analytics dashboard

---

# License

The use and distribution of **HR Darussalam** are subject to the policies established by the project owner and the Darussalam organization.

If this application is intended for internal use, redistribution, modification, or publication of the source code should follow the organization's applicable policies.

---

<div align="center">

## HR Darussalam

**Simplifying Human Resource Management**

Built with Laravel 11 & MySQL

<br>

`Employee Management` · `Attendance` · `Leave Management` · `Performance Evaluation`

</div>
