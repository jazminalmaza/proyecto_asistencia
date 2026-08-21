<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/docentes/create', function () {
    return view('docentes.create');
})->name('docentes.create');

Route::post('/docentes', function () {
    return back()->with('exito', 'Docente guardado correctamente');
})->name('docentes.store');

Route::get('/asistencia', function () {
    $asistencia = []; 
    return view('asistencia.index', compact('asistencia'));
})->name('asistencia.index');

Route::get('/asistencia/registrar', function () {
    return view('asistencia.registrar');
})->name('asistencia.registrar');

Route::post('/asistencia', function () {
    return back()->with('exito', 'Asistencia marcada');
})->name('asistencia.marcar');

Route::get('/asistencia/editar', function () {
    return view('asistencia.edit');
})->name('asistencia.edit');

Route::put('/asistencia', function () {
    return back()->with('exito', 'Asistencia actualizada');
})->name('asistencia.update');