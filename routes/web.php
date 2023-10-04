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
    return view('site.home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth:sanctum')->name('home');
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->middleware('auth:sanctum')->name('admin.users');
Route::get('/products', [App\Http\Controllers\ProductsController::class, 'index'])->middleware('auth:sanctum')->name('admin.products');
Route::get('/categories', [App\Http\Controllers\CategoriesController::class, 'index'])->middleware('auth:sanctum')->name('admin.categories');
