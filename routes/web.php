<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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


Route::get('/post/index', [App\Http\Controllers\PostController::class, 'index']);
Route::get('/post/{id}/edit', [App\Http\Controllers\PostController::class, 'edit']);
Route::post('/posts/update', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
Route::get('/post/delete/{id}', [App\Http\Controllers\PostController::class, 'destroy']);

Route::get('/api/search', [App\Http\Controllers\PostController::class, 'searchProduct']);
Route::post('/api/search-result', [App\Http\Controllers\PostController::class, 'search'])->name('search');
Route::get('/post/{product}', [App\Http\Controllers\PostController::class, 'show'])->name('shop.show');
Route::get('/create', [App\Http\Controllers\PostController::class, 'create']);
Route::post('/create', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');

Route::get('/single', [App\Http\Controllers\PostController::class, 'single'])->name('search_code');
Route::post('/single', [App\Http\Controllers\PostController::class, 'singlebreed'])->name('search_code');



