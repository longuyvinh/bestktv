
## About Best KTV

Project play file audio + video

Shopping Cart

## How to setup 

$composer install

$composer dump-autoload

$cp .env.example .env //then fill some right information about url project and config database

$php artisan key:generate

$chmod -R 777 storage bootstrap/cache

$php artisan migrate:refresh --seed

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
