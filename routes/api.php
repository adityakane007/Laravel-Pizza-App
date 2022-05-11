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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('pizza-api', 'App\Http\Controllers\UserController');

Route::resource('menu-dashboard', 'App\Http\Controllers\MenuDashboardController');

Route::resource('order', 'App\Http\Controllers\OrderDetailsController');

Route::prefix('pizza-api')->name('pizza-api.')->group(function () {
    Route::post('user-login', ['App\Http\Controllers\UserController', 'login']);
});
