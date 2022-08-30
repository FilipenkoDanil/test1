<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## Техническое задание
Необходимо реализовать форму обратной связи на Laravel:
 
-регистрация\авторизация: стандартный модуль auth (но пользователи должны быть с двумя ролями: менеджер и клиент.
Клиенты регистрируются самостоятельно, а аккаунт менеджера должен быть создан заранее, логин и пароль выслать вместе с готовым заданием)
-после логина, клиент видит форму обратной связи, а менеджер список заявок. (все страницы и функционал доступны только авторизованным пользователям и только в соответствии с их привилегиями)
-менеджер может просматривать список заявок и отмечать те, на которые ответил.
-список заявок:
*ID, тема, сообщение, имя клиента, почта клиента, ссылка на прикрепленный файл, время создания
 
-клиент может оставлять заявку, но не чаще раза в сутки.
 
-на странице создания заявки: тема и сообщение, файловый инпут кнопка "отправить".
-в момент обработки формы и создания заявки отправлять менеджеру email со всеми данными
 
 
-отправку почты реализовать асинхронно (используя очереди), сделать хотя бы частичное покрытие тестами.

## Инструкция по развертыванию

1.  Скопируйе проект к себе 
``` git clone https://github.com/FilipenkoDanil/test1.git test1 ```

2. Переименуйте файл `.env.example` в `.env`.

3. Настройте подключение к вашей БД.

4. Установите пакеты: `composer install` и `npm install && npm run dev`

5. Выполните миграцию и запустите сидер: `php artisan db:seed UserManagerSeeder`. Он создаст модератора с логином `admin@gmail.com` и паролем `123123123`, а так же две роли: `user`, `manager`.

6. Команда `php artisan queue:work` запустит воркер, который будет отправлять письма менеджеру. Изначально отправка осуществляется в лог-файл. Для отправки на почтовый сервис настройте файл `.env` должным образом. Параметр `MODER_MAIL` отвечает за адрес почты модератора. Его можно изменить для отправки писем на другую почту.
