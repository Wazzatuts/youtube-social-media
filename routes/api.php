<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Authentication Routes
Route::group([
    'middleware' => 'api',
    'prefix' => 'users'
], function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('activate_email/{code}', 'AuthController@activateEmail');

    Route::post('forgotPasswordCreate', 'AuthController@forgotPasswordCreate');
    Route::get('forgotPassword/{token}', 'AuthController@forgotPasswordToken');


    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        //@todo passwordresets
    });
});

// User Routes
Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'user'
], function () {
    Route::get('me', 'UserController@me');
    Route::post('status/new', 'StatusUpdatesController@store');
});
