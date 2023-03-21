<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('auth',[AuthController::class,'register']);

Route::post('login',[AuthController::class,'login']);

Route::get('authuser/{id}',[AuthController::class,'getuserdata']);

Route::get('alluser',[AuthController::class,'getalldata']);

Route::get('role',[RoleController::class,'getallrole']);

Route::put('update/{id}',[AuthController::class,'updateuser']);