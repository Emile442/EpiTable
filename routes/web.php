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

    Route::resource('bookings', \App\Http\Controllers\BookingsController::class, ['except' => ['create', 'show']]);
    Route::get('bookings/my', [\App\Http\Controllers\BookingsController::class, 'my'])->name('booking.my');
    Route::get('bookings/random', [\App\Http\Controllers\BookingsController::class, 'randomPlace']);

    Route::resource('users', \App\Http\Controllers\UsersController::class, ['except' => ['create', 'show']]);

    Route::resource('tables', \App\Http\Controllers\TablesController::class, ['except' => ['create', 'show']]);
    Route::get('tables/json', [\App\Http\Controllers\TablesController::class, 'apiIndex']);

    Route::resource('slots', \App\Http\Controllers\SlotsController::class, ['except' => ['create', 'show']]);
});

Route::resource('articles', \App\Http\Controllers\admin\ArticlesController::class);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/oauth2/azure/redirect', [\App\Http\Controllers\OAuthController::class, 'azureRedirect'])->name('auth.azure.redirect');
    Route::get('/oauth2/azure/callback', [\App\Http\Controllers\OAuthController::class, 'azureCallback'])->name('auth.azure.callback');
});

