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




Route::group(['prefix' => 'sklep'], function () {
    
    Route::get('/products', 'ShopController@products');
    Route::get('', 'ShopController@landing')->name('shop.landing');

    Route::group(['prefix' => 'order'], function () {
    
        Route::post('', 'OrdersController@store')->name('order.store');
        Route::get('/thankyou', 'OrdersController@thankyou');

        Route::post('/verify', 'OrdersController@verify');
        // Route::get('/webtruck', 'OrdersController@webtruck')->middleware('auth');

    
    
    });

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


// Authentication Routes...
Route::group(['prefix' => 'auth'], function () {
    // Auth::routes(['register' => false]);
    Auth::routes();

});



Route::group(['prefix' => 'pages'], function () {
    
    Route::get('/{page}', 'PagesController@show');

});



Route::group(['prefix' => 'admin'], function () {
    Route::put('/products/updateall', 'Admin\ProductsController@updateall')->name('products.updateall');
    Route::put('/productimages/updateall', 'Admin\ProductImagesController@updateall')->name('productImages.updateall');
    Route::put('/product/{product}/variationcategory/updateall', 'Admin\ProductVariationCategoriesController@updateall')->name('product.variationcategory.updateall');
    Route::put('/variationcategories/{variationcategory}/variationoption/updateall', 'Admin\ProductVariationOptionsController@updateall')->name('variationcategories.variationoption.updateall');
    Route::put('/product/{product}/variation/updateall', 'Admin\ProductVariationsController@updateall')->name('product.variation.updateall');
    // Route::get('/variation/{variation}/edit', 'Admin\ProductVariationsController@edit')->name('product.variation.edit');


    Route::resource('products', 'Admin\ProductsController')->except(['show']);
    Route::resource('pages', 'Admin\PagesController')->except(['show']);


    Route::resource('products.recommendation', 'Admin\RecommendationsController')->except(['show'])->shallow();
    Route::resource('products.variationcategory', 'Admin\ProductVariationCategoriesController')->except(['show'])->shallow();
    Route::post('/variationcategories/{variationcategory}/variationoption', 'Admin\ProductVariationOptionsController@store')->name('variationcategories.variationoption.store');

    Route::resource('variationcategories.variationoption', 'Admin\ProductVariationOptionsController')->except(['show', 'store'])->shallow();
    Route::resource('products.variation', 'Admin\ProductVariationsController')->except(['show'])->shallow();

    Route::resource('productimages', 'Admin\ProductImagesController')->only([
        'index', 'destroy'
    ]);




});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin');
});

Route::post('/variations', 'VariationsController@returnVariation');





