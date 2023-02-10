<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/profile', [App\Http\Controllers\HomeController::class, 'edit'])->name('profile.edit');
Route::post('/profile/{url?}', [App\Http\Controllers\HomeController::class, 'update'])->name('profile.update');

Route::middleware('auth')->prefix('user')->group(function () {
    Route::post('post', [\App\Http\Controllers\PostController::class, 'post'])->name('user.post');
    Route::get('delete/{id}', [\App\Http\Controllers\PostController::class, 'delete'])->name('user.delete');
});

Route::middleware('auth')->prefix('friend')->group(function () {
    Route::delete('/reject', [\App\Http\Controllers\FriendsController::class, 'reject'])->name('friend.reject');
});
