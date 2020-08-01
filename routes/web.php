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

Route::get('/shop/{product}', 'ShopController@show');
Route::get('/shop', 'ShopController@index');

Route::post('/contact', 'LandingController@contact');
Route::get('/', 'LandingController@index');
//Auth::routes();


// Authentication Routes...
Route::group(['prefix' => 'auth'], function () {
    Auth::routes();
});

Route::group(['prefix' => 'admin/pages'], function () {
    
    Route::get('', 'Admin\PagesController@index')->name('pages.index');
    Route::get('/create', 'Admin\PagesController@create')->name('pages.create');
    Route::post('', 'Admin\PagesController@store')->name('pages.store');
    Route::get('/{page}/edit', 'Admin\PagesController@edit')->name('pages.edit');
    Route::patch('/{page}', 'Admin\PagesController@update')->name('pages.update');

});


Route::group(['prefix' => 'pages'], function () {
    
    Route::get('/{page}', 'PagesController@show');

});




Route::group(['prefix' => 'admin'], function () {
    Route::put('/products/updateall', 'Admin\ProductsController@updateall')->name('products.updateall');
    // Route::put('/products/updateall', function ()
    // {
    //     return 'success';
    // });


    Route::patch('/products/{product}', 'Admin\ProductsController@update')->name('products.update');
    Route::get('/products/{product}/edit', 'Admin\ProductsController@edit')->name('products.edit');
    Route::delete('/products/{product}', 'Admin\ProductsController@destroy')->name('products.destroy');
    Route::post('/products', 'Admin\ProductsController@store')->name('products.store');
    Route::get('/products/create', 'Admin\ProductsController@create')->name('products.create');
    Route::get('/products', 'Admin\ProductsController@index')->name('products.index');


    Route::get('/productimages/index', 'Admin\ProductImagesController@index')->name('productImages.index');
    Route::put('/productimages/updateall', 'Admin\ProductImagesController@updateall')->name('productImages.updateall');
    Route::delete('/productimages/{productimage}', 'Admin\ProductImagesController@destroy')->name('productImages.destroy');


    Route::get('/', 'AdminController@index')->name('admin');
});








