#!/bin/sh

# Set correct permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Wait for MySQL to be ready
echo "Waiting for database..."
sleep 5

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan optimize:clear

# Run migrations
php artisan migrate --force || echo "Migrations failed, continuing..."

# Start PHP-FPM
exec "$@"
