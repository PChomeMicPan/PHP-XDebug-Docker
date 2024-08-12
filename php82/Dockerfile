FROM php:8.2
EXPOSE 8080

# Set the working directory
WORKDIR /var/www/html

# Install dependencies for Composer
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# 安裝 php-bcmath 擴展
RUN docker-php-ext-install bcmath

# Get the Xdebug extension
RUN pecl install xdebug \
    # Enable the installed Xdebug
    && docker-php-ext-enable xdebug

RUN echo "memory_limit=512M" > /usr/local/etc/php/conf.d/memory-limit.ini

# Copy Composer binary from Composer image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Copy application files
COPY src /var/www/html/src
COPY tests /var/www/html/tests
COPY php82/composer.json /var/www/html/composer.json
COPY php82/phpunit.xml /var/www/html/phpunit.xml

# 在這裡執行 composer install
RUN composer install

# 執行單元測試並生成覆蓋率報告
RUN set -e \
    && vendor/bin/phpunit tests --coverage-html ./test-result --process-isolation || true
# 指定容器啟動時執行的命令
CMD ["php", "-S", "0.0.0.0:8080", "-t", "./test-result"]
