<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;

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

Route::get('/', function () {
    return view('usuarios.login');
});

Route::resource('bienvenido', App\Http\Controllers\HomeController::class);


Route::get('registro', [App\Http\Controllers\RegisterController::class, 'index'])->name('registro');
Route::post('registro/verificar', [App\Http\Controllers\RegisterController::class, 'registrar'])->name('registro.verificar');

Route::get('login', [App\Http\Controllers\LoginController::class, 'index'])->name('login.index');
Route::post('login/validar', [App\Http\Controllers\LoginController::class, 'validarCredenciales'])->name('login.validar');
Route::get('login/cerrarSesion', [App\Http\Controllers\LoginController::class, 'cerrarSesion'])->name('login.cerrarSesion');


Route::post('role/actualizar', [App\Http\Controllers\RoleController::class, 'actualizar'])->name('roles.actualizar');
Route::get('role/eliminar/{id}', [App\Http\Controllers\RoleController::class, 'eliminar'])->name('roles.eliminar');
Route::resource('roles', RoleController::class);

Route::resource('profiles', UserProfileController::class);

Route::post('user/actualizar', [App\Http\Controllers\UserController::class, 'actualizar'])->name('users.actualizar');
Route::get('user/eliminar/{id}', [App\Http\Controllers\UserController::class, 'eliminar'])->name('users.eliminar');
Route::resource('users', UserController::class);
