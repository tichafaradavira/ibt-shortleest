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
Route::get('/users/realtor/profile', [UserController::class, 'profile'])->name('modules.users.realtor.profile')->middleware('auth:api');
Route::post('/users/realtor/edit/profile', [UserController::class, 'editProfile'])->name('modules.users.realtor.edit.profile')->middleware('auth:api');

