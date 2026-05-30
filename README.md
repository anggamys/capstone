# 🌋 Banyuwangi Destination

![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel)
![Blade](https://img.shields.io/badge/Blade-Templates-FF2D20?style=for-the-badge&logo=laravel)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.x-38B2AC?style=for-the-badge&logo=tailwind-css)
![Vite](https://img.shields.io/badge/Vite-8.x-646CFF?style=for-the-badge&logo=vite)

A modern Laravel web application built to provide tourism destination recommendations in Banyuwangi. The project uses Blade templates, Tailwind CSS, and Vite to deliver a fast and lightweight experience.

## ✨ Features

- **Modern UI/UX**: Built with Blade templates and Tailwind CSS v4 for a clean, responsive interface.
- **Fast Development**: Vite provides fast asset bundling and hot module replacement.
- **Server-rendered Flow**: Standard Laravel routing and views keep the app simple and maintainable.
- **Code Quality**: Pre-configured with PestPHP and Laravel Pint for testing and formatting.

## 🛠️ Tech Stack

- **Backend**: Laravel 13, PHP 8.3+
- **Frontend**: Blade templates, Tailwind CSS v4, vanilla JavaScript
- **Build Tool**: Vite 8
- **Database**: MySQL

## 📋 Prerequisites

Ensure you have a local development environment. You can use all-in-one local servers like:
- **Windows**: [Laragon](https://laragon.org/) (Highly recommended; includes PHP, Composer, MySQL, and Node.js automatically) or [XAMPP](https://www.apachefriends.org/)
- **macOS / Windows**: [Laravel Herd](https://herd.laravel.com/)
- **Docker**: [Laravel Sail](https://laravel.com/docs/sail)

If you are installing software components individually, ensure you have:
- [PHP](https://www.php.net/) >= 8.3 (with `pdo_sqlite` extension enabled for running tests)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) (v20+ recommended) & npm
- [MySQL](https://www.mysql.com/)

## 🚀 Getting Started

### 1. Clone the repository

```bash
git clone <your-repo-url>
cd cp-banyuwangidestination
```

### 2. Automated Setup (Recommended)

You can use the built-in composer script to handle the entire setup process (installing dependencies, copying `.env`, creating the default SQLite database file, generating key, running migrations, seeding initial destination and admin data, and building frontend assets):

```bash
composer run setup
```

_Note: By default, the automated setup uses SQLite. If you want to use MySQL instead, copy `.env.example` to `.env` and configure your database settings (including creating the `cp_banyuwangidestination` database) BEFORE running `composer run setup`._

### 3. Manual Setup

If you prefer to set it up manually:

Install PHP and Node dependencies:

```bash
composer install
npm install
```

Set up your environment variables:

```bash
cp .env.example .env
# On Windows PowerShell: Copy-Item .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Configure your `.env` file for your local database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cp_banyuwangidestination
DB_USERNAME=root
DB_PASSWORD=
```

Run database migrations:

```bash
php artisan migrate:fresh --seed
```

## 💻 Running for Development

To start the local development environment, we use a single command that concurrently runs the PHP server, queue listener, and Vite dev server:

```bash
composer run dev
```

Your application will be available at `http://localhost:8000`.

Alternatively, run them in separate terminals:

```bash
php artisan serve
npm run dev
```

## 🧪 Testing & Code Quality

This project includes a simple command set for setup, development, and testing.

- **PHP Tests**: `php artisan test` or `composer run test` (requires the SQLite extension `pdo_sqlite` to be enabled in PHP CLI)
- **Frontend Build**: `npm run build`
- **Development Server**: `composer run dev`
- **Project Setup**: `composer run setup`

## 📁 Project Structure

- `app/` - Laravel backend application code
- `config/` - Application configuration files
- `database/` - Migrations, seeders, and model factories
- `resources/views/` - Blade templates and page views
- `resources/css/` - Tailwind CSS source
- `resources/js/` - Frontend JavaScript entry point and helper scripts
- `routes/` - Web and console route definitions
- `tests/` - PestPHP test files

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).