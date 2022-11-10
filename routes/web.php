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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/dasboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

//Google
Route::get('/login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);


//Facebook
// Route::get('/login/facebook', [App\Http\Controllers\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
// Route::get('/login/facebook/callback', [App\Http\Controllers\LoginController::class, 'handleGoogleCallback']);


// //Instagram
// Route::get('/login/instagram', [App\Http\Controllers\LoginController::class, 'redirectToInstagram'])->name('login.instagram');
// Route::get('/login/instagram/callback', [App\Http\Controllers\LoginController::class, 'handleInstagramCallback']);
Route::group(['middleware'=>'auth'], function(){
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/new', [App\Http\Controllers\Admin\NewsController::class, 'News']);
Route::get('/savenews', [App\Http\Controllers\Admin\NewsController::class, 'SaveNews']);
Route::get('/news/edit/{id}', [App\Http\Controllers\Admin\NewsController::class, 'NewsEdit']);
Route::post('/news/update', [App\Http\Controllers\Admin\NewsController::class, 'NewsUpdate'])->name('update.news');
Route::get('/newsactive/{user_id}/{value}', [App\Http\Controllers\Admin\NewsController::class, 'newsStatus']);
Route::get('/addnews', [App\Http\Controllers\Admin\NewsController::class, 'AddNews']);
Route::post('/Submit News', [App\Http\Controllers\Admin\NewsController::class, 'SubmitNews'])->name('submit.news');


Route::get('/categorynews/{cat}', [App\Http\Controllers\Admin\NewsController::class, 'newsCategory']);



Route::get('/user', [App\Http\Controllers\Admin\UserController::class, 'allUser'])->name('Users');
Route::get('/userstatus/{user_id}/{value}', [App\Http\Controllers\Admin\UserController::class, 'userStatus']);

Route::get('/categories', [App\Http\Controllers\Admin\CategoryController::class, 'allCategory'])->name('show.categories');
Route::get('/addcategories', [App\Http\Controllers\Admin\CategoryController::class, 'addCategory'])->name('add.categories');
Route::post('/submitcategories', [App\Http\Controllers\Admin\CategoryController::class, 'submitCategory'])->name('submit.categories');
Route::get('/editcategories/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'editCategory']);
Route::post('/updatecategories', [App\Http\Controllers\Admin\CategoryController::class, 'updateCategory'])->name('update.categories');

Route::view('/store', 'media');
Route::post('/image', [App\Http\Controllers\Admin\NewsController::class, 'imageStore'])->name('submit.image');


});


