<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {

    broadcast(new \App\Events\WebsocketDemoEvent('some data'));

    return view('welcome');
});

Route::get('/chats', 'ChatsController@index');

Route::get('/messages', 'ChatsController@fetchMessages');
Route::post('/messages', 'ChatsController@sendMessage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('order/new', 'OrdersController@newOrder');

Route::get('orders', 'OrdersController@index');
Route::get('fetch-orders', 'OrdersController@fetchOrders');

Route::get('online-users', 'UsersController@onlineUsers');

Route::get('set-online', 'UsersController@setOnline');
Route::get('set-offline', 'UsersController@setOffline');

Route::any('/webhook', function(\Illuminate\Http\Request $request){
    Log::info('teste', $request->all());
});