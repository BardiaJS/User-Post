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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


//     // user related routes
// //show the first page
// Route::get('/', function () {
//     return view('user.register-page');
// })->name('login');

// // register form endpoint
// Route::post('/register' , [UserController::class , 'register']);
// //avatar-add from
// Route::get("/add-avatar-page" , function(){
//     return view('user.add-avatar-page');
// })->middleware('auth:sanctum');
// //add avatar endpoint
// Route::post('/user/add-avatar' , [UserController::class , 'addAvatar'])->middleware('auth:sanctum');
// Route::get('/login', function () {
//     return view('user.login-page');
// });
// // login endpoint
// Route::post('/login' , [UserController::class,'login']);
// // show the welcome page

// // show the profile of the user
// Route::get('users/me' , [UserController::class,'profile'])->middleware('auth');
// // change password endpoint
// Route::post('users/change-password/{user}' , [UserController::class,'changePassword'])->middleware('auth');

// // change avatar
// Route::post('users/change-avatar/{user}' , [UserController::class , 'updateAvatar'])->middleware('auth');
// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('users' , UserController::class)->only('show' , 'update' , 'index');
// });

// // sign out user
// Route::post('/signout', [UserController::class,'signout'])->middleware('auth');



//     // post related routes
// //store post form
// Route::get("/store/post" , function(){
//     return view('post.store-page');
// })->middleware('auth');
// // show the all of the post : if it is admin => see all of the post / if it is user => see his/her posts
// Route::get('posts/index' , [PostController::class,'index']); //done
// // creating the post for user
// Route::post('posts' , [PostController::class , 'store'])->middleware('auth'); //done!
// // add thumbnail for user posts
// Route::post('posts/add-thumbnail/{post}' , [PostController::class , 'addThumbnail'])->middleware('auth'); //done!
// // change thumbnail for user posts
// Route::post('posts/change-thumbnail/{post}' , [PostController::class , 'changeThumbnail'])->middleware('auth'); //done!
// // update the post details
// Route::put('posts/{post}' , [PostController::class , 'update'])->middleware('auth'); // done!
// // show specific post
// Route::get('/posts/{post}' , [PostController::class , 'show'])->middleware('auth'); // done
// // delet the post
// Route::delete('posts/{post}' , [PostController::class , 'destroy']) ->middleware('auth'); //done!












