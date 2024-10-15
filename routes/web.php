<?php

use App\Models\Product;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use PHPUnit\TextUI\XmlConfiguration\Group;

Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/','LoginPage');
    Route::get('LoginPage',[AuthController::class,'login'])->name('auth#login');
    Route::get('RegisterPage',[AuthController::class,'register'])->name('auth#register');

});

Route::middleware(['auth'])->group(function () {
    //dashboard decide admin and user after auth
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    //admin panel
    Route::middleware(['admin_auth'])->group(function(){
        //admin category page
        Route::group(['prefix'=>'category'], function(){
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            Route::get('create',[CategoryController::class, 'create'])->name('category#create');
            Route::post('insert',[CategoryController::class, 'postcreate'])->name('post#create');
            Route::get('delete/{id}',[CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}',[CategoryController::class, 'edit'])->name('category#edit');
            Route::post('update/{id}',[CategoryController::class, 'update'])->name('categpry#update');
        });

        //admin page
        Route::prefix('account')->group(function(){
            //admin password
            Route::get('changePage',[AdminController::class,'change'])->name('admin#change');
            Route::post('passwordChangePage',[AdminController::class,'passwordChange'])->name('adminpassword#change');
            Route::get('/reset-password/{id}/{newPassword}', [AdminController::class, 'resetPassword']);
            //admin account
            Route::get('adminDetail',[AdminController::class,'detail'])->name('admin#detail');
            Route::get('detailEdit',[AdminController::class,'edit'])->name('detail#edit');
            Route::post('detailUpdate/{id}',[AdminController::class,'update'])->name('detail#update');
            //admin list
            Route::get('adminlist',[AdminController::class,'list'])->name('admin#list');
            Route::get('admindelete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::get('adminrole/{id}',[AdminController::class,'changeRole'])->name('change#role');
            Route::post('roleUpdate/{id}',[AdminController::class,'roleUpdate'])->name('role#update');
        });

        //admin product page
        Route::prefix('product')->group(function(){
            Route::get('list',[ProductController::class,'list'])->name('product#list');
            Route::get('create',[ProductController::class,'create'])->name('product#create');
            Route::post('insert',[ProductController::class, 'insert'])->name('product#insert');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
            Route::get('updatePage/{id}',[ProductController::class, 'updatePage'])->name('productupdate#page');
            Route::post('update/{id}',[ProductController::class,'update'])->name('product#update');
        });

        //admin order list
        Route::prefix('adminOrder')->group(function(){
            Route::get('orderList',[OrderController::class,'orderList'])->name('adminOrder#list');
            Route::get('orderStatus',[OrderController::class,'status'])->name('adminOrder#status');
            Route::get('ajax/changeStatus',[OrderController::class,'changeStatus'])->name('adminChange#status');
            Route::get('orderDetail/{order_code}',[OrderController::class,'orderDetail'])->name('adminOrder#detail');
        });

        //admin user list
        Route::prefix('adminUser')->group(function(){
            Route::get('userList',[UserController::class,'userList'])->name('admin#userList');
            Route::get('userList/delete/{id}',[UserController::class,'userDelete'])->name('admin#userDelete');
            Route::get('ajax/changeRole',[UserController::class,'changeRole'])->name('admin#UserchangeRole');
            Route::get('contact',[UserController::class,'contactAdmin'])->name('admin#contact');
        });

    });


   // user panel
    Route::group(['prefix'=>'user','middleware' => 'user_auth'], function(){
        Route::get('home',[UserController::class,'home'])->name('user#home');
        Route::get('filterCategory/{id}',[UserController::class,'filter'])->name('filter#category');
        Route::get('menuDetail/{id}',[UserController::class,'menuDetail'])->name('user#menuDetail');
        Route::get('orderHistory',[UserController::class,'orderHistory'])->name('order#history');

        //user password
        Route::get('changePassword',[UserController::class,'change'])->name('user#changePassword');
        Route::post('updatePassword/{id}',[UserController::class,'update'])->name('user#updatePassword');

        //user account
        Route::prefix('account')->group(function(){
            Route::get('detail',[UserController::class,'detail'])->name('user#detail');
            Route::post('detailUpdate/{id}',[UserController::class,'userUpdate'])->name('userdetail#update');
        });

        //user cart
        Route::prefix('cart')->group(function(){
            Route::get('cartList',[UserController::class,'cartList'])->name('cart#list');
        });

        //user contact
        Route::prefix('contact')->group(function(){
            Route::get('contact',[UserController::class,'contact'])->name('user#contact');
            Route::post('contact',[UserController::class,'contactInsert'])->name('contact#insert');
        });

        //ajax
        Route::prefix('ajax')->group(function(){
            Route::get('productlist',[AjaxController::class,'list'])->name('Userproduct#list');
            Route::get('insertCart',[AjaxController::class,'insert'])->name('user#cart');
            Route::get('orderList',[AjaxController::class,'orderList'])->name('order#list');
            Route::get('cartClear',[AjaxController::class,'cartClear'])->name('cart#clear');
            Route::get('cart/rowClear',[AjaxController::class,'rowClear'])->name('row#clear');
            Route::get('viewCount',[AjaxController::class,'viewCount'])->name('user#viewCount');
        });
    });

});
