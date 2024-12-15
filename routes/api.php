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
//show the first page
Route::get('/', function () {
    return view('user.register-page');
})->name('login');

// register form endpoint
Route::post('/register' , [UserController::class , 'register']);
//avatar-add from
Route::get("/add-avatar-page" , function(){
    return view('user.add-avatar-page');
})->middleware('auth:sanctum');
//add avatar endpoint
Route::post('/user/add-avatar' , [UserController::class , 'addAvatar'])->middleware('auth:sanctum');
Route::get('/login', function () {
    return view('user.login-page');
});
// login endpoint
Route::post('/login' , [UserController::class,'login']);
// show the welcome page
Route::get("/store/post/{user}" , function(){
    return view('post.store-page');
})->middleware('auth:sanctum');
// show the profile of the user
Route::get('users/me' , [UserController::class,'profile'])->middleware('auth:sanctum');
// change password endpoint
Route::post('users/change-password/{user}' , [UserController::class,'changePassword'])->middleware('auth:sanctum');

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












