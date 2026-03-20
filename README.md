# Student Course Hub (CTEC2712)

Student Course Hub is a PHP MVC web application for the CTEC2712 Web Application Development project.

## Prerequisites

- PHP 8+
- MySQL server running

## Setup Instructions

From project root:

```bash
cd student course hub
```

### 1) Create database schema

```bash
mysql -u root < sql/schema.sql
```

### 2) Seed initial data

```bash
mysql -u root < sql/seed.sql
```

## Run the Project

```bash
php -S 127.0.0.1:8000 -t public
```

Open in browser:
- Student: `http://127.0.0.1:8000/`
- Admin login: `http://127.0.0.1:8000/admin/login`
- Admin dashboard: `http://127.0.0.1:8000/admin/dashboard`

## Default Admin Credentials

- Admin account: `admin` / `admin123`
- Editor account: `editor` / `admin123`

## Notes on Roles

- `admin`: full management access (including restricted actions like deletes/export)
- `editor`: limited admin access (RBAC restrictions apply)