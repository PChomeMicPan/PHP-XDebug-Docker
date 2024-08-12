FROM php:7.1.33
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
RUN pecl install xdebug-2.5.0 \
    # Enable the installed Xdebug
    && docker-php-ext-enable xdebug

RUN echo "memory_limit=512M" > /usr/local/etc/php/conf.d/memory-limit.ini

# Copy Composer binary from Composer image
COPY --from=composer:2.2.21 /usr/bin/composer /usr/bin/composer
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Copy application files
COPY src /var/www/html/src
COPY tests /var/www/html/tests
COPY php71/composer.json /var/www/html/composer.json
COPY php71/phpunit.xml /var/www/html/phpunit.xml

# install composer
RUN composer install

# 執行單元測試並生成覆蓋率報告
RUN set -e \
    && vendor/bin/phpunit tests --coverage-html ./test-result || true
# 指定容器啟動時執行的命令
CMD ["php", "-S", "0.0.0.0:8080", "-t", "./test-result"]
