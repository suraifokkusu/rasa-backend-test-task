
# Оставить отзыв

Проект реализует сервис "Оставить отзыв" на PHP для backend и React с TypeScript для frontend.

## Содержание

- [Технологии](#технологии)
- [Установка](#установка)
- [Настройка окружения](#настройка-окружения)
- [Запуск приложения](#запуск-приложения)
- [Структура проекта](#структура-проекта)
- [API](#api)
- [Лицензия](#лицензия)

## Технологии

- Backend:
  - PHP
  - Composer
  - MySQL
- Frontend:
  - React
  - TypeScript
  - Vite

## Установка

### Backend

1. Склонируйте репозиторий:

   \`\`\`bash
   git clone https://github.com/yourusername/repositoryname.git
   \`\`\`

2. Перейдите в директорию `backend`:

   \`\`\`bash
   cd project/backend
   \`\`\`

3. Установите зависимости с помощью Composer:

   \`\`\`bash
   composer install
   \`\`\`

4. Создайте базу данных MySQL и настройте подключение в `src/Database.php`.

### Frontend

1. Перейдите в директорию `frontend`:

   \`\`\`bash
   cd project/frontend
   \`\`\`

2. Установите зависимости с помощью npm:

   \`\`\`bash
   npm install
   \`\`\`

## Настройка окружения

### Backend

1. В файле `src/Database.php` настройте параметры подключения к базе данных:

   \`\`\`php
   private $host = 'localhost';
   private $db_name = 'reviews';
   private $username = 'root';
   private $password = '';
   \`\`\`

### Frontend

1. Создайте файл `.env` в корне директории `frontend` и добавьте следующие переменные окружения:

   \`\`\`env
   VITE_API_URL=http://localhost:8000
   \`\`\`

## Запуск приложения

### Backend

1. Перейдите в директорию `backend`:

![Alt](https://repobeats.axiom.co/api/embed/66b3cb1d03bece2f75b6cc95aa5fa5445f00aa2f.svg "Repobeats analytics image")