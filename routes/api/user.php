<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\Auth\AuthController;
use App\Http\Controllers\Api\User\Clients\ClientsController;
use App\Http\Controllers\Api\User\Categories\CategoriesController;

Route::middleware('current_locale')->group(function () {


    // Authentication EndPoints ----------------------------------------------------------------------------------------------
    Route::group(['prefix' => 'user'], function () {
        Route::post('/send_otp', [AuthController::class, 'send_otp']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/verify_forget_password', [AuthController::class, 'verify_forget_password']);
        Route::post('/update_password', [AuthController::class, 'update_password']);
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:user');
        // Route::post('/delete_account', [AuthController::class, 'delete_account'])->middleware('auth:user');
    });
    // Clients EndPoints ----------------------------------------------------------------------------------------------------
    Route::group(['prefix' => 'clients', 'middleware' => 'auth:user'], function () {
        Route::get('/', [ClientsController::class, 'index']);
        Route::get('/{client}', [ClientsController::class, 'show']);
        Route::post('/', [ClientsController::class, 'store']);
    });
    // Categories EndPoints ----------------------------------------------------------------------------------------------------
    Route::group(['prefix' => 'categories', 'middleware' => 'auth:user'], function () {
        Route::get('/', [CategoriesController::class, 'index']);
        Route::get('/{id}', [CategoriesController::class, 'show']);
    });
});
