# Dockerfile
FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

# Set working directory
WORKDIR /var/www

# Copy application files
COPY . .

# Install Composer
COPY --from=composer:latest C:\ProgramData\ComposerSetup/bin/composer C:\ProgramData\ComposerSetup/bin/composer

# Install Laravel dependencies
RUN composer install --no-interaction --prefer-dist

# Expose the port that your application runs on
EXPOSE 9000

CMD ["php-fpm"]
