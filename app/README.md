Тестовое задание
================

## Развертывание проекта

1. После скачивания проекта проследить, чтобы на папки ```/app/runtime``` и ```/app/web/assets``` были права записи.
2. Запустить в корне сайта команду 
```
composer install
```

## Файлы

Контроллеры в папке /app/controllers.
- TransController эмулирует работу сервисов компаний-перевозчиков.
- PriceController принимает запрс от страницы и возвращает json-объект с ценами.
- SiteController отдает страницу


## Просмотр данных на странице

В настройках локального сервера ```DocumentRoot``` должен указывать на папку ```/app/web```
Поля на странице должны быть заполнены, их значения отправляются на сервер в эмулятор компаний, но при определении цен не используются (эмуляция же!)