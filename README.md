## Cara nge run

1. buat file .env
1. configurasi .env sesuai dengan dbs yg dipakai
1. cmd `composer update`
1. cmd `composer install`
1. cmd `php artisan key:generate`
1. cmd `npm install sweetalert --save`
1. cmd `php artisan serve`
1. cmd `php artisan websockets:serve`
1. cmd `php artisan migrate:refresh --seed`
1. cmd `npm run dev`
1. cmd `composer require psr/simple-cache:2.0 maatwebsite/excel` dan melihat dokumentasi berikut https://docs.laravel-excel.com/3.1/getting-started/installation.html

pusher/pusher-php-server versi 7.2 masih eror sehingga tidak bisa melakukan listen terhadap event, maka digunakan pusher ver 7.0. Command `composer require pusher/pusher-php-server:7.0.2`
