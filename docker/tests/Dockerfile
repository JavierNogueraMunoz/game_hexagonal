FROM php:7.4-fpm

RUN docker-php-ext-install pdo_mysql
RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        libc-ares2 \
        libnode64 \
        libuv1 \
        nodejs-doc \
        graphviz \
        locales \
        zip \
        jpegoptim optipng pngquant gifsicle \
        vim \
        unzip \
        git \
        wget \
        gnupg \
        curl \
        && docker-php-ext-configure gd \
        && docker-php-ext-install -j$(nproc) gd \
        && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
        && docker-php-ext-install \
        pdo_mysql

# Install Infection
RUN wget https://github.com/infection/infection/releases/download/0.17.0/infection.phar
RUN wget https://github.com/infection/infection/releases/download/0.17.0/infection.phar.asc

RUN chmod +x infection.phar

# RUN gpg --keyserver hkps.pool.sks-keyservers.net --recv-keys 493B4AA0
# RUN gpg --with-fingerprint --verify infection.phar.asc infection.phar

RUN mv infection.phar /usr/local/bin/infection

# Set working directory
WORKDIR /app

COPY . /app
COPY .env.testing /app/.env

# Set working directory
WORKDIR /app

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
