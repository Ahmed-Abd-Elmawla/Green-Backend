<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\User\UserController;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\Admins\AdminsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Clients\ClientsController;
use App\Http\Controllers\Dashboard\Expenses\ExpensesController;
use App\Http\Controllers\Dashboard\Finances\FinancesController;
use App\Http\Controllers\Dashboard\Invoices\InvoicesController;
use App\Http\Controllers\Dashboard\Products\ProductsController;
use App\Http\Controllers\Dashboard\Suppliers\SuppliersController;
use App\Http\Controllers\Dashboard\Categories\CategoriesController;
use App\Http\Controllers\Dashboard\Collections\CollectionsController;
use App\Http\Controllers\Dashboard\Notifications\NotificationController;
use App\Http\Controllers\Dashboard\AccountStatement\AccountStatementController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth._login');
    // return view('layouts.HomePage');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        // Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
        // Route::post('login', [AuthController::class, 'login'])->name(name: '_login');
        // Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name(name: '_login');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');




        // Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
            Route::group(['prefix' => 'dashboard'], function () {
            Route::get('/', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
            Route::get('/notifications/{id}', [NotificationController::class, 'read'])->name('markAsRead');
            Route::group(['prefix' => 'representatives'], function () {
                Route::get('/', [UserController::class, 'index'])->name('representatives.index');;
                Route::post('/store', [UserController::class, 'store'])->name('representatives.store');
                Route::post('/update/{user}', [UserController::class, 'update'])->name('representatives.update');
                Route::delete('/{user}', [UserController::class, 'destroy'])->name('representatives.delete');
            });

            // Admins routs --------------------------------------------------------------------------------------------------------
            Route::group(['prefix' => 'admins'], function () {
                Route::get('/', [AdminsController::class, 'index'])->name('admins.index');
                Route::post('/store', [AdminsController::class, 'store'])->name('admins.store');
                Route::post('/update/{admin}', [AdminsController::class, 'update'])->name('admins.updateInfo');
                Route::delete('/{admin}', [AdminsController::class, 'destroy'])->name('admins.delete');
            });

            // Clients routs ---------------------------------------------------------------------------------------------------------
            Route::group(['prefix' => 'clients'], function () {
                Route::get('/', [ClientsController::class, 'index'])->name('clients.index');
                // Route::post('/store', [ClientsController::class, 'store'])->name('clients.store');
                Route::post('/update/{client}', [ClientsController::class, 'update'])->name('clients.update');
                Route::delete('/{client}', [ClientsController::class, 'destroy'])->name('clients.delete');
            });

            // Suppliers routs --------------------------------------------------------------------------------------------------------
            Route::group(['prefix' => 'suppliers'], function () {
                Route::get('/', [SuppliersController::class, 'index'])->name('suppliers.index');
                Route::post('/store', [SuppliersController::class, 'store'])->name('suppliers.store');
                Route::post('/update/{supplier}', [SuppliersController::class, 'update'])->name('suppliers.update');
                Route::delete('/{supplier}', [SuppliersController::class, 'destroy'])->name('suppliers.delete');
            });

            // Categories routs ---------------------------------------------------------------------------------------------------------
            Route::group(['prefix' => 'categories'], function () {
                Route::get('/', [CategoriesController::class, 'index'])->name('categories.index');
                Route::post('/store', [CategoriesController::class, 'store'])->name('categories.store');
                Route::post('/update/{category}', [CategoriesController::class, 'update'])->name('categories.update');
                Route::delete('/{category}', [CategoriesController::class, 'destroy'])->name('categories.delete');
            });

            // Products routs ---------------------------------------------------------------------------------------------------------
            Route::group(['prefix' => 'products'], function () {
                Route::get('/', [ProductsController::class, 'index'])->name('products.index');
                Route::post('/store', [ProductsController::class, 'store'])->name('products.store');
                Route::post('/update/{product}', [ProductsController::class, 'update'])->name('products.update');
                Route::delete('/{product}', [ProductsController::class, 'destroy'])->name('products.delete');
            });

            // Invoices routs ---------------------------------------------------------------------------------------------------------
            Route::group(['prefix' => 'invoices'], function () {
                Route::get('/', [InvoicesController::class, 'index'])->name('invoices.index');
                Route::delete('/{invoice}', [InvoicesController::class, 'destroy'])->name('invoices.delete');
            });

            // Collections routs ---------------------------------------------------------------------------------------------------------
            Route::group(['prefix' => 'collections'], function () {
                Route::get('/', [CollectionsController::class, 'index'])->name('collections.index');
                Route::delete('/{collection}', [CollectionsController::class, 'destroy'])->name('collections.delete');
            });

            // Expenses routs ---------------------------------------------------------------------------------------------------------
            Route::group(['prefix' => 'expenses'], function () {
                Route::get('/', [ExpensesController::class, 'index'])->name('expenses.index');
                Route::delete('/{expense}', [ExpensesController::class, 'destroy'])->name('expenses.delete');
            });

            // AccountStatement routs ---------------------------------------------------------------------------------------------------------
            Route::group(['prefix' => 'statement'], function () {
                Route::get('/', [AccountStatementController::class, 'index'])->name('statement.index');
                Route::post('/{client}', [AccountStatementController::class, 'show'])->name('statement.show');
            });

            // Finances routs ---------------------------------------------------------------------------------------------------------
            Route::group(['prefix' => 'finances'], function () {
                Route::get('/', [FinancesController::class, 'index'])->name('finances.index');
                Route::post('/', [FinancesController::class, 'show'])->name('finances.show');
            });
        });
    }
);
// Auth::routes();
