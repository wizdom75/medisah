<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;
use App\Models\Subscription;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::domain('{merchant}.'.explode('//', env('APP_URL'))[1])->group(function () {
//     Route::get('user/{id}', function ($account, $id) {
//         //
//     });
// });

Route::domain('dashboard.'.explode('//', env('APP_URL'))[1])->group(function () {

    Route::group(['middleware' => 'auth'], function() {
        Route::resources([
            'categories' => App\Http\Controllers\CategoryController::class,
            'products' => App\Http\Controllers\ProductController::class,
            'pos' => App\Http\Controllers\PosController::class,
            'suppliers' => App\Http\Controllers\SupplierController::class,
            'sales' => App\Http\Controllers\SaleController::class,
            'users' => App\Http\Controllers\UserController::class,
            'profile' => App\Http\Controllers\ProfileController::class,
            'teams' => App\Http\Controllers\TeamController::class,
            'items' => App\Http\Controllers\ItemController::class,
            'merchants' => App\Http\Controllers\MerchantController::class,
        ]);
        Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
        Route::post('/items/bulk-store', [App\Http\Controllers\ItemController::class, 'bulkStore'])->name('bulk-store');
        Route::post('/profile/upload-avatar', [App\Http\Controllers\ProfileController::class, 'uploadAvatar'])->name('upload-avatar');
    });

});



Route::get('/', function () {
    return view('soon');
});

Route::post('/subscribe', [SubscriptionController::class, 'store']);

//Auth::routes();
Auth::routes(['register' => false]);
Auth::routes();

