# Use PHP 8.0.2 official image
FROM php:8.2.0-fpm

# Install required dependencies
RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy Laravel files
COPY . .

# Set permissions
RUN chmod -R 777 storage bootstrap/cache

# Run Laravel migrations
RUN php artisan migrate --force

CMD ["php-fpm"]
