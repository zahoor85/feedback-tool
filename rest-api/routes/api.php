<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorCollection;

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

Route::post("login", [AuthController::class, "login"]);
Route::post("register", [AuthController::class, "register"]);

Route::middleware('auth:sanctum')->group(function () {

    // Route::apiResource('categories', CategoryController::class)->only("index");
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/users', [UserController::class, 'search'])->name('users.search');
   // Route::get('/users', UserController::class,"index")->name('users.index');



    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('feedbacks', FeedbackController::class)->only("index", "show", "store");
    Route::apiResource('comments', CommentController::class)->only('store');
});
