<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
});
