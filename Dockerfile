FROM php:8.2-fpm

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP extensions and system dependencies
RUN apt-get update && \
    apt-get install -y \
        git \
        unzip \
        libzip-dev \
        nodejs \
        npm \
    && docker-php-ext-install pdo_mysql zip \
    && apt-get clean && \
    rm -rf /var/lib/apt/lists/*
