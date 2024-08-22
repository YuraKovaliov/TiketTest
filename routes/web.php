<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Api\DeskController;
use Tymon\JWTAuth\Contracts\Providers\Auth;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/createTiket', [HomeController::class, 'createTiket'])->name('createTiket');
Route::get('/closeTiket', [HomeController::class, 'closeTiket'])->name('closeTiket');

Route::post('/selectTiket', [HomeController::class, 'selectTiket'])->name('selectTiket');

Route::post('/submit-form', [HomeController::class, 'submitForm']);

Route::patch('/tickets/{id}/open', [HomeController::class, 'opentiket'])->name('tickets.open');
Route::patch('/tickets/{id}/close', [HomeController::class, 'close'])->name('tickets.close');
Route::delete('/tickets/{id}', [HomeController::class, 'delete'])->name('tickets.delete');
//Route::get('/Api-info',[\App\Http\Controllers\MyController::class,'myToken']);

///api

Route::get('/{email}/all-tiket',[DeskController::class,'index']);


//Route::group([
//
//    'middleware' => 'api',
//    'prefix' => 'auth'
//
//], function ($router) {
//
//    Route::post('login', 'AuthController@login');
//    Route::post('logout', 'AuthController@logout');
//    Route::post('refresh', 'AuthController@refresh');
//    Route::post('me', 'AuthController@me');
//
//});
// Подключение маршрутов API



