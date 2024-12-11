<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\User;

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
// show the profile of the user
Route::get('users/me' , [UserController::class,'profile'])->middleware('auth:sanctum');
// change password endpoint
Route::post('users/change-password' , [UserController::class,'changePassword'])->middleware('auth:sanctum');
// register endpoint
Route::post('register' , [UserController::class , 'register']);
// login endpoint
Route::post('login' , [UserController::class,'login']);

//add avatar endpoint
Route::post('users/add-avatar' , [UserController::class , 'addAvatar'])->middleware('auth:sanctum');


Route::get('posts/index' , [PostController::class,'index']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users' , UserController::class)->only('show' , 'update' , 'index');
    Route::apiResource('posts', PostController::class);

});










