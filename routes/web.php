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

Route::get('/', 'VentaCtrl@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/ingredient', 'IngredientCtrl');
Route::prefix('json')->group(function () {
    Route::get('/get_ingredients', 'IngredientCtrl@get_ingredients')->name('ingredient.get_ingredients');
});

Route::prefix('sale')->group(function () {
    Route::get('/', 'VentaCtrl@index')->name('sale.index');
    Route::post('/freelunch', 'VentaCtrl@freelunch')->name('sale.freelunch');
    Route::get('/order/{id}', 'VentaCtrl@order')->name('sale.order');
});
Route::prefix('kitchen')->group(function () {
    Route::get('/', 'KitchenCtrl@index')->name('kitchen.index');
    Route::get('/order/{id}', 'KitchenCtrl@order')->name('kitchen.order');
    Route::post('/order/{id}', 'KitchenCtrl@order_status')->name('kitchen.order_status');
    Route::get('/buy/{id}', 'KitchenCtrl@buy_ingredients')->name('kitchen.buy_ingredients');

});

Route::resource('/recipe', 'RecipeCtrl');
Route::resource('/client', 'ClientCtrl');

