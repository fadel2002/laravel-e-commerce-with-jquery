## Prerequisite

1. php 8.1.\*
1. buat file .env
1. configurasi .env sesuai dengan dbs yg dipakai
1. cmd `composer update`
1. cmd `composer install`
1. cmd `php artisan key:generate`
1. cmd `npm install sweetalert --save`
1. cmd `php artisan migrate:refresh --seed`
1. cmd `composer require psr/simple-cache:2.0 maatwebsite/excel` dan melihat dokumentasi berikut https://docs.laravel-excel.com/3.1/getting-started/installation.html
1. `https://beyondco.de/docs/laravel-websockets/getting-started/installation`
1. cmd `composer require beyondcode/laravel-websockets`
1. cmd `composer require pusher/pusher-php-server:7.0.2`

## Cara nge run

1. cmd `php artisan serve`
1. cmd `php artisan websockets:serve`
1. cmd `npm run dev`

## Note

pusher/pusher-php-server versi 7.2 masih eror sehingga tidak bisa melakukan listen terhadap event, maka digunakan pusher ver 7.0.

## File .env

```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mywarung
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=pusher
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=*mailtrap_username*
MAIL_PASSWORD=*mailtrap_password*
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=testingwebsocket
PUSHER_APP_KEY=qwerty
PUSHER_APP_SECRET=12345
PUSHER_HOST=localhost
PUSHER_PORT=6001
PUSHER_SCHEME=http
PUSHER_APP_CLUSTER=mt1

VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```
