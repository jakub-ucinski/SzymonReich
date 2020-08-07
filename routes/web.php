<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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




Route::group(['prefix' => 'shop'], function () {
    
    Route::get('/{product}', 'ShopController@show');
    Route::get('', 'ShopController@index')->name('shop.index');



});



Route::group(['prefix' => 'order'], function () {
    
    Route::get('/create', 'OrdersController@create')->name('order.create');
    Route::post('', 'OrdersController@store')->name('order.store');
    Route::post('/verify', 'OrdersController@verify');



});

Route::get('/migrate', function () {
    return Artisan::call('migrate:fresh', ["--force" => true ]);
})->middleware('auth');

Route::get('/migratefresh', function () {
    return Artisan::call('migrate:fresh', ["--force" => true ]);
})->middleware('auth');

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
})->middleware('auth');


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
    Route::delete('/{page}', 'Admin\PagesController@destroy')->name('pages.destroy');


});


Route::group(['prefix' => 'pages'], function () {
    
    Route::get('/{page}', 'PagesController@show');

});



Route::group(['prefix' => 'admin/products'], function () {
    Route::put('/updateall', 'Admin\ProductsController@updateall')->name('products.updateall');
    // Route::put('/products/updateall', function ()
    // {
    //     return 'success';
    // });


    Route::patch('/{product}', 'Admin\ProductsController@update')->name('products.update');
    Route::get('/{product}/edit', 'Admin\ProductsController@edit')->name('products.edit');
    Route::delete('/{product}', 'Admin\ProductsController@destroy')->name('products.destroy');
    Route::post('', 'Admin\ProductsController@store')->name('products.store');
    Route::get('/create', 'Admin\ProductsController@create')->name('products.create');
    Route::get('', 'Admin\ProductsController@index')->name('products.index');


});



Route::group(['prefix' => 'admin/productimages'], function () {
    
    Route::get('/index', 'Admin\ProductImagesController@index')->name('productImages.index');
    Route::put('/updateall', 'Admin\ProductImagesController@updateall')->name('productImages.updateall');
    Route::delete('/{productimage}', 'Admin\ProductImagesController@destroy')->name('productImages.destroy');


});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin');
});





