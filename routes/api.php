<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
        Route::prefix('investors')->group(function() {
            Route::get('/', 'InvestorProfileController@index');
            Route::post('/', 'InvestorProfileController@store');
            Route::post('/interest', 'InvestorProfileController@storeInterest');
//            Route::post('/company', 'StartupProfileController@storeCompanyDetails');
//            Route::post('/product-service', 'StartupProfileController@storeProductService');
//            Route::post('/market', 'StartupProfileController@storeMarket');
//            Route::post('/finance', 'StartupProfileController@storeFinance');
        });
    });

    Route::get('startup-types', 'StartupTypesController@index');
    Route::get('user-types', 'UserTypesController@index');
    Route::get('industries', 'IndustriesController@index');
    Route::get('startup-stages', 'SettingsController@startupStages');
});

