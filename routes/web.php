<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\User\LoginController;
use \App\Http\Controllers\Admin\MainController;
use \App\Http\Controllers\Admin\CategoryController;
use \App\Http\Controllers\Admin\ProductController;
use \App\Http\Controllers\Admin\UploadController;
use \App\Http\Controllers\Admin\UserController;
use \App\Http\Controllers\CartController;
use \App\Http\Controllers\OrderController;
use \App\Http\Controllers\Sale\SaleController;

#User
Route::get('/user/login', [LoginController::class, 'index'])->name('login');
Route::get('/user/register', [LoginController::class, 'create']);
Route::post('/user/register', [LoginController::class, 'createPost']);
Route::post('/user/login', [LoginController::class, 'store']);
Route::get('/logout/store', [LoginController::class, 'logout']);

#Admin
Route::middleware(['auth']) -> group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [MainController::class, 'index']);

        Route::get('main', [MainController::class, 'index']);

        #Category
        Route::prefix('categorys')->group(function () {
            Route::get('add', [CategoryController::class, 'create']);
            Route::post('add', [CategoryController::class, 'store']);
            Route::get('list', [CategoryController::class, 'index']);
            Route::get('edit/{category}', [CategoryController::class, 'show']);
            Route::post('edit/{category}', [CategoryController::class, 'update']);
            Route::DELETE('destroy', [CategoryController::class, 'destroy']);
        });

        #Product
        Route::prefix('products')->group(function () {
            Route::get('add', [ProductController::class, 'create']);
            Route::post('add', [ProductController::class, 'store']);
            Route::get('list', [ProductController::class, 'index']);
            Route::get('edit/{product}', [ProductController::class, 'show']);
            Route::post('edit/{product}', [ProductController::class, 'update']);
            Route::DELETE('destroy', [ProductController::class, 'destroy']);
        });

        #Upload
        Route::post('upload/services', [UploadController::class, 'store']);

        #Cart
        Route::prefix('customers')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\CartController::class, 'index']);
            Route::get('/view/{orders}', [\App\Http\Controllers\Admin\CartController::class, 'show']);
            Route::post('/confirm', [\App\Http\Controllers\Admin\CartController::class, 'update']);
            Route::DELETE('/destroy', [\App\Http\Controllers\Admin\CartController::class, 'destroy']);
        });
        #User
        Route::prefix('users')->group(function () {
            Route::get('add', [UserController::class, 'create']);
            Route::post('add', [UserController::class, 'store']);
            Route::get('list', [UserController::class, 'index']);
            Route::get('edit/{user_}', [UserController::class, 'show']);
            Route::post('edit/{user_}', [UserController::class, 'update']);
            Route::DELETE('destroy', [UserController::class, 'destroy']);
        });

    });
});

#User
Route::middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\MainController::class, 'index']);
    Route::get('/danh-muc/{id}-{slug}.html', [\App\Http\Controllers\CategoryController::class, 'index']);
    Route::get('/san-pham/{id}-{slug}.html', [\App\Http\Controllers\ProductController::class, 'index']);
    Route::post('/add-cart', [CartController::class, 'index']);
    Route::get('/carts', [CartController::class, 'show']);
    Route::post('/update-cart', [CartController::class, 'update']);
    Route::get('/carts/delete/{id}', [CartController::class, 'remove']);
    Route::post('/carts', [CartController::class, 'addCart']);
    Route::get('/order', [OrderController::class, 'index']);
    Route::get('/order/{orders}', [OrderController::class, 'show']);
});

#Sale
Route::middleware(['auth'])->group(function () {
    Route::get('/sale', [SaleController::class, 'index']);
    Route::prefix('/sale/customers')->group(function () {
        Route::get('/', [SaleController::class, 'list']);
        Route::get('/view/{orders}', [SaleController::class, 'show']);
        Route::post('/confirm', [SaleController::class, 'update']);
        Route::DELETE('/destroy', [SaleController::class, 'destroy']);
    });
});

