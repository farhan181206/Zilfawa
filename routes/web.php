<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\FrontController;
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

Route::get('/',[FrontController::class,'index'])->name('front');
Route::get('/about',[FrontController::class,'about'])->name('about');
Route::get('/detail',[FrontController::class,'detail'])->name('detail');
Route::get('/product',[FrontController::class,'product'])->name('product');

Route::get('/login',[AuthController::class,'login'])->name('login');

Route::post('/login/process',[AuthController::class,'login_process'])->name('login-process');

Route::get('/register',[AuthController::class,'register'])->name('register');

Route::post('/register/process',[AuthController::class,'register_process'])->name('register-process');

Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::prefix('admin')->middleware(['auth'])->group(function(){
    Route::get('/dashboard',[AuthController::class,'index'])->name('admin.dashboard');
    Route::get('/product',[ProductController::class,'index'])->name('admin.product');
});

