<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
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

Route::resource('bienvenido', HomeController::class);


Route::get('registro', [RegisterController::class, 'index'])->name('registro');
Route::post('registro/verificar', [RegisterController::class, 'registrar'])->name('registro.verificar');

Route::get('login', [LoginController::class, 'index'])->name('login.index');
Route::post('login/validar', [LoginController::class, 'validarCredenciales'])->name('login.validar');
Route::get('login/cerrarSesion', [LoginController::class, 'cerrarSesion'])->name('login.cerrarSesion');


Route::post('role/actualizar', [RoleController::class, 'actualizar'])->name('roles.actualizar');
Route::get('role/eliminar/{id}', [RoleController::class, 'eliminar'])->name('roles.eliminar');
Route::resource('roles', RoleController::class);

Route::resource('profiles', UserProfileController::class);

Route::post('user/actualizar', [UserController::class, 'actualizar'])->name('users.actualizar');
Route::get('user/eliminar/{id}', [UserController::class, 'eliminar'])->name('users.eliminar');
Route::resource('users', UserController::class);

Route::post('category/actualizar', [CategoryController::class, 'actualizar'])->name('categories.actualizar');
Route::get('category/eliminar/{id}', [CategoryController::class, 'eliminar'])->name('categories.eliminar');
Route::resource('categories', CategoryController::class);

Route::post('sub-category/actualizar', [SubCategoryController::class, 'actualizar'])->name('sub-categories.actualizar');
Route::get('sub-category/eliminar/{id}', [SubCategoryController::class, 'eliminar'])->name('sub-categories.eliminar');
Route::resource('sub-categories', SubCategoryController::class);

Route::post('product/actualizar', [ProductController::class, 'actualizar'])->name('products.actualizar');
Route::get('product/eliminar/{id}', [ProductController::class, 'eliminar'])->name('products.eliminar');
Route::resource('products', ProductController::class);
