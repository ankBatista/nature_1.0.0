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
// Rota de fallback para lidar com páginas não encontradas (erro 404)
Route::fallback(function () {
    return view('notfond'); // Exemplo: redirecionar para uma view de erro 404
});

Route::get('/', function () {
    return view('index');
});
Route::get('/home', function () {
    return view('index');
});

Route::middleware('auth')->group(function () {

    Route::get('/banner', function () {
        return view('edit.banner');
    });

    Route::get('/faq', function () {
        return view('edit.faq');
    });

    Route::get('/services', function () {
        return view('edit.services');
    });

    Route::get('/curiosity', function () {
        return view('edit.curiosity');
    });

    Route::get('/cards', function () {
        return view('edit.cards');
    });

    // Route::get('/about', function () {
    //     return view('edit.about');
    // });

    Route::get('/teste', function () {
        return view('teste');
    });
});

Auth::routes();
