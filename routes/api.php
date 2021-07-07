<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\User;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get("/users", [UserController::class, "showAll"]);
Route::post("/login", [UserController::class, "login"])->name('login');
Route::middleware('auth:sanctum')->group( function () {
    Route::get('/product', [ProductController::class, 'index']);
    Route::get("/product/{id}", [ProductController::class, 'show']);
    Route::get('/product/search/{name}', [ProductController::class, 'search']);
    Route::post('/product', [ProductController::class, 'store']);
    Route::put('/product/{id}', [ProductController::class, 'update']);
    Route::delete('/product/{id}', [ProductController::class, 'destroy']);
});
