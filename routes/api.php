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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::resource('cliente', 'App\Http\Controllers\ClienteController');
Route::prefix('v1')->middleware('jwt.auth')->group(function () {
    Route::apiResource('banner', 'App\Http\Controllers\HomePageController');
    Route::apiResource('faq', 'App\Http\Controllers\FaqController');
    Route::apiResource('services', 'App\Http\Controllers\SevicesController');
    Route::apiResource('curiosity', 'App\Http\Controllers\CuriosityController');
    Route::apiResource('cards', 'App\Http\Controllers\CardsController');
    Route::apiResource('subscribe', 'App\Http\Controllers\SubscribeController');

    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
});
Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');


//usar nas rotas iniciais sem necessidade de login
Route::get('banner', [App\Http\Controllers\HomePageController::class, 'index']);
Route::get('faq', [App\Http\Controllers\FaqController::class, 'index']);
Route::get('services', [App\Http\Controllers\SevicesController::class, 'index']);
Route::get('curiosity', [App\Http\Controllers\CuriosityController::class, 'index']);
Route::get('cards', [App\Http\Controllers\CardsController::class, 'index']);
Route::post('subscribe', [App\Http\Controllers\SubscribeController::class, 'store']);



