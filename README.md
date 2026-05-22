<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


# 🌋 Banyuwangi Destination

![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel)
![React](https://img.shields.io/badge/React-19.x-61DAFB?style=for-the-badge&logo=react&logoColor=black)
![Inertia.js](https://img.shields.io/badge/Inertia.js-3.x-9553E9?style=for-the-badge&logo=inertia)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.x-38B2AC?style=for-the-badge&logo=tailwind-css)
![Vite](https://img.shields.io/badge/Vite-8.x-646CFF?style=for-the-badge&logo=vite)

A modern web application built to provide tourism destination recommendations in Banyuwangi. This platform helps tourists discover the best places to visit, leveraging a robust tech stack for a seamless user experience.

## ✨ Features

- **Modern UI/UX**: Built with React, Tailwind CSS v4, and Radix UI primitives for accessible and beautiful interfaces.
- **Seamless SPA Experience**: Powered by Inertia.js to connect Laravel and React without building a separate API.
- **Fast Development**: Utilizing Vite for lightning-fast HMR (Hot Module Replacement).
- **Code Quality**: Pre-configured with ESLint, Prettier, TypeScript, PestPHP, and Laravel Pint for strict code formatting and quality checks.

## 🛠️ Tech Stack

- **Backend**: Laravel 13, PHP 8.3+
- **Frontend**: React 19, Inertia.js v3, Tailwind CSS v4
- **Components**: Radix UI
- **Build Tool**: Vite 8
- **Database**: MySQL

## 📋 Prerequisites

Ensure you have the following installed on your local machine:

- [PHP](https://www.php.net/) >= 8.3
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

You can use the built-in composer script to handle the entire setup process (installing dependencies, copying `.env`, generating key, running migrations, and building assets):

```bash
composer run setup
```

_Note: Make sure your database `cp_banyuwangi_destination` exists before running this command, or adjust your `.env` accordingly._

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
DB_DATABASE=cp_banyuwangi_destination
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

This project is configured with strict quality tools.

Run the full CI check (Linting, Formatting, Type Checking, and Tests):

```bash
composer run ci:check
```

Or run them individually:

- **PHP Tests**: `php artisan test` or `composer run test`
- **PHP Linting**: `composer run lint` (fixes issues) or `composer run lint:check`
- **JS/TS Linting**: `npm run lint` or `npm run lint:check`
- **Type Checking**: `npm run types:check`
- **Formatting**: `npm run format`

## 📁 Project Structure

- `app/` - Laravel backend application code
- `config/` - Application configuration files
- `database/` - Migrations, seeders, and model factories
- `resources/js/` - React pages, components, layouts, and hooks
- `routes/` - Web and console route definitions
- `tests/` - PestPHP test files
