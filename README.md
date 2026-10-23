# Rick and Morty Encyclopedia

[![CI](https://github.com/gibbs/test-26/actions/workflows/ci.yml/badge.svg)](https://github.com/gibbs/test-26/actions/workflows/ci.yml)

An encyclopedia of Rick and Morty characters using the public [Rick and Morty API](https://rickandmortyapi.com).

## Stack Overview

- Laravel 13
- PHP 8.5
- Redis
- Inertia 3
- Vue 3.5
- Tailwind 4
- Pest
- Playwright
- Larastan
- Pint

## Environment Setup

The initial setup requires PHP 8.3+ and Composer for Sail.

```bash
# Copy dotenv config
cp .env.example .env

# Install dependencies (required locally for Sail)
composer install

# Start sail containers
./vendor/bin/sail up -d

# Laravel setup
./vendor/bin/sail artisan key:generate
touch database/database.sqlite
./vendor/bin/sail artisan migrate

# NPM setup
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```
