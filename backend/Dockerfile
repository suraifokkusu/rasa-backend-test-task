# FROM php:7.4-apache

# COPY src/ /var/www/html/
# Этап сборки
FROM php:8.2-cli AS build

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установка необходимых зависимостей
RUN apt-get update && \
    apt-get install -y \
    unzip \
    git \
    && docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Установка зависимостей Composer
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --optimize-autoloader

# Копирование исходного кода
COPY . .

# Запуск тестов
RUN ./vendor/bin/phpunit --configuration phpunit.xml

# Этап выполнения
FROM php:8.2-apache

# Установка необходимых зависимостей
RUN apt-get update && \
    apt-get install -y \
    unzip \
    git \
    default-mysql-client \
    && docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Копирование зависимости из стадии сборки
COPY --from=build /app /var/www/html

# Add docker-compose-wait tool -------------------
ENV WAIT_VERSION 2.7.2
ADD https://github.com/ufoscout/docker-compose-wait/releases/download/$WAIT_VERSION/wait /wait
RUN chmod +x /wait

# Настройка Apache
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Запуск wait-for-it.sh перед запуском приложения
CMD ["sh", "-c", "/wait && apache2-foreground"]

# Открываем порт
EXPOSE 80
