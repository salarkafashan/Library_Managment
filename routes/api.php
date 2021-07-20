<?php

use App\Http\Controllers\Api\V1\AgeController;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\BookController;
use App\Http\Controllers\Api\V1\CheckoutController;
use App\Models\User;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/books',[BookController::class,'index']);
Route::get('v1/register', function () {
    return User::findOrFail(10);
});


Route::prefix('v1')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('forgotPassword', [AuthController::class, 'forgotPassword']);
});

Route::middleware('auth:api')->prefix('v1')->group(function () {
    Route::apiResource('books', BookController::class);
    Route::apiResource('ages', AgeController::class);

    Route::post('checkout/{book}', [CheckoutController::class, 'store']);
});
