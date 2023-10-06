<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/roles', function () {
    return view('admin/roles/index');
});
Route::get('/system', function () {
    return view('admin/systems/index');
});
Route::get('/admin/veterinarios', function () {
    return view('admin/veterinarios/index');
});
Route::get('/admin/clientes', function () {
    return view('admin/clientes/index');
});

Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('index');
Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show']);
Route::post('/users', [App\Http\Controllers\UserController::class, 'store']);

Route::get('/horarios', [App\Http\Controllers\HorarioController::class, 'index'])->name('index');
Route::post('/horarios', [App\Http\Controllers\HorarioController::class, 'store'])->name('store');

Route::get('/veterinarios', [App\Http\Controllers\VeterinarioController::class, 'index'])->name('index');
Route::post('/veterinarios', [App\Http\Controllers\VeterinarioController::class, 'store'])->name('store');
Route::put('/veterinarios/{id}', [App\Http\Controllers\VeterinarioController::class, 'update'])->name('update');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
