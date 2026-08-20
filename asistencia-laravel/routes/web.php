<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\Auth\LoginController;

// 1. Cuando la persona entra a ver la pantalla de login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// 2. Cuando la persona presiona el botón "Iniciar Sesión" (envía los datos)
Route::post('/login', [LoginController::class, 'login']);

// 3. Cuando la persona hace clic en "Cerrar Sesión"
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');