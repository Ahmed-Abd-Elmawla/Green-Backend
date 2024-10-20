<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\Auth\AuthController;
use App\Http\Controllers\Api\User\Home\HomeController;
use App\Http\Controllers\Api\User\Clients\ClientsController;
use App\Http\Controllers\Api\User\Expenses\ExpensesController;
use App\Http\Controllers\Api\User\Invoices\InvoicesController;
use App\Http\Controllers\Api\User\Categories\CategoriesController;
use App\Http\Controllers\Api\User\Collections\CollectionsController;
use App\Http\Controllers\Api\User\AccountStatement\AccountStatementController;

Route::middleware('current_locale')->group(function () {


    // Authentication EndPoints ---------------------------------------------------------------------------------------------
    Route::group(['prefix' => 'user'], function () {
        Route::post('/send_otp', [AuthController::class, 'send_otp']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/verify_forget_password', [AuthController::class, 'verify_forget_password']);
        Route::post('/update_password', [AuthController::class, 'update_password']);
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:user');
        Route::get('/token', [AuthController::class, 'isTokenExpired']);
    });
    // Clients EndPoints ----------------------------------------------------------------------------------------------------
    Route::group(['prefix' => 'clients', 'middleware' => 'auth:user'], function () {
        Route::get('/', [ClientsController::class, 'index']);
        Route::get('/list', [ClientsController::class, 'miniIndex']);
        Route::get('/{client}', [ClientsController::class, 'show']);
        Route::post('/', [ClientsController::class, 'store']);
    });
    // Categories EndPoints --------------------------------------------------------------------------------------------------
    Route::group(['prefix' => 'categories', 'middleware' => 'auth:user'], function () {
        Route::get('/', [CategoriesController::class, 'index']);
        Route::get('/{id}', [CategoriesController::class, 'show']);
    });
    // Invoices EndPoints ----------------------------------------------------------------------------------------------------
    Route::group(['prefix' => 'invoices', 'middleware' => 'auth:user'], function () {
        Route::get('/', [InvoicesController::class, 'index']);
        Route::post('/', [InvoicesController::class, 'store']);
        Route::get('/{invoice}', [InvoicesController::class, 'show']);
    });
    // Collections EndPoints -------------------------------------------------------------------------------------------------
    Route::group(['prefix' => 'collections', 'middleware' => 'auth:user'], function () {
        Route::get('/', [CollectionsController::class, 'index']);
        Route::post('/', [CollectionsController::class, 'store']);
    });
    // Expenses EndPoints ----------------------------------------------------------------------------------------------------
    Route::group(['prefix' => 'expenses', 'middleware' => 'auth:user'], function () {
        Route::get('/', [ExpensesController::class, 'index']);
        Route::post('/', [ExpensesController::class, 'store']);
    });

    // AccountStatement EndPoints --------------------------------------------------------------------------------------------
    Route::group(['prefix' => 'statement', 'middleware' => 'auth:user'], function () {
        Route::get('/{client}', [AccountStatementController::class, 'index']);
        // Route::post('/', [AccountStatement::class, 'store']);
    });

    // Home EndPoints --------------------------------------------------------------------------------------------------------
    Route::group(['prefix' => 'home', 'middleware' => 'auth:user'], function () {
        Route::get('/clients', [HomeController::class, 'clients']);
        Route::get('/products', [HomeController::class, 'products']);
    });
});
