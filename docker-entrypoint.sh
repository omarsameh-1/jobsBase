#!/bin/sh

# Set correct permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Wait for MySQL to be ready
echo "Waiting for database to be ready..."
while ! nc -z $DB_HOST $DB_PORT; do
  sleep 1
done

echo "Database is ready. Running migrations..."

# Clear Laravel caches
php artisan config:clear
php artisan cache:clear
php artisan optimize:clear

# Ensure storage link exists
php artisan storage:link

# Run migrations (ignore failure to prevent crashes)
php artisan migrate --force || echo "⚠️ Migrations failed, continuing..."

# Restart queue workers (if using queues)
php artisan queue:restart || echo "Queue restart failed, continuing..."

# Start PHP-FPM
exec "$@"
