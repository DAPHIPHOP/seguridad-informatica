<?php

use App\Http\Controllers\HomeController;
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



Route::post('registrar-usuario',[UserController::class,'store'])->name('user.store');
Route::get('editar-usuario/{id}',[UserController::class,'edit'])->name('user.edit');
Route::post('actualizar-usuario/{id}',[UserController::class,'update'])->name('user.update');
Route::get('eliminar-usuario/{id}',[UserController::class,'destroy'])->name('user.destroy');


