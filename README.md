# Perlas Portfolio

Personal portfolio site built with Laravel.

## Structure

- `app/Http/Controllers/PortfolioController.php` — serves the portfolio page.
- `config/portfolio.php` — profile, education, skills, and certifications content.
- `resources/views/portfolio.blade.php` — portfolio page template.
- `routes/web.php` — registers `GET /`.

## Local Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```

## Updating Content

Edit `config/portfolio.php`. If config is cached, run `php artisan config:clear`.
