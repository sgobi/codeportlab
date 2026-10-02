# CodePortLab Platform Architecture & cPanel Deployment Guide

## 1. System Overview & Technology Stack
- **Domain**: `codeportlab.com` | **Emails**: `ops@codeportlab.com`, `gobi@codeportlab.com`
- **Owner**: Gobikrishna Subramaniyam (Senior DevOps Engineer & Full-Stack Architect)
- **Framework**: Laravel 10 (PHP 8.1+)
- **Admin Panel / CMS**: Filament PHP v3 (`/admin`)
- **Frontend Theme**: Dark Glassmorphic Theme with JetBrains Mono typography
- **Target OS & Webserver**: CloudLinux 7 (64-bit), Apache 2.4 with `mod_rewrite` enabled
- **Database Engine**: MySQL 5.7 (Strict SQL compatibility; no native JSON types, no CTEs)
- **Quota Allocation**: Storage optimized under 1GB budget

---

## 2. Directory Structure & Key Files

```
codeportlab/
├── .htaccess                               # cPanel root isolation & security rules
├── app/
│   ├── Filament/
│   │   └── Resources/
│   │       ├── ProjectResource.php         # Case studies CMS resource
│   │       ├── SkillResource.php           # Skills matrix CMS resource
│   │       └── TechUpdateResource.php      # Technical journal CMS resource
│   ├── Http/
│   │   └── Controllers/
│   │       └── PortfolioController.php     # Public controller with dynamic queries
│   ├── Models/
│   │   ├── Project.php                     # Project Eloquent model
│   │   ├── Skill.php                       # Skill Eloquent model
│   │   └── TechUpdate.php                  # TechUpdate Eloquent model
│   └── Providers/
│       └── Filament/
│           └── AdminPanelProvider.php      # Filament v3 panel configuration
├── database/
│   ├── migrations/
│   │   ├── 2026_01_01_000001_create_tech_updates_table.php
│   │   ├── 2026_01_01_000002_create_projects_table.php
│   │   └── 2026_01_01_000003_create_skills_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── ProjectSeeder.php
│       ├── SkillSeeder.php
│       ├── TechUpdateSeeder.php
│       └── UserSeeder.php
├── public/
│   └── .htaccess                           # Laravel front controller rewrite rules
├── resources/
│   └── views/
│       └── portfolio.blade.php             # Dark Glassmorphic UI & Terminal CLI
└── routes/
    └── web.php                             # Route declarations
```

---

## 3. Database Schema (MySQL 5.7 Compatible)

### `tech_updates` Table
| Column | Type | Attributes |
|---|---|---|
| `id` | `BIGINT` | Unsigned, Primary Key, Auto Increment |
| `title` | `VARCHAR(255)` | NOT NULL |
| `category` | `VARCHAR(255)` | DevOps & Cloud, Full-Stack, AI & Tooling, Architecture |
| `summary` | `TEXT` | NOT NULL |
| `content` | `LONGTEXT` | Nullable (Rich text HTML) |
| `external_url` | `VARCHAR(255)` | Nullable |
| `is_pinned` | `TINYINT(1)` | Default `0` |
| `is_published` | `TINYINT(1)` | Default `1` |
| `published_at` | `TIMESTAMP` | Default `CURRENT_TIMESTAMP` |
| `created_at` / `updated_at` | `TIMESTAMP` | Nullable |

### `projects` Table
| Column | Type | Attributes |
|---|---|---|
| `id` | `BIGINT` | Unsigned, Primary Key, Auto Increment |
| `title` | `VARCHAR(255)` | NOT NULL |
| `category` | `VARCHAR(255)` | NOT NULL |
| `tech_stack` | `VARCHAR(255)` | Comma-separated tags (MySQL 5.7 compliant) |
| `description` | `TEXT` | NOT NULL |
| `content` | `LONGTEXT` | Nullable (Detailed Case Study) |
| `live_url` | `VARCHAR(255)` | Nullable |
| `article_url` | `VARCHAR(255)` | Nullable |
| `sort_order` | `INT` | Default `0` |
| `is_featured` | `TINYINT(1)` | Default `1` |
| `created_at` / `updated_at` | `TIMESTAMP` | Nullable |

### `skills` Table
| Column | Type | Attributes |
|---|---|---|
| `id` | `BIGINT` | Unsigned, Primary Key, Auto Increment |
| `name` | `VARCHAR(255)` | NOT NULL |
| `group` | `VARCHAR(255)` | Cloud & Infrastructure, Containers & CI/CD, Backend & Web, Databases & Ops |
| `proficiency` | `VARCHAR(255)` | Expert, Advanced, Proficient |
| `sort_order` | `INT` | Default `0` |
| `created_at` / `updated_at` | `TIMESTAMP` | Nullable |

---

## 4. cPanel MultiPHP & Extension Requirements

In cPanel **MultiPHP Manager** & **Select PHP Version**:
1. Select PHP Version: **PHP 8.1** or **8.2**.
2. Verify enabled PHP extensions:
   - `pdo_mysql`
   - `mbstring`
   - `fileinfo`
   - `gd`
   - `openssl`
   - `curl`
   - `xml` / `dom`
   - `tokenizer`

---

## 5. cPanel Step-by-Step Deployment Instructions

1. **Upload Codebase**:
   Upload the `codeportlab` files to your cPanel root directory (or `/home/username/codeportlab`).

2. **Configure Database**:
   - Create MySQL Database in cPanel MySQL Databases tool (e.g. `codeport_db`).
   - Create DB User (e.g. `codeport_user`) and assign all privileges.
   - Update `.env` on cPanel:
     ```env
     APP_NAME="CodePortLab"
     APP_ENV=production
     APP_DEBUG=false
     APP_URL=https://codeportlab.com

     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=codeport_db
     DB_USERNAME=codeport_user
     DB_PASSWORD=your_strong_password
     ```

3. **Run Database Migrations & Initial Seed**:
   Run via SSH or cPanel Terminal:
   ```bash
   php artisan migrate:fresh --seed --force
   ```
   *Admin Credentials:*
   - **Email**: `gobi@codeportlab.com`
   - **Password**: `CodePortLab2026!` *(Change upon first login in `/admin`)*

4. **Storage Footprint Optimization (< 1GB Quota)**:
   Run artisan optimization commands to cache route tables, blade templates, and configuration arrays:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

5. **Root Isolation Routing**:
   Ensure `.htaccess` in `public_html` routes Apache requests to `public/` while preventing public HTTP access to `.env`, `composer.json`, `.git`, or `artisan`.
