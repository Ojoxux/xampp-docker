FROM php:8.2-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libzip-dev \
        libonig-dev \
        unzip \
        git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        mysqli \
        pdo_mysql \
        mbstring \
        gd \
        zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

RUN echo "date.timezone = Asia/Tokyo" > /usr/local/etc/php/conf.d/timezone.ini \
 && echo "upload_max_filesize = 64M\npost_max_size = 64M" > /usr/local/etc/php/conf.d/uploads.ini
