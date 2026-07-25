<div align="center">

# HR Darussalam

### Human Resource Management System

A web-based Human Resource Management application built with **Laravel 11** and **MySQL**.

<br>

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge\&logo=laravel\&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge\&logo=php\&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge\&logo=mysql\&logoColor=white)
![Composer](https://img.shields.io/badge/Composer-Dependency_Manager-885630?style=for-the-badge\&logo=composer\&logoColor=white)

<br>

**Employee Management · Attendance · Leave Management · Performance Evaluation**

</div>

---

## About HR Darussalam

**HR Darussalam** is a web-based Human Resource Management System designed to simplify and centralize employee administration within Darussalam.

The application provides an integrated platform for managing employee information, positions, attendance, leave and permission requests, user accounts, and employee performance evaluations.

Built with **Laravel 11** and **MySQL**, HR Darussalam provides a structured and maintainable solution for managing day-to-day human resource operations.

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

### Position Management

Manage organizational positions and employee roles.

* Create new positions
* View available positions
* Update position information
* Delete positions
* Assign positions to employees

### Attendance Management

Record and monitor employee attendance through a centralized system.

The attendance module helps administrators maintain employee attendance records and monitor employee presence.

### Leave & Permission Management

Manage employee leave and permission requests digitally.

This module can be used to manage:

* Leave requests
* Permission requests
* Request history
* Employee absence records

### User Management & Authentication

Secure authentication and user account management to control access to the HR system.

Features include:

* User authentication
* Login and logout
* User account management
* Secure application access

### Employee Performance Evaluation

Evaluate and monitor employee performance through structured assessment records.

Performance evaluation data can be used to:

* Monitor employee performance
* Maintain evaluation history
* Support employee development
* Assist management decision-making

---

## Tech Stack

| Technology   | Description             |
| :----------- | :---------------------- |
| **Laravel**  | Laravel 11              |
| **PHP**      | PHP 8.2+                |
| **MySQL**    | Relational Database     |
| **Blade**    | Laravel Template Engine |
| **Composer** | PHP Dependency Manager  |
| **Git**      | Version Control         |
| **GitHub**   | Source Code Repository  |

---

# Getting Started

Follow the instructions below to install and run **HR Darussalam** on your local development environment.

## Prerequisites

Make sure the following software is installed on your system:

```text id="jx5dt6"
PHP >= 8.2
Composer
MySQL
Git
```

You can use a local development environment such as:

* Laragon
* XAMPP
* Laravel Herd
* Docker
* Native PHP environment

---

# Installation

## 1. Clone the Repository

Clone the repository from GitHub:

```bash id="r7dkr7"
git clone https://github.com/USERNAME/hr-darussalam.git
```

Replace the repository URL above with the actual HR Darussalam GitHub repository.

Navigate into the project directory:

```bash id="9w2u4q"
cd hr-darussalam
```

---

## 2. Install PHP Dependencies

Install the required Laravel dependencies using Composer:

```bash id="z81plz"
composer install
```

Wait until Composer finishes installing all required dependencies.

---

## 3. Create the Environment File

Copy `.env.example` into `.env`.

### Linux / macOS

```bash id="7iv4qa"
cp .env.example .env
```

### Windows CMD

```cmd id="3xofl1"
copy .env.example .env
```

### Windows PowerShell

```powershell id="oy8h2k"
Copy-Item .env.example .env
```

---

## 4. Generate Application Key

Generate the Laravel application key:

```bash id="vsf42w"
php artisan key:generate
```

Laravel will automatically store the generated application key inside your `.env` file.

---

# Database Configuration

## 1. Create the Database

Create a new MySQL database:

```sql id="8l0ykq"
CREATE DATABASE hr_darussalam;
```

You can also create the database using:

* phpMyAdmin
* HeidiSQL
* MySQL Workbench
* TablePlus
* DBeaver

---

## 2. Configure the Database

Open the `.env` file and configure your application:

```env id="cng9sh"
APP_NAME="HR Darussalam"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000
```

Configure the MySQL database connection:

```env id="5x6f3h"
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hr_darussalam
DB_USERNAME=root
DB_PASSWORD=
```

If your MySQL server requires a password:

```env id="kkw69u"
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

Make sure the database credentials match your local MySQL configuration.

---

# Database Migration

After configuring the database, run:

```bash id="ljndh7"
php artisan migrate
```

This command will create the database tables required by the application.

If the project provides database seeders, run:

```bash id="u3ml7j"
php artisan db:seed
```

Alternatively:

```bash id="7vgrz7"
php artisan migrate --seed
```

> Only run the seeder command if HR Darussalam provides the required database seeders.

---

## Resetting the Database

During development, you can rebuild the database using:

```bash id="p69d25"
php artisan migrate:fresh
```

To rebuild the database and run the seeders:

```bash id="ksdpf7"
php artisan migrate:fresh --seed
```

> **Warning:** `migrate:fresh` will delete all existing tables and their data.

Do not run this command on a production database unless you fully understand the consequences.

---

# Storage Configuration

If HR Darussalam stores employee photos, documents, attachments, or other uploaded files using Laravel Storage, create the storage symbolic link:

```bash id="p2dksp"
php artisan storage:link
```

This links:

```text id="89ay1u"
public/storage
```

to:

```text id="1wtxvu"
storage/app/public
```

---

# Running the Application

Start the Laravel development server:

```bash id="x1ttcn"
php artisan serve
```

The application should now be available at:

```text id="h9vn5f"
http://127.0.0.1:8000
```

or:

```text id="wmpzgp"
http://localhost:8000
```

Open the address in your web browser to access **HR Darussalam**.

---

# Quick Installation

For experienced Laravel developers:

```bash id="hfc3se"
git clone https://github.com/USERNAME/hr-darussalam.git

cd hr-darussalam

composer install

cp .env.example .env

php artisan key:generate
```

Create the MySQL database:

```sql id="1o1m4y"
CREATE DATABASE hr_darussalam;
```

Configure the database credentials inside `.env`, then run:

```bash id="ak94f4"
php artisan migrate
php artisan storage:link
php artisan serve
```

Open:

```text id="62ut2i"
http://localhost:8000
```

HR Darussalam should now be ready to use.

---

# Installation Flow

```text id="vd2xqx"
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
│    php artisan serve      │
└─────────────┬─────────────┘
              │
              ▼
      HR Darussalam
       Ready to Use
```

---

# Project Structure

The project follows the standard Laravel directory structure:

```text id="lt3g1i"
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
├── phpunit.xml
└── README.md
```

## Important Directories

| Directory              | Purpose                                           |
| :--------------------- | :------------------------------------------------ |
| `app/Http/Controllers` | Application controllers                           |
| `app/Models`           | Eloquent models                                   |
| `database/migrations`  | Database table structures                         |
| `database/seeders`     | Initial database data                             |
| `resources/views`      | Blade templates                                   |
| `routes/web.php`       | Web application routes                            |
| `public`               | Publicly accessible files and assets              |
| `storage`              | Uploaded files, logs, cache, and application data |
| `config`               | Laravel configuration files                       |

---

# Useful Artisan Commands

## Clear Application Cache

```bash id="krpr9u"
php artisan cache:clear
```

## Clear Configuration Cache

```bash id="87z9o8"
php artisan config:clear
```

## Clear Route Cache

```bash id="vq1ssy"
php artisan route:clear
```

## Clear Compiled Views

```bash id="l39iuk"
php artisan view:clear
```

## Clear All Laravel Cache

```bash id="05yplh"
php artisan optimize:clear
```

## View Application Routes

```bash id="zzc22e"
php artisan route:list
```

## Run Tests

```bash id="bns20b"
php artisan test
```

---

# Updating the Application

To retrieve the latest version from GitHub:

```bash id="d3q3wa"
git pull origin main
```

Update PHP dependencies:

```bash id="oedptj"
composer install
```

Run any new database migrations:

```bash id="br9zc6"
php artisan migrate
```

Clear the application cache:

```bash id="pznw54"
php artisan optimize:clear
```

> Make sure your local changes are committed or backed up before running `git pull`.

---

# Troubleshooting

## Application Encryption Key Error

If you encounter:

```text id="4v72ol"
No application encryption key has been specified.
```

Run:

```bash id="c6azgf"
php artisan key:generate
php artisan config:clear
```

---

## Database Connection Error

Check the database configuration inside `.env`:

```env id="n60z9r"
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
* The MySQL port is correct.

After changing `.env`, run:

```bash id="m02yq6"
php artisan config:clear
```

---

## Uploaded Files Are Not Accessible

If uploaded files are stored using Laravel's public storage, run:

```bash id="n4iqav"
php artisan storage:link
```

---

## Environment Changes Are Not Applied

Run:

```bash id="zmhf3a"
php artisan optimize:clear
```

Then restart the Laravel development server.

---

# Security

HR Darussalam handles employee-related information, so application and data security should be considered carefully.

Recommended practices:

* Never commit `.env` to GitHub.
* Never expose database credentials.
* Use strong passwords for user accounts.
* Set `APP_DEBUG=false` in production.
* Use HTTPS in production.
* Restrict access based on user roles where applicable.
* Keep Laravel and Composer dependencies updated.
* Regularly back up the database.
* Restrict access to employee information.
* Validate and authorize sensitive HR operations.

Production configuration should include:

```env id="gssrru"
APP_ENV=production
APP_DEBUG=false
```

---

# Development

Create a new Git branch before developing a feature:

```bash id="8a9m7h"
git checkout -b feature/feature-name
```

After making changes:

```bash id="dbitjp"
git add .
git commit -m "feat: add feature name"
```

Push the branch:

```bash id="z6kt4j"
git push origin feature/feature-name
```

Then create a Pull Request on GitHub.

---

# Contributing

Contributions to HR Darussalam should follow the project's development workflow:

1. Clone the repository.
2. Create a feature or fix branch.
3. Implement your changes.
4. Test your changes.
5. Commit your changes.
6. Push your branch.
7. Create a Pull Request.

Example branch names:

```text id="5y2zc3"
feature/attendance
feature/leave-management
feature/performance-evaluation
feature/employee-management

fix/attendance-validation
fix/login-redirect
fix/employee-form
```

Example commit messages:

```text id="umvpp6"
feat: add employee performance evaluation

feat: implement leave request

fix: resolve attendance validation issue

refactor: improve employee controller
```

---

# Application Information

| Information         | Details                          |
| :------------------ | :------------------------------- |
| **Application**     | HR Darussalam                    |
| **Type**            | Human Resource Management System |
| **Platform**        | Web Application                  |
| **Framework**       | Laravel 11                       |
| **Language**        | PHP 8.2+                         |
| **Database**        | MySQL                            |
| **Template Engine** | Laravel Blade                    |

---

# Main Modules

```text id="n1lyfh"
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

Potential future improvements:

* [ ] Employee dashboard
* [ ] Advanced role and permission management
* [ ] Attendance reporting
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

Built with **Laravel 11** & **MySQL**

`Employee Management` · `Attendance` · `Leave Management` · `Performance Evaluation`

## Collaborators

**Project Manager:** Siskha Handayani, M.Si

**Team Members:**
* 4342201039 - Muhammad Farhan Lubis
* 4342201041 - Bryan Aditya Dachi
* 4342201050 - A. Iqbal Zulmi
* 4342201056 - Raja Putra Muhammad A.
* 4342211022 - Marsandra Fadilla C.

</div>
