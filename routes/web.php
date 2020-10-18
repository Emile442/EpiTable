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

    Route::post('bookings', [\App\Http\Controllers\BookingsController::class, 'store']);
    Route::get('bookings', [\App\Http\Controllers\BookingsController::class, 'index']);
    Route::get('bookings/my', [\App\Http\Controllers\BookingsController::class, 'my'])->name('booking.my');
    Route::delete('bookings/my/{booking}', [\App\Http\Controllers\BookingsController::class, 'deleteMy'])->name('booking.my.delete');

    Route::resource('users', \App\Http\Controllers\UsersController::class, ['except' => ['create', 'show']]);

    Route::resource('tables', \App\Http\Controllers\TablesController::class, ['except' => ['create', 'show']]);
    Route::get('tables/json', [\App\Http\Controllers\TablesController::class, 'apiIndex']);

    Route::resource('slots', \App\Http\Controllers\SlotsController::class, ['except' => ['create', 'show']]);
});
