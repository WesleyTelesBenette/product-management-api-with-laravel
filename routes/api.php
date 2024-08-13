<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware('apiJwt')->group(function ()
{
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::resource('user', UserController::class)->except('edit', 'create');
    Route::resource('category', CategoryController::class)->except('edit', 'create');
    Route::resource('product', ProductController::class)->except('edit', 'create');
});
