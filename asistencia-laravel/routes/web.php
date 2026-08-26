<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\UsuarioController;
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('home');
})->middleware('auth')->name('dashboard');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/docentes/create', [DocenteController::class, 'create'])->name('docentes.create');
Route::post('/docentes', [DocenteController::class, 'store'])->name('docentes.store');

Route::get('/asistencia', [AsistenciaController::class, 'index'])->name('asistencia.index');
Route::get('/asistencia/registrar', [AsistenciaController::class, 'create'])->name('asistencia.registrar');
Route::post('/asistencia', [AsistenciaController::class, 'store'])->name('asistencia.marcar');
Route::get('/asistencia/editar', [AsistenciaController::class, 'edit'])->name('asistencia.edit');
Route::put('/asistencia', [AsistenciaController::class, 'update'])->name('asistencia.update');


Route::middleware(['auth'])->group(function () {
Route::get('/crear-cuenta', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::post('/crear-cuenta', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::middleware(['auth'])->group(function () {
    
    // Este apunta al index que YA TENÉS en la carpeta asistencia
    Route::get('/prosecretario/dashboard', function () {
        return view('asistencia.index'); 
    })->name('prosecretario.index');

    // Este va a apuntar al NUEVO index que vas a crear en la carpeta jefe
    Route::get('/jefe/dashboard', function () {
        return view('jefe.index'); 
    })->name('jefe.index');

});