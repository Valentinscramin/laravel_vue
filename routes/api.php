<?php

use App\Http\Controllers\ProfileController;
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

Route::get('profiles', [ProfileController::class, 'index'])->middleware('auth:sanctum')->name('profiles');
Route::get('user-all', [UserController::class, 'all'])->middleware('auth:sanctum')->name('user.all');
Route::post('user-store', [UserController::class, 'store'])->middleware('auth:sanctum')->name('user.store');
Route::post('user-update', [UserController::class, 'update'])->middleware('auth:sanctum')->name('user.update');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
