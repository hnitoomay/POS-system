<?php

use App\Http\Controllers\api\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('apiTesting',function(){
    $data = [
        'message' => 'This is api testing'
    ];
    return response()->json($data, 200);
});

Route::get('product/list',[RouteController::class,'productList']);
//localhost:8000/api/product/list (GET)

Route::get('category/list',[RouteController::class,'categoryList']);
//localhost:8000/api/category/list (GET)

Route::post('category/create',[RouteController::class,'categoryCreate']);
//localhost:8000/api/category/create

Route::post('category/delete',[RouteController::class, 'categoryDelete']);
//localhost:8000/api/category/delete (POST)

Route::post('category/show',[RouteController::class, 'categoryShow']);
//localhost:8000/api/category/show?id=7

Route::post('category/update',[RouteController::class, 'categoryUpdate']);
//localhost:8000/api/category/update?name=Spicy Ramen&id=6


Route::post('contact/create',[RouteController::class,'contactCreate']);
Route::get('contact/delete/{id}',[RouteController::class,'contactDelete']);
//localhost:8000/api/contact/delete/5 (GET)
