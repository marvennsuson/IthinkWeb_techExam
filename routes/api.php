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
Route::group(['prefix' => "apiv1",'as' => 'apiv1.','namespace' => "Api"] , function () {
    Route::group(['prefix' => "products",'as' => 'products.'] , function () {
        Route::controller(ProductController::class)->group(function () {
            Route::post('/index', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{id}', 'show');
            Route::delete('/destroy/{id}', 'destroy');
        });
    });
});