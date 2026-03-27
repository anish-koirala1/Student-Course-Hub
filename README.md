# Student Course Hub (CTEC2712)

Student Course Hub is a PHP MVC web application for the CTEC2712 Web Application Development project.

## Prerequisites

- PHP 8+
- MySQL/MariaDB (included with [XAMPP](https://www.apachefriends.org/))

## Setup Instructions

From the project root (this folder).

### 1) Start XAMPP

Start **Apache** and **MySQL** from the XAMPP control panel.

### 2) Create database schema

Using a terminal (XAMPP’s MySQL is usually on port 3306, user `root`, empty password):

```bash
/Applications/XAMPP/xamppfiles/bin/mysql -u root < sql/schema.sql
```

On Windows, use `C:\xampp\mysql\bin\mysql.exe -u root < sql\schema.sql` from the project folder.

Or import `sql/schema.sql` in phpMyAdmin (`http://localhost/phpmyadmin`).

### 3) Seed initial data

```bash
/Applications/XAMPP/xamppfiles/bin/mysql -u root < sql/seed.sql
```

### 4) Database configuration

Defaults in `app/config/config.php` match a typical XAMPP install (`root` / no password, database `student_course_hub`). Override with environment variables `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASS`, or `DB_SOCKET` if your MySQL uses a socket (e.g. macOS XAMPP: `/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock`).

## Run the project

### Option A — XAMPP Apache (recommended)

Place the project under `htdocs` (this repo path is already `htdocs/webassignment`).

Open in the browser (note the **`public`** folder is the web root):

- Student site: `http://localhost/webassignment/public/`
- Admin login: `http://localhost/webassignment/public/admin/login`

Visiting `http://localhost/webassignment/` redirects to `public/` if `AllowOverride` allows `.htaccess` (default in XAMPP).

`public/.htaccess` enables clean URLs (e.g. `/programmes`) via Apache `mod_rewrite`.

### Option B — PHP built-in server

```bash
php -S 127.0.0.1:8000 -t public
```

- Student: `http://127.0.0.1:8000/`
- Admin login: `http://127.0.0.1:8000/admin/login`

## Default Admin Credentials

- Admin account: `admin` / `admin123`
- Editor account: `editor` / `admin123`

## Notes on Roles

- `admin`: full management access (including restricted actions like deletes/export)
- `editor`: limited admin access (RBAC restrictions apply)