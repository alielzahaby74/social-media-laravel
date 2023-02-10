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
Route::middleware('jwt.auth')->group(function (){
    Route::get('/friends', [\App\Http\Controllers\FriendsController::class, 'get']);
    Route::post('/add/{id}', [\App\Http\Controllers\FriendsController::class, 'add'])->name('friend.add');
    Route::put('/accept', [\App\Http\Controllers\FriendsController::class, 'accept'])->name('friend.accept');
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [\App\Http\Controllers\AuthController::class,'login']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class,'logout']);
    Route::post('refresh', [\App\Http\Controllers\AuthController::class,'refresh']);
    Route::post('me', [\App\Http\Controllers\AuthController::class,'me']);

});

