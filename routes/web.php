<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
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

Route::get('/', [LaporanController::class, 'index'])->name('index');
Route::get('/cari', [LaporanController::class, 'find'])->name('cari');

Route::post('/store', [LaporanController::class,'store'])->name('store');

Route::get('/gallery', [LaporanController::class,'gallery'])->name('gallery');

Route::get("/login", [AuthController::class, 'index'])->name('login.index');
Route::post("/login/proc", [AuthController::class, 'login'])->name('login.login');
Route::get("/logout", [AuthController::class, 'logout'])->name('logout');


// Authentication Routesa

Route::resource('/admin', AdminController::class)->middleware("auth:user");