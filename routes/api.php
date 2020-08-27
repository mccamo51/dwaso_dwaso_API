<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Login Route
Route::post("/login", "LoginController@Login");

//Registration Route
Route::post("/userregister", "AddUser@Register");
//Fetch all Products
Route::get("/products", "ProductController@product");

Route::post("/image", "FileController@saveImage");

Route::get("/getImg", "FileController@viewImage");

Route::post("/addToCart", "CartController@addCart");

Route::post("/updateCart", "CartController@updateCart");

Route::post("/cart", "ItemCartController@getcart");

Route::post("/address", "AddressController@AddAddress");

Route::post("/getAddress", "AddressController@getAddress");

Route::post("/order", "OrderController@order");
