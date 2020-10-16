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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'home'])->name('root');

    Route::resource('tables', \App\Http\Controllers\TablesController::class, ['except' => ['create', 'show']]);
    Route::resource('slots', \App\Http\Controllers\SlotsController::class, ['except' => ['create', 'show']]);
});
