<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
//Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/search/{term}/{auth_user}', [App\Http\Controllers\ItemController::class, 'search']);
    Route::post('/confirm', [App\Http\Controllers\ItemController::class, 'confirm']);
//});
