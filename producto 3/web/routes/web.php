<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\PrecioController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\ViajeroController;
use App\Http\Controllers\ZonaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;


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

Route::get('/')->name('homepage')->middleware('redirectUser');


Route::middleware(['appAuth:guest'])->group(function () {
    Route::get( "/login", [LoginController::class, 'login'])->name('login');

    Route::post( "/authenticateLogin", [LoginController::class, 'authenticate'])->name('authenticateLogin');

    Route::get( "/registrarse",  [RegistroController::class, 'registrarse'])->name('registrarse');

    Route::post( "/registrarRegular",  [RegistroController::class, 'registrarRegular'])->name('registrarRegular');
});


Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('appAuth:any');

Route::name('homepage.')->group(function () {
    Route::get( "/user", [HomeController::class, 'user'])->name('user')->middleware('appAuth:user');

    Route::get( "/corporate", [HomeController::class, 'corporate'])->name('corporate')->middleware('appAuth:corporate');
    
    Route::get( "/admin", [HomeController::class, 'admin'])->name('admin')->middleware('appAuth:admin');
});

Route::middleware(['appAuth:admin'])->prefix("admin/panel/")->group(function () {
    // Trayectos
    Route::resource('calendario', CalendarioController::class)->only(['index']);

    // Reservas
    Route::resource('reserva', ReservaController::class)->except(['show']);

    // Hoteles
    Route::resource('hotel', HotelController::class)->except(['show']);

    // Zonas
    Route::resource('zona', ZonaController::class)->except(['show']);

    // Vehiculos
    Route::resource('vehiculo', VehiculoController::class)->except(['show']);

    // Precios
    Route::resource('precio', PrecioController::class)->except(['show']);
});

// Viajero - Perfil
Route::prefix('user/')->middleware('appAuth:user')->group(function () {
    Route::middleware('appAuth:self')->group(function () {
        Route::resource('perfil', ViajeroController::class)->only(['show', 'update', 'edit']);
        Route::put('perfil/{perfil}/changePassword', [ViajeroController::class, 'changePassword'])->name('perfil.changePassword');
    });

    // Reservas
    Route::middleware('appAuth:reserva')->group(function () {
        Route::resource('userReserva', ReservaController::class)->only(['update', 'edit', 'destroy']);
    });

    Route::resource('userReserva', ReservaController::class)->only(['index', 'store', 'create']);
});

// Hotel - Perfil
Route::prefix('corporate')->middleware('appAuth:corporate')->group(function () {
    // Reservas
    Route::middleware('appAuth:reserva')->group(function () {
        Route::resource('corporateReserva', ReservaController::class)->only(['update', 'edit', 'destroy']);
    });

    Route::resource('corporateReserva', ReservaController::class)->only(['index', 'store', 'create']);
});


Route::fallback(function () {return redirect()->route('homepage');});
