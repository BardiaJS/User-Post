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


    // user related routes
// show the profile of the user
Route::get('users/me' , [UserController::class,'profile'])->middleware('auth:sanctum');
// change password endpoint
Route::post('users/change-password/{user}' , [UserController::class,'changePassword'])->middleware('auth:sanctum');
// register endpoint
Route::post('register' , [UserController::class , 'register']);
// login endpoint
Route::post('login' , [UserController::class,'login']);
//add avatar endpoint
Route::post('users/add-avatar/{user}' , [UserController::class , 'addAvatar'])->middleware('auth:sanctum');
// change avatar
Route::post('users/change-avatar/{user}' , [UserController::class , 'updateAvatar'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users' , UserController::class)->only('show' , 'update' , 'index');
});



    // post related routes
// show the all of the post : if it is admin => see all of the post / if it is user => see his/her posts
Route::get('posts/index' , [PostController::class,'index']); //done
// creating the post for user
Route::post('posts' , [PostController::class , 'store'])->middleware('auth:sanctum'); //done!
// add thumbnail for user posts
Route::post('posts/add-thumbnail/{post}' , [PostController::class , 'addThumbnail'])->middleware('auth:sanctum'); //done!
// change thumbnail for user posts
Route::post('posts/change-thumbnail/{post}' , [PostController::class , 'changeThumbnail'])->middleware('auth:sanctum'); //done!
// update the post details
Route::put('posts/{post}' , [PostController::class , 'update'])->middleware('auth:sanctum'); // done!
// show specific post
Route::get('/posts/{post}' , [PostController::class , 'show'])->middleware('auth:sanctum'); // done
// delet the post
Route::delete('posts/{post}' , [PostController::class , 'destroy']) ->middleware('auth:sanctum'); //done!












