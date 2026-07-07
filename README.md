# My Article

# Project Setup

## Prerequisites

- **PHP** 8.3+
- **Composer** (PHP dependency manager)
- **Node.js** & **npm** (for frontend assets)
- **SQLite** (default database) or MySQL/PostgreSQL

## Minimal Installation

```bash
# 1. Clone & enter project
git clone <repo-url> && cd my-project

# 2. Install PHP dependencies
composer install

# 3. Copy environment file
cp .env.example .env

# 4. Generate app key
php artisan key:generate

# 5. Run migrations (creates SQLite database)
php artisan migrate

# 6. Install frontend dependencies
npm install

# 7. Build assets
npm run build
```

## Running the Project

```bash
# Start development server
php artisan serve
# Visit http://localhost:8000
```

## Available npm Scripts

| Command | Description |
|---------|-------------|
| `npm run dev` | Start Vite dev server |
| `npm run build` | Build for production |
| `npm run setup` | Full setup (composer + migrate + build) |

## Tech Stack

- **Laravel** 13.x (PHP framework)
- **Vite** 8.x (build tool)
- **SQLite** (default database)

## Quick Reset

```bash
# Fresh install with seeding
php artisan migrate:fresh --seed
```
