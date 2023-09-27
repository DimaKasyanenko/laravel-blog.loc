<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PostController::class, 'bestPost'])->name('home');
Route::get('/posts', [PostController::class, 'index'])->name('index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])
         ->name('login');
    Route::post('/login', [AuthController::class, 'authinticate'])
         ->name('login');
    Route::get('/forgot', [AuthController::class, 'forgotForm'])
         ->name('forgot');
    Route::post('/forgot', [AuthController::class, 'forgotSendEmail'])
         ->name('forgot-send-email');
    Route::get('forgot-password/{token}', [AuthController::class, 'forgotUpdatePasswordForm']);

    Route::put('update-password', [AuthController::class, 'updatePassword'])->name
    ('update-password');


    Route::get('/register', [AuthController::class, 'register'])
         ->name('register');

    Route::post('/register', [AuthController::class, 'store'])
         ->name('register');
});


Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])
         ->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});

