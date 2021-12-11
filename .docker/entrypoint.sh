#! /bin/bash

echo 'Ca marche ✅'

[[ ! -d ./vendor ]] && composer install
[[ ! -d ./node_modules ]] && pnpm install

[[ ! -f ./.env ]] && cp .env.example .env

php artisan key:generate
php artisan migrate

[[ ! -f ./public/js/app.js ]] && yes | pnpm mix

php artisan serve --host=0.0.0.0    