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


Route::get('/shop', 'ShopController@index');
Route::post('/contact', 'LandingController@contact');
Route::get('/', 'LandingController@index');
//Auth::routes();


// Authentication Routes...
Route::group(['prefix' => 'auth'], function () {
    Auth::routes();
});

Route::patch('/admin/products/{product}', 'Admin\ProductsController@update')->name('products.update');
Route::get('/admin/products/{product}/edit', 'Admin\ProductsController@edit')->name('products.edit');
Route::delete('/admin/products/{product}', 'Admin\ProductsController@destroy')->name('products.destroy');
Route::post('/admin/products', 'Admin\ProductsController@store')->name('products.store');
Route::get('/admin/products/create', 'Admin\ProductsController@create')->name('products.create');
Route::get('/admin/products', 'Admin\ProductsController@index')->name('products.index');

Route::delete('/admin/productimages/{productimage}', 'Admin\ProductImagesController@destroy')->name('productImages.destroy');


Route::get('/admin', 'AdminController@index')->name('admin');
