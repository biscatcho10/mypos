<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

        Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
            // Home Page
            Route::get('/', 'DashboardController@index')->name('dashboard.index');

            // Users Routes
            Route::resource('users', 'UserController')->except(['show']);

            // Categories Routes
            Route::resource('categories', 'CategoryController')->except(['show']);

            // Categories Routes
            Route::resource('products', 'ProductController')->except(['show']);
            Route::get('related-products/{id}', 'ProductController@related')->name('related-productd');

        });
    });



