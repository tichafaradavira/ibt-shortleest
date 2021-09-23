<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UserController;

/**
 * realtor signup
 */
Route::post('/users/signup', [UserController::class, 'signup'])->name('modules.users.signup');
Route::post('/users/signin', [UserController::class, 'signIn'])->name('modules.users.signin');
Route::post('/users/verify/email', [UserController::class, 'verifyEmail'])->name('modules.users.verify-email');
Route::post('/users/forgotpassword', [UserController::class, 'forgotPassword'])->name('modules.users.forgot.password');
Route::post('/users/password/reset', [UserController::class, 'resetPassword'])->name('modules.users.password.reset');
Route::post('/users/logout', [UserController::class, 'logout'])->name('modules.users.logout')->middleware('auth:api');



Route::middleware(['auth:api'])->group(function () {
    Route::get('/users/realtor/profile', [UserController::class, 'profile'])->name('modules.users.realtor.profile')->middleware('auth:api');
    Route::post('/users/realtor/edit/profile', [UserController::class, 'editProfile'])->name('modules.users.realtor.edit.profile')->middleware('auth:api');
    Route::post('/users/realtor/deactivate', [UserController::class, 'deactivate'])->name('modules.users.realtor.deactivate.profile')->middleware('auth:api');
    Route::get('/users/setup-intent', [UserController::class, 'getSetupIntent'])->name('modules.users.realtor.setup-intent')->middleware('auth:api');
    Route::post('/users/payments', [UserController::class, 'postPaymentMethods']);
    Route::get('/users/payment-methods',  [UserController::class, 'getPaymentMethods']);
    Route::post('/users/change-default-payment',  [UserController::class, 'changeDefault']);
    Route::post('/users/remove-card',  [UserController::class, 'removeCard']);
});
