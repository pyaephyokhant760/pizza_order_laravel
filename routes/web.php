<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

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


Route::redirect('/','loginPage');
Route::get('loginPage',[AuthController::class,'login'])->name('login#page');
Route::get('registerPage',[AuthController::class,'register'])->name('register#page');


Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');
    // Admin
    // CategoryController
    Route::group(['prefix' => 'category','middleware' => 'admin_auth'],function() {
        Route::get('/list',[CategoryController::class,'list'])->name('category#list');
        Route::get('/create',[CategoryController::class,'create'])->name('admin#page');
        Route::post('recreate',[CategoryController::class,'recreate'])->name('re#create');
    });
    // user
    Route::group(['prefix' => 'user','middleware' => 'user_auth'],function() {
        Route::get('home',function() {
            return view('user.user');
        })->name('user#page');
    });
});
