<?php

use App\Http\Controllers\Api\V1\AgeController;
use App\Http\Controllers\Api\V1\BookController;
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

Route::prefix('v1')->group(function(){
    Route::apiResource('books', BookController::class);
    Route::apiResource('ages', AgeController::class);
    Route::post('test', [BookController::class,'test']);
}); 
