# Tribhuvan University (CTEC2712)

Tribhuvan University is a PHP MVC web application for the CTEC2712 Web Application Development project.

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
- Staff portal: `http://localhost/webassignment/public/staff/login` (after seeding; see below)
- Admin login: `http://localhost/webassignment/public/admin/login`

Visiting `http://localhost/webassignment/` redirects to `public/` if `AllowOverride` allows `.htaccess` (default in XAMPP).

`public/.htaccess` enables clean URLs (e.g. `/programmes`) via Apache `mod_rewrite`.

### Option B — PHP built-in server

```bash
php -S 127.0.0.1:8000 -t public
```

- Student: `http://127.0.0.1:8000/`
- Staff portal: `http://127.0.0.1:8000/staff/login`
- Admin login: `http://127.0.0.1:8000/admin/login`

### Existing database: staff login columns

If you already created the database from an older `schema.sql`, add the new columns then re-run the `UPDATE` statements from `sql/seed.sql` (or run):

```bash
/Applications/XAMPP/xamppfiles/bin/mysql -u root < sql/migration_staff_auth.sql
```

Then re-run `sql/seed.sql` (or copy the `INSERT INTO Staff ...` block from it) so demo usernames and `PasswordHash` values are applied.

## Default Admin Credentials

- Admin account: `admin` / `admin123`
- Editor account: `editor` / `admin123`

## Staff portal (demo accounts)

After a full seed, **every** staff member can sign in. Password for all: **`staff123`**. **Username** is their first name in lowercase (as in `sql/seed.sql`): `alice`, `brian`, `carol`, `david`, `emma`, `frank`, `grace`, `henry`, `irene`, `james`, `sophia`, `benjamin`, `chloe`, `daniel`, `emily`, `nathan`, `olivia`, `samuel`, `victoria`, `william`.

The dashboard shows **modules they lead**, **programmes they lead** (programme leader role), and **where their modules appear** on each degree (programme, level, year).

## Notes on Roles

- `admin`: full management access (including restricted actions like deletes/export)
- `editor`: limited admin access (RBAC restrictions apply)