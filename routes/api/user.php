<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\Auth\AuthController;
use App\Http\Controllers\Api\User\User\UserController;
use App\Http\Controllers\Api\User\Order\OrderController;
use App\Http\Controllers\Api\User\Helper\HelperController;
use App\Http\Controllers\Api\User\Message\MessageController;
use App\Http\Controllers\Api\User\Setting\SettingController;
use App\Http\Controllers\Api\User\Accidents\AccidentController;
use App\Http\Controllers\Api\Guest\Helper\GuestHelperController;
use App\Http\Controllers\Api\User\BankTransfer\BankTransferController;
use App\Http\Controllers\Api\User\Notification\NotificationController;
use App\Http\Controllers\Api\User\PartnerRequest\PartnerRequestController;

Route::middleware('current_locale')->group(function () {


// Start Authentication EndPoints ------------------------------------------------------------------------------------------------
    Route::group(['prefix' => 'user'], function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/send_otp', [AuthController::class, 'send_otp']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/verify_forget_password', [AuthController::class, 'verify_forget_password']);
        Route::post('/update_password', [AuthController::class, 'update_password']);
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:user');
        Route::post('/delete_account', [AuthController::class, 'delete_account'])->middleware('auth:user');
    });
// End Authentication EndPoints ----------------------------------------------------------------------------------------------------



});
