<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;



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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('/login-google', [AuthController::class, 'redirectToProvider']);
Route::get('/auth/google/callback', [AuthController::class, 'handleCallback']);
Route::delete('/delete-account', [AuthController::class, 'deleteAccount'])->middleware('auth');

Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/categories/{id}', [CategoryController::class, 'show']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

Route::get('/categories/{categoryId}/products', [ProductController::class, 'productsByCategory']);

Route::get('categories/{category}/subcategories', [CategoryController::class, 'getSubcategories']);


Route::get('/products/partial-category/{name}', [ProductController::class, 'productsByPartialCategory']);



Route::middleware('auth:sanctum')->get('user', [AuthController::class, 'userProfile']);
