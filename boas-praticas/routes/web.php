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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/collections', function(){
    $fruits = collect([
        'apple', 'pear', 'banana', 'strawberry'
    ]);
    $fruits = $fruits->reject(function($fruit){
        return $fruit == 'strawberry';
    });

    dd($fruits);
});

Route::group(['middleware' => 'auth', 'prefix' => 'orders'], function() {
    Route::get('/', 'OrderController@index')
            ->name('orders.index');
    Route::get('/create', 'OrderController@create')
            ->name('orders.create');
    Route::post('/create', 'OrderController@store')
            ->name('orders.store');
    Route::get('/all', 'OrderController@all');
});
