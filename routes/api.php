<?php

use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\PromotionsController;
use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\WishController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'Register']);
Route::post('/guest/login',[AuthController::class,'GuestLogin']);


Route::middleware('auth:sanctum')->group(function () {
//    user
Route::post('/logout',[AuthController::class,'logout']);
Route::get('/user/info',[AuthController::class,'userInfo']);

//product
    Route::post('/create/product',[ProductsController::class,'productCreate']);
    Route::get('/all/product',[ProductsController::class,'allproduct']);
//category
    Route::post('/add/category',[CategoriesController::class,'addcategory']);
    Route::get('/all/category',[CategoriesController::class,'allcategory']);

//    order
    Route::post('/place/order',[OrdersController::class,'createOrder']);
    Route::get('/all/order',[OrdersController::class,'allOrder']);


//    slider

    Route::post('/add/slider',[PromotionsController::class,'addSlider']);
    Route::get('/all/slider',[PromotionsController::class,'allSlider']);


    //wish list
    Route::post('/add/wish',[WishController::class,'addWish']);
    Route::get('/all/wish',[WishController::class,'allWish']);

});
