FROM php:7.4-cli

# Install unzip for composer
RUN apt-get update && apt-get install -y --no-install-recommends \
    vim \
    unzip \
    && rm -r /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# RUN docker-php-ext-install -j$(nproc) pdo_mysql

# Install Xdebug, pcov for generating code coverage
RUN pecl install xdebug pcov