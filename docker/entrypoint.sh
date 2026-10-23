#!/bin/sh
set -e

# Cache config/routes/views at boot so runtime environment variables are respected.
php artisan optimize

exec "$@"
