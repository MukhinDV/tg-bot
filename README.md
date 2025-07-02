# syrniki-telegram-bot

## Развертывание

### 1) Склонировать

    git@github.com:MukhinDV/syrniki-telegram-bot.git

### 2) Настройка локальных конфигов

В текущей папке создать .env.local файл.
Шаблон значений для .env.local можно взять из .env

### 3) Собрать контейнеры

    cd .docker/
    docker compose --env-file ../.env.local up -d

### 4) Зайти в контейнер и собрать ядро

    docker exec -it docker-app-1 bash
    composer install

### Запуск тестов внутри контейнера

    .vendor/bin/phpunit tests

### Фикс стилей

    ./vendor/bin/php-cs-fixer fix -vvv
