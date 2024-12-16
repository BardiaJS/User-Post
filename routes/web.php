<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//route to get the register form
Route::get('/', function () {
    return view('user.register-page');
});
// route for pass the information for register
Route::post('/register' , [UserController::class , 'register']);

//route for get the login form
Route::get('/login' , function(){
    return view('user.login-page');
})->name('login');
// route for pass the information for login
Route::post('/login' , [UserController::class , 'login']);

// route for go to homepage
Route::get('/welcome-page' , function(){
    return view('user.welcome-page');
})->middleware('web');

//route for signing out the user
Route::post('/signout' , [UserController::class , 'signout'])->middleware('auth');

// route for get the store post form
Route::get('/store-post-page/{user}' , function(){
    return view('post.store-page');
});
//route for store the post
Route::post('/store/post/{user}' , [PostController::class , 'store'])->middleware('auth');

// route for get the add thumbnail form
Route::get('/add-thumbnail-post/{post}' , function(){
    return view('post.store-page');
});
// route for set the thumbnail
Route::post('/add-thumbnail/post/{post}' , [PostController::class , 'addThumbnail']);

//route for get the change password form
Route::get('/change-password-page' , function(){
    return view ('user.change-password-page');
});
//route for change the password
Route::post('/change-password/{user}' , [UserController::class,'changePassword'])->middleware('auth');

// route for get the all users
