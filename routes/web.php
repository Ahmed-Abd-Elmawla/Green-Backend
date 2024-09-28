<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\User\UserController;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\Admins\AdminsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
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




        Route::group(['prefix' => 'dashboard','middleware' => 'auth'], function () {
            Route::get('/', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
            Route::group(['prefix' => 'representatives'], function () {
                Route::get('/', [UserController::class, 'index'])->name('representatives.index');;
                Route::post('/store', [UserController::class, 'store'])->name('representatives.store');
                Route::post('/update/{user}', [UserController::class, 'update'])->name('representatives.updateInfo');
                Route::delete('/{user}', [UserController::class, 'destroy'])->name('representatives.delete');
            });

            // Admins routs --------------------------------------------------------------------------------------------------------
            Route::group(['prefix' => 'admins'], function () {
                Route::get('/', [AdminsController::class, 'index'])->name('admins.index');
                Route::post('/store', [AdminsController::class, 'store'])->name('admins.store');
                Route::post('/update/{admin}', [AdminsController::class, 'update'])->name('admins.updateInfo');
                Route::delete('/{admin}', [AdminsController::class, 'destroy'])->name('admins.delete');
            });
        });
    }
);
// Auth::routes();
