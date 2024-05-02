# REIL
Клонируем проект
>git clone https://github.com/shoumq/reil

Переходим в папку проекта
>cd reil

Устанавливаем PHP зависимости
>composer install

Делаем миграции
>php artisan migrate

Устанавливаем npm зависимости
>npm install

Добавляем 10 случайных пользователей 
>php artisan tinker
>User::factory()->count(10)->create();

Собираем проект
>npm run build

Запускаем сервер
>php artisan serve


(Регистайия юзера происходит на /register)