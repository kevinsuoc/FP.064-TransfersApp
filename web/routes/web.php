<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get( "/", action: [HomeController::class, 'index'])->name('homepage');

Route::get( "/login", action: [HomeController::class, 'login'])->name('login');

Route::name('homepage')->group(function () {
    Route::get( "/user", [HomeController::class, 'user'])->name('user')->middleware('auth:user');

    Route::get( "/corporate", [HomeController::class, 'corporate'])->name('corporate')->middleware('auth:corporate');
    
    Route::get( "/admin", [HomeController::class, 'admin'])->name('admin')->middleware('auth:admin');
});

Route::fallback([HomeController::class, 'index'])->name('homepage');

// User type: Regular, corporate, admin