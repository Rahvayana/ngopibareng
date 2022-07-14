<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
Route::get('/register',[AuthController::class,'register_view'])->name('register');
Route::post('/register',[AuthController::class,'register'])->name('register-process');

Route::get('/',[AuthController::class,'login_view'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('login-process');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::get('/dashboard',[HomeController::class,'index'])->name('dashboard');

Route::get('users',[UserController::class,'index'])->name('users.index');
Route::get('profile',[UserController::class,'detail'])->name('users.detail');
Route::get('show-user/{id}',[UserController::class,'show'])->name('users.show');
Route::get('cari-user',[UserController::class,'cari'])->name('users.cari');
Route::get('add-user',[UserController::class,'create'])->name('users.create');
Route::post('user',[UserController::class,'store'])->name('users.store');
Route::get('edit-user/{id}',[UserController::class,'edit'])->name('users.edit');
Route::post('user/{id}',[UserController::class,'update'])->name('users.update');
Route::post('delete-user/{id}',[UserController::class,'destroy'])->name('users.destroy');
Route::get('export-user',[UserController::class,'export'])->name('users.export');
