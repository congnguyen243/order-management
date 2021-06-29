<?php

use Illuminate\Support\Facades\Route;

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
/**
 * Product Management
 */
Route::get('/products', 'ProductController@index');

/**
 * Order Management
 */
Route::get('/orders', 'OrderController@index');
Route::post('/order/create', 'OrderController@create');
Route::post('/order/delete', 'OrderController@destroy');
Route::post('/order/show', 'OrderController@show');
Route::post('/order/update', 'OrderController@update');
Route::post('/order/getOrders', 'OrderController@getAll');
