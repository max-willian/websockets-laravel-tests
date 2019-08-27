Video maneiro:

https://www.youtube.com/watch?v=H_4UubWE9NQ

````
#Instala os pacotes do websocket
composer require beyondcode/laravel-websockets

#cria os arquivos de migrations
php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="migrations"

#roda as migrations
php artisan migrate

#Cria arquivo de configuracao de websockets
php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="config"

#instala o pusher
composer require pusher/pusher-php-server "~3.0"

#instalacoes de js
npm install
npm install laravel-echo pusher-js
