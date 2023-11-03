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

Route::get('/admin/roles', function () {
    return view('admin/roles/index');
})->middleware('can:administrador');

Route::get('/admin/users', function () {
    return view('admin/users/index');
})->middleware('can:administrador');

Route::get('/admin/veterinarios', function () {
    return view('admin/veterinarios/index');
})->middleware('can:administrador');

Route::get('/admin/clientes', function () {
    return view('admin/clientes/index');
});

Route::get('/admin/mascotas', function () {
    return view('admin/mascotas/index');
});

Route::get('/admin/citas', function () {
    return view('admin/citas/index');
});

Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('index');
Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('show');
Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('store');
Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('update');
Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('destroy');

Route::get('/horarios', [App\Http\Controllers\HorarioController::class, 'index'])->name('index');
Route::post('/horarios', [App\Http\Controllers\HorarioController::class, 'store'])->name('store');

Route::get('/veterinarios', [App\Http\Controllers\VeterinarioController::class, 'index'])->name('index');
Route::get('/veterinarios/{id}', [App\Http\Controllers\VeterinarioController::class, 'show'])->name('show');
Route::post('/veterinarios', [App\Http\Controllers\VeterinarioController::class, 'store'])->name('store');
Route::put('/veterinarios/{id}', [App\Http\Controllers\VeterinarioController::class, 'update'])->name('update');
Route::delete('/veterinarios/{id}', [App\Http\Controllers\VeterinarioController::class, 'destroy'])->name('destroy');

Route::get('/clientes', [App\Http\Controllers\ClienteController::class, 'index'])->name('index');
Route::get('/clientes/{id}', [App\Http\Controllers\ClienteController::class, 'show'])->name('show');
Route::post('/clientes', [App\Http\Controllers\ClienteController::class, 'store'])->name('store');
Route::put('/clientes/{id}', [App\Http\Controllers\ClienteController::class, 'update'])->name('update');
Route::delete('/clientes/{id}', [App\Http\Controllers\ClienteController::class, 'destroy'])->name('destroy');

Route::get('/mascotas', [App\Http\Controllers\MascotaController::class, 'index'])->name('index');
Route::get('/mascotas/{id}', [App\Http\Controllers\MascotaController::class, 'show'])->name('show');
Route::post('/mascotas', [App\Http\Controllers\MascotaController::class, 'store'])->name('store');
Route::put('/mascotas/{id}', [App\Http\Controllers\MascotaController::class, 'update'])->name('update');
Route::delete('/mascotas/{id}', [App\Http\Controllers\MascotaController::class, 'destroy'])->name('destroy');

Route::get('/citas', [App\Http\Controllers\CitaController::class, 'index'])->name('index');
Route::get('/citas/{id}', [App\Http\Controllers\CitaController::class, 'show'])->name('show');
Route::post('/citas', [App\Http\Controllers\CitaController::class, 'store'])->name('store');
Route::put('/citas/{id}', [App\Http\Controllers\CitaController::class, 'update'])->name('update');
Route::delete('/citas/{id}', [App\Http\Controllers\CitaController::class, 'destroy'])->name('destroy');


Route::get('/razas/{id}', [App\Http\Controllers\RazaController::class, 'index'])->name('index');

Route::get('/animales', [App\Http\Controllers\AnimalController::class, 'index'])->name('index');

Route::get('/reniec/{dni}', [App\Http\Controllers\ReniecController::class, 'show'])->name('show');

Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('index');
Route::get('/permisos', [App\Http\Controllers\PermissionController::class, 'index'])->name('index');
Route::get('/roles-permisos', [App\Http\Controllers\RolePermissionController::class, 'index'])->name('index');


/*Route::resource('veterinarios', App\Http\Controllers\VeterinarioController::class)->only([
    'index', 'show', 'store','update','destroy'
]);*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



