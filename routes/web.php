<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
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

Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
    Route::get('/login', 'loginView')->name('login');
    Route::get('/register', 'registerView')->name('register');
});

Route::middleware('auth')->group(function () {
    Route::controller(TodoController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/delete/{id}', 'destroy');
    });
    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('/profile', 'profile')->name('user.profile');
        Route::get('/profile/update', 'update');
    });
});

Route::get("/", [\App\Http\Controllers\HomeController::class, 'index']);
