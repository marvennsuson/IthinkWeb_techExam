<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('products')->group(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::post('/index.{format}', 'index');
        Route::post('/store.{format}', 'store');
        Route::post('/show.{format}', 'show');
        Route::post('/destroy.{format}', 'destroy');
    });
});