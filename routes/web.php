<?php

use App\Helpers\HardwareHelper;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\user\userController;
use App\Http\Controllers\UserListController;
use App\Models\Product;
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


Route::middleware(['admin_auth'])->group(function() {
    // login register
    Route::redirect('/','loginPage');
    Route::get('loginPage',[AuthController::class,'login'])->name('login#page');
    Route::get('registerPage',[AuthController::class,'register'])->name('register#page');
});
Route::get('/show-id', function () {
    return HardwareHelper::getFingerprint();
});
Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

Route::get('/activate', [LicenseController::class, 'showActivatePage'])->name('activate.page');
Route::post('/activate', [LicenseController::class, 'activate'])->name('license.activate');
Route::middleware(['auth', 'license.guard'])->group(function () {
    // Admin
    Route::middleware(['admin_auth'])->group(function() {
        // CategoryController
        Route::group(['prefix' => 'category'],function() {
            Route::get('/list',[CategoryController::class,'list'])->name('category#list');
            Route::get('/create',[CategoryController::class,'create'])->name('admin#page');
            Route::post('recreate',[CategoryController::class,'recreate'])->name('re#create');
            Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('delete');
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('edit#page');
            Route::post('update/{id}',[CategoryController::class,'update'])->name('update#page');
            Route::post('uploadCsv',[CategoryController::class,'uploadCsv'])->name('upload#csv');
        });
        // admin account
        Route::prefix('admin')->group(function() {
            Route::get('password/changePage',[AdminController::class,'changePassword'])->name('admin#passwordchangePage');
            Route::post('password',[AdminController::class,'password'])->name('passwoord#page');

            // profile
            Route::get('detail',[AdminController::class,'detail'])->name('detail#page');
            Route::get('edit/account',[AdminController::class,'editAccount'])->name('edit#page#account');
            Route::post('update/{id}',[AdminController::class,'update'])->name('update#page#');

            // admin list
            Route::get('list',[AdminController::class,'list'])->name('admin#listPage');
            Route::get('delete/admin/{id}',[AdminController::class,'delete'])->name('admin#deletePage');
            Route::get('change/{id}',[AdminController::class,'change'])->name('admin#chagePage');
            Route::post('updata/change/{id}',[AdminController::class,'updateAdmin'])->name('updata#chage#page');
        });

        // product
        Route::prefix('product')->group(function() {
            Route::get('list',[ProductController::class,'list'])->name('list#page');
            Route::get('createPage',[ProductController::class,'createPage'])->name('create#page');
            Route::post('create',[ProductController::class,'create'])->name('data#createPage');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('delete#page');
            Route::get('edit/product/{id}',[ProductController::class,'editProduct'])->name('edit#page#product');
            Route::get('update/product/{id}',[ProductController::class,'updateProduct'])->name('updateProduct#page');
            Route::post('update',[ProductController::class,'update'])->name('update#product');
        });

        // order
        Route::prefix('order')->group(function () {
            Route::get('adminPage',[OrderController::class,'oderPage'])->name('orderAdmin#page');
            Route::get('ajax/status',[OrderController::class,'status'])->name('status#page');
            Route::get('ajax/change/status',[OrderController::class,'changeStatus'])->name('change#status');
            Route::get('listInfo/{orderCode}',[OrderController::class,'listInfo'])->name('listInfo#page');
        });

        // user
        Route::prefix('user')->group(function () {
            Route::get('list',[UserListController::class,'userList'])->name('userList#page');
            Route::get('change/role',[UserListController::class,'changeRole'])->name('changeRole#page');
        });
    });

    // user
    Route::group(['prefix' => 'user','middleware' => 'user_auth'],function() {
        Route::get('home',[userController::class,'home'])->name('home#page');
        Route::get('filter/{id}',[userController::class,'filter'])->name('filter#page');

        Route::prefix('password')->group(function() {
            Route::get('change',[userController::class,'password'])->name('changePassword#page');
            Route::post('change/page',[userController::class,'passwordChange'])->name('changePage#password');
        });

        Route::prefix('account')->group(function() {
            Route::get('list/account',[userController::class,'accountchangePage'])->name('account#change#page');
            Route::post('change/account/{id}',[userController::class,'changeAccountPage'])->name('change#account#page');
        });

        Route::prefix('ajax')->group(function() {
            Route::get('pizzaList',[AjaxController::class,'ajaxPage'])->name('ajax#page');
            Route::get('cart',[AjaxController::class,'cart'])->name('cart#page');
            Route::get('order',[AjaxController::class,'order'])->name('order#page');
            Route::get('cartClear',[AjaxController::class,'cartClear'])->name('cartClear#page');
            Route::get('cartCrow',[AjaxController::class,'cartCrow'])->name('cartCrow#page');
            Route::get('increase/viewCount',[AjaxController::class,'viewCount'])->name('viewCount#page');
        });

        Route::prefix('pizza')->group(function() {
            Route::get('detail/{id}',[userController::class,'detail'])->name('detail#pizza#page');
        });

        Route::prefix('cart')->group(function() {
            Route::get('list',[userController::class,'cartList'])->name('cartList#page');
            Route::get('history',[userController::class,'history'])->name('history#page');
        });
    });
});

