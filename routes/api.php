<?php

use App\Constants\Auth\PermissionConstant;
use App\Http\Controllers\auth\UserAuthController;
use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\Food\FoodController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Restaurant\RestaurantController;
use App\Http\Controllers\Table\TableController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\User\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

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

Route::get('/test', function() {
    return response(['hello' => 'world'], 200);
});

Route::middleware(['cors', 'json.response'])->group(function () {
    Route::get('/unauthenticated', function () {
        return response(['message' => 'Unauthenticated'], 401);
    })->name('unauthenticated');

    Route::post('/login', [UserAuthController::class, 'login']);
    Route::post('/signup', [UserController::class, 'signup']);
});

Route::middleware(['cors', 'json.response', 'auth:api'])->group(function () {
    Route::delete('/logout', [UserAuthController::class, 'logout']);
    Route::get('/me', [UserAuthController::class, 'me']);

    Route::group(['prefix' => '/event'], function () {
        Route::get('/', [EventController::class, 'index']);
        Route::get('/{id}', [EventController::class, 'getOneById']);
        Route::post('/', [EventController::class, 'create']);
        Route::put('/{id}', [EventController::class, 'update']);
        Route::delete('/{id}', [EventController::class, 'delete']);

        Route::middleware(['permission:' . PermissionConstant::UPDATE_RESTAURANT . '|' . PermissionConstant::IS_SUPER_ADMIN, 'is_the_owner'])->put('/update/{restaurant_id}', [RestaurantController::class, 'updateById']);

        // RESTAURANT TABLE REQUEST
        Route::group(['prefix' => '/{restaurant_id}/table'], function () {
            Route::middleware(['permission:' . PermissionConstant::GET_ALL_TABLE_BY_RESTAURANT_ID, 'is_the_owner'])->get('/', [TableController::class, 'getAllByRestaurantID']);
        });
    });
});