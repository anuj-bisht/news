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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

  Route::post('sociallogin', [App\Http\Controllers\Mobile\UserController::class, 'UserLogin']);
    Route::post('socialregister', [App\Http\Controllers\Mobile\UserController::class, 'UserRegister']);
    Route::post('apilogout', [App\Http\Controllers\Mobile\UserController::class, 'apilogout']);
    Route::post('detail', [App\Http\Controllers\Mobile\UserController::class, 'UserInfo']);



Route::get('getAllCategory', [App\Http\Controllers\Mobile\CategoryController::class, 'getAllCategories']);
Route::get('getAllCountry', [App\Http\Controllers\Mobile\CountryController::class, 'getAllCountries']);

Route::post('userPreferences', [App\Http\Controllers\Mobile\PreferenceController::class, 'UserPreferences']);
Route::post('preferencesData', [App\Http\Controllers\Mobile\PreferenceController::class, 'PreferencesData']);

Route::post('search', [App\Http\Controllers\Admin\SearchController::class, 'searchNews']);
