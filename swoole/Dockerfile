FROM php:8.2
EXPOSE 9501

# Set the working directory
WORKDIR /var/www/html

# Install dependencies for Composer
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libssl-dev \
    libcurl4-openssl-dev \
    pkg-config \
    && pecl install openswoole \
    && docker-php-ext-enable openswoole \
    && apt-get clean


# 安裝 php-bcmath 擴展
RUN docker-php-ext-install bcmath

RUN echo "memory_limit=512M" > /usr/local/etc/php/conf.d/memory-limit.ini

# Copy Composer binary from Composer image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy application files
COPY src /var/www/html/src
COPY php82/composer.json /var/www/html/composer.json

# 在這裡執行 composer install
RUN composer install

# 啟動 Swoole 
CMD ["php", "/var/www/html/src/index.php"]
