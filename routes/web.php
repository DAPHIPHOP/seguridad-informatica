<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('loged',[HomeController::class,'logued'])->name('logued');
Route::post('save-password',[UserController::class,'updatePassword'])->name('update.password');
Route::get('cambiar-contrasenia',[UserController::class,'changePassword'])->name('change.password');




Route::post('registrar-usuario',[UserController::class,'store'])->name('user.store');
Route::get('editar-usuario/{id}',[UserController::class,'edit'])->name('user.edit');
Route::post('actualizar-usuario/{id}',[UserController::class,'update'])->name('user.update');
Route::get('eliminar-usuario/{id}',[UserController::class,'destroy'])->name('user.destroy');
Route::get('validar-contrasenia',[UserController::class,'validarContrasenia'])->name('validarContrasenia');
Route::get('update-state/{id}',[UserController::class,'updateState'])->name('update.state');



Route::resource('perfil', PerfilController::class);
Route::get('update-state-profile/{id}',[PerfilController::class,'updateState'])->name('update.stateProfile');


