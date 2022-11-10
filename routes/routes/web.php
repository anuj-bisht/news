<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();


// Route::get('/dasboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

//Google

Route::get('/login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);
Route::group(['middleware'=>'auth:web'],function(){
    Route::get('/login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/new', [App\Http\Controllers\Admin\NewsController::class, 'News']);
Route::get('/savenews', [App\Http\Controllers\Admin\NewsController::class, 'SaveNews']);


Route::get('/user', [App\Http\Controllers\Admin\UserController::class, 'allUser'])->name('Users');
Route::get('/userstatus/{user_id}/{value}', [App\Http\Controllers\Admin\UserController::class, 'userStatus']);
});



//Facebook
// Route::get('/login/facebook', [App\Http\Controllers\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
// Route::get('/login/facebook/callback', [App\Http\Controllers\LoginController::class, 'handleGoogleCallback']);


// //Instagram
// Route::get('/login/instagram', [App\Http\Controllers\LoginController::class, 'redirectToInstagram'])->name('login.instagram');
// Route::get('/login/instagram/callback', [App\Http\Controllers\LoginController::class, 'handleInstagramCallback']);




