<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

/*
 * for simplicity purposes I'll make it following system instead of friends because i wanna share the project ASAP
 * I'll comment it and maybe I'll comeback for it one day =)
 * */
//Route::middleware('jwt.auth')->group(function (){
//    Route::get('/friends', [\App\Http\Controllers\FriendsController::class, 'get']);
//    Route::post('/add/{id}', [\App\Http\Controllers\FriendsController::class, 'add'])->name('friend.add');
//    Route::put('/accept', [\App\Http\Controllers\FriendsController::class, 'accept'])->name('friend.accept');
//});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [\App\Http\Controllers\AuthController::class,'login']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class,'logout']);
    Route::post('refresh', [\App\Http\Controllers\AuthController::class,'refresh']);
    Route::post('me', [\App\Http\Controllers\AuthController::class,'me']);

});


Route::middleware('jwt.auth')->prefix('posts')->group(function (){
    Route::put('add', [\App\Http\Controllers\PostController::class, 'add']);
    Route::delete('delete/{id}', [\App\Http\Controllers\PostController::class, 'delete']);
});

Route::middleware('jwt.auth')->prefix('likes')->group(function (){
    Route::get('get/{post_id}', [\App\Http\Controllers\LikeController::class, 'get']);
    Route::put('add', [\App\Http\Controllers\LikeController::class, 'add']);
    Route::delete('delete/{id}', [\App\Http\Controllers\LikeController::class, 'delete']);
});
