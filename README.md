![React](https://img.shields.io/badge/React-20232A?style=for-the-badge&logo=react&logoColor=61DAFB)
![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)

## Содержание

1. [Описание](#описание)
2. [Структура проекта](#структура-проекта)
3. [Требования](#требования)
4. [Установка](#установка)
5. [Запуск](#запуск)
6. [Структура директорий](#структура-директорий)
7. [Тестовые пользователи](#тестовые-пользователи)
8. [Использование](#использование)
    - [Проверка пользователя](#проверка-пользователя)
    - [Отправка отзыва](#отправка-отзыва)
9. [Переход на локальный хост](#переход-на-локальный-хост)
10. [Тестовое задание](#тестовое-задание)
## Описание

Это приложение позволяет пользователям оставлять отзывы о качестве обслуживания. Приложение состоит из фронтенда, реализованного на React с использованием Vite, и бэкенда, реализованного на PHP с использованием MySQL для хранения данных.

Сделано на основе [тестового задания](#тестовое-задание). 

## Структура проекта

Проект состоит из следующих директорий:

- **frontend**: Содержит код фронтенда, реализованный на React.
- **backend**: Содержит код бэкенда, реализованный на PHP.
- **sql**: Содержит SQL-скрипты для инициализации базы данных.

## Требования

Для запуска проекта вам понадобятся следующие инструменты:

- Docker
- Docker Compose

## Установка

1. Клонируйте репозиторий:

   ```sh
   git clone https://github.com/suraifokkusu/rasa-backend-test-task.git
   cd rasa-backend-test-task
   ```

## Запуск

1. Запустите Docker Compose:

   ```sh
   docker-compose up --build
   ```

2. Откройте браузер и перейдите по адресу `http://localhost:3000` для доступа к фронтенду.

## Структура директорий

### Фронтенд

- `src`: Исходный код фронтенда.
- `public`: Публичные файлы.

### Бэкенд

- `src`: Исходный код бэкенда.
- `public`: Публичные файлы.

### SQL

- `init.sql`: Скрипт для инициализации базы данных.

## Тестовые пользователи

В базе данных уже созданы несколько тестовых пользователей, их ID:

- Пользователь 1: `id=0`
- Пользователь 2: `id=1`
## Использование

### Проверка пользователя

```typescript
const API_URL = '/api';

export const checkUser = async (user_id: string) => {
  const response = await fetch(`${API_URL}/src/routes/index.php?id=${user_id}`, {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
    },
  });
  if (!response.ok) {
    throw new Error('Network response was not ok');
  }
  return response.json();
};
```

### Отправка отзыва

```typescript
const API_URL = '/api';

export const submitReview = async (user_id: string, rating: number, comment: string) => {
  const response = await fetch(`${API_URL}/src/routes/index.php`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `user_id=${user_id}&rating=${rating}&comment=${comment}`,
  });
  if (!response.ok) {
    throw new Error('Network response was not ok');
  }
  return response.json();
};
```
## Переход на локальный хост

Для проверки приложения в локальной среде:

1. Запустите Docker Compose, как указано выше.
2. Откройте браузер и перейдите по адресу `http://localhost:3000`.
3. Используйте следующие URL для проверки функциональности:
   - Проверка пользователя: `http://localhost:3000/?id=1`
   - Отправка отзыва: форма отправки отзыва доступна после проверки пользователя.

6. Откройте новый терминал и выполните команду для входа в контейнер MySQL:

   ```sh
   docker-compose exec db mysql -u root -p
   ```

   Введите пароль --> ```password``` для пользователя ```root```, указанный в `docker-compose.yml` файле.

7. После входа в MySQL выполните команду для выбора базы данных:

   ```sql
   USE reviews_db;
   ```

8. Выполните запрос для проверки записей в таблице отзывов:

   ```sql
   SELECT * FROM reviews;
   ```

   Этот запрос должен вернуть все записи отзывов.

9. Для выхода из MySQL выполните команду:

   ```sql
   EXIT;
   ```

# Тестовое задание

## Разработка сервиса "Оставить отзыв"

Реализовать на PHP сервис "Оставьте отзыв".

### Конечный результат:

- Форма, позволяющая оценить работу от 1 до 5 (реализовать в виде PHP интерфейса с целью реализации разных типов опросов).
- Поле "оставить комментарий к оценке" (не обязательное).
- Результат оценки записывается в таблицу в БД.
- На основании параметра в URL получаем ID клиента.
- При входе на страницу полученный ID проверяется по таблице в БД на наличие такого пользователя, и если пользователь не найден, выводится вместо формы заглушка: "Ссылка на голосование недоступна, свяжитесь с нами по телефону".
- ID клиента, полученный ранее, также сохраняется вместе с результатами формы.

### Фронт

- Можно очень простой: кнопки в ряд и поле для ввода комментария.
- "Оцените качество обслуживания: 1, 2, 3, 4, 5".
- При желании оставьте комментарий к отзыву.

### Как сдавать задание

- Прислать архивом или ссылкой на GitHub.

### На что важно обратить внимание при реализации

- Модульность кода.
- Низкая связанность классов.
- Валидация данных.
- По возможности покрыть код тестами.

![Alt](https://repobeats.axiom.co/api/embed/33fb91d3f9ce8e850bd83440bba87bcca3d9bbaf.svg "Repobeats analytics image")
