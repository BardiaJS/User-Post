<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

Route::get('users/me' , [UserController::class,'profile'])->middleware('auth:sanctum');
Route::post('users/change-password' , [UserController::class,'changePassword'])->middleware('auth:sanctum');
Route::post('register' , [UserController::class,'register']);
Route::post('login' , [UserController::class,'login']);
Route::get('posts/index' , [PostController::class,'index']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users' , UserController::class)->only('show' , 'update' , 'index');
    Route::apiResource('posts', PostController::class)->only('show' , 'update' , 'delete');

});










