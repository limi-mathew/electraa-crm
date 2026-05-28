# Electraa CRM

Electraa CRM is a Laravel + Filament based Electrical Contract Management CRM built for learning advanced Laravel architecture and real-world SaaS concepts.

## Features

* Laravel 12
* Filament Admin Panel
* Customer Management
* Invoice Management
* Stripe Payment Gateway
* Real-time Chat
* Redis + Reverb + WebSockets
* Livewire Support Chat
* Roles & Permissions (Spatie)
* Dashboard Analytics
* Revenue Charts
* Repository Pattern
* Service Layer Architecture
* Queue & Cache Handling
* Telescope & Debugbar
* ESLint + Prettier + Pint + PHPStan
* PHPUnit Testing
* CI/CD Pipeline with GitHub Actions
* Deployment using Render

---

## Tech Stack

* Laravel
* Filament
* MySQL
* Redis
* Livewire
* AlpineJS
* Stripe
* Docker / Laravel Sail
* GitHub Actions
* Render

---

## Installation

```bash
git clone https://github.com/YOUR_USERNAME/electraa-crm.git

cd electraa-crm

composer install

cp .env.example .env

php artisan key:generate

php artisan migrate --seed

npm install

npm run build
```

---

## Run Locally

```bash
php artisan serve
```

Admin panel:

```bash
http://localhost/admin
```

---

## Quality Tools

```bash
npm run quality

vendor/bin/phpstan analyse app

vendor/bin/pint
```

---

## Testing

```bash
php artisan test
```

---

## Deployment

Deployed using Render with GitHub Actions CI/CD pipeline.
