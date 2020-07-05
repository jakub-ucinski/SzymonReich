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


Route::get('/products', 'ProductsController@index');

Route::post('/contact', 'LandingController@contact');
Route::get('/', 'LandingController@index');
//Auth::routes();


// Authentication Routes...
Route::group(['prefix' => 'auth'], function () {

    Auth::routes();

});
// Auth::routes(['register' => false]);

Route::post('/admin/products', 'Admin\ProductsController@store')->name('products.store');

Route::get('/admin/products/create', 'Admin\ProductsController@create');


Route::get('/admin/products', 'Admin\ProductsController@index');

Route::get('/admin', 'AdminController@index')->name('admin');
