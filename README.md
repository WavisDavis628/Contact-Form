# Contact Form — Laravel 12 + Livewire 3 + Tailwind

## Requirements
- PHP 8.3+ (CLI), Composer
- Node.js 18+ (Vite)
- SQLite (default) or MySQL
- (Dev) WSL/Ubuntu recommended

## Setup (local)
    cp .env.example .env
    composer install
    npm install
    php artisan key:generate
    php artisan migrate --seed
    npm run dev      # or: npm run build
    php artisan serve

Open http://127.0.0.1:8000

## Routes
- /contact — Livewire contact form (validates, spam-protected, saves, emails)
- /submissions — list of prior submissions (search by email/subject, pagination)

## Email
- Default mailer: `MAIL_MAILER=log` (emails appear in storage/logs/laravel.log)
- Recipient is env-driven: set `MAIL_TO=gtest@mailgrove.com` in `.env`
- Real delivery (optional): configure SMTP (e.g., Mailpit, Mailgun, SendGrid) in `.env`

## Spam protection
- Honeypot field (`website`) hidden from users
- 3-second time-trap before accepting submissions
- Optional simple rate limiting can be added via Laravel’s `RateLimiter`

## Database
- Default: SQLite at `database/database.sqlite`
- Reset with seeds anytime:
    php artisan migrate:fresh --seed
- Switch to MySQL by updating `.env` keys (`DB_CONNECTION`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`)

## Decisions
- Livewire 3 for reactive UX without a JS SPA
- TailwindCSS for accessible, responsive styling
- SQLite by default for zero-config reviewer setup
- Env-driven mail config; log mailer for local verification

## Production-like build (optional)
    npm run build
    php artisan serve

## Notes
- CSRF protection and validation are server-side (Laravel + Livewire).
- Success flow uses PRG (redirect after submit) to prevent duplicate resubmits on refresh.
- Seed data ensures `/submissions` isn’t empty on first run.
