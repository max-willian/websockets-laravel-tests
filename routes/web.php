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
Route::post('/chat/webhook', function(\Illuminate\Http\Request $request){
    Log::info('teste', $request->all());
});

Route::get('/messages', 'ChatsController@fetchMessages');
Route::post('/messages', 'ChatsController@sendMessage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('order/new', function(Request $request){
    $validated = $request->validate([
        'user_id' => 'required',
        'description' => 'required',
        'value' => 'required',
    ]);

    $r =\App\Order::create($validated);

    dd($r);
});

Route::get('orders', 'OrdersController@index');