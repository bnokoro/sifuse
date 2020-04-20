<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('user', 'UserController@index');
        Route::prefix('startups')->group(function() {
            Route::get('/', 'StartupProfileController@index');
            Route::post('/', 'StartupProfileController@store');
            Route::post('/company', 'StartupProfileController@storeCompanyDetails');
            Route::post('/product-service', 'StartupProfileController@storeProductService');
            Route::post('/market', 'StartupProfileController@storeMarket');
            Route::post('/finance', 'StartupProfileController@storeFinance');
        });
    });
});

