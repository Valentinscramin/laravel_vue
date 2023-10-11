<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\UserController;
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

//PRODUCTS
Route::get('products/all', [ProductsController::class, 'all'])->middleware('auth:sanctum')->name('products.all');
// Route::post('products-by-categorie', [ProductsController::class, 'getByCategorie'])->middleware('auth:sanctum')->name('products.getCategorie');
Route::post('products/store', [ProductsController::class, 'store'])->middleware('auth:sanctum')->name('products.store');
Route::post('products/{products}/update', [ProductsController::class, 'update'])->middleware('auth:sanctum')->name('products.update');

//CATEGORIES
Route::get('categories/all', [CategoriesController::class, 'all'])->middleware('auth:sanctum')->name('categories.all');
Route::post('categories/store', [CategoriesController::class, 'store'])->middleware('auth:sanctum')->name('categories.store');
Route::post('categories/{categories}/update', [CategoriesController::class, 'update'])->middleware('auth:sanctum')->name('categories.update');

//PROFILES
Route::get('profiles/all', [ProfilesController::class, 'all'])->middleware('auth:sanctum')->name('profiles');

//USERS
Route::get('user/all', [UserController::class, 'all'])->middleware('auth:sanctum')->name('user.all');
Route::post('user/store', [UserController::class, 'store'])->middleware('auth:sanctum')->name('user.store');
Route::post('user/{user}/update', [UserController::class, 'update'])->middleware('auth:sanctum')->name('user.update');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
