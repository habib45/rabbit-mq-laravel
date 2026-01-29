FROM php:8.3-fpm
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP extensions and system dependencies
RUN apt-get update && \
    apt-get install -y \
        git \
        unzip \
        libzip-dev \
        librabbitmq-dev \
        nodejs \
        npm \
    && docker-php-ext-install pdo_mysql zip sockets \
    && pecl install amqp \
    && docker-php-ext-enable amqp \
    && apt-get clean && \
    rm -rf /var/lib/apt/lists/*

COPY web-app/composer.json /var/www/html/composer.json
COPY web-app/composer.lock /var/www/html/composer.lock
WORKDIR /var/www/html
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-scripts

