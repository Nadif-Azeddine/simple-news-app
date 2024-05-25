<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// auth routes
Route::prefix('v1')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

// protected routes
Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function () {

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // routes for news
    Route::get('news', [NewsController::class, 'index'])->name('news.index');
    Route::post('news', [NewsController::class,'store'])->name('news.store');
    Route::get('news/{news}', [NewsController::class,'show'])->name('news.show');
    Route::put('news/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');

    // routes for categories
    Route::get('categories', [CategoryController::class, 'findCategoryWithArticlesByName'])->name('categories.search');
    Route::get('categories/{categoryId}', [CategoryController::class, 'findCategoryWithArticles'])->name('categories.find');
});
