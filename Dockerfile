# Use official PHP image with necessary extensions
FROM php:8.2-fpm

# Set working directory inside the container
WORKDIR /var/www

# Install system dependencies and required PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    zip \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql gd pdo_pgsql pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy Laravel project files to the container
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions for storage and cache
RUN chmod -R 777 storage bootstrap/cache

# Expose port (Laravel runs on port 8000)
EXPOSE 8000

# Start Laravel using Artisan
CMD php artisan serve --host=0.0.0.0 --port=8000
