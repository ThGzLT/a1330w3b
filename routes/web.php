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


Route::get('home', 'ProductController@index')->name('produktas', 'kintamieji');
Route::get('/', 'ProductController@frontend')->name('produktas', 'kintamieji');
// Route::get('/', 'ProductController@show')->name('produktas', 'kintamieji');

Route::post('/reviews/{product_id}', ['uses' => 'ReviewsController@store', 'as' => 'reviews.store']);  // Reviews

Route::delete('myproductsDeleteAll', 'ProductController@deleteAll');


Route::resource('kintamieji', 'KintamiejiController');
Route::resource('products', 'ProductController');
