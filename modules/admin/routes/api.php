<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\UsersController;

Route::post('/admin/users/signin', [UsersController::class, 'signIn'])->name('modules.admin.users.signin');

Route::middleware(['auth:api','admin'])->group(function () {
    Route::get('/admin/users', [UsersController::class, 'browse'])->name('modules.admin.users.browse');
    Route::post('/admin/users/{entity}/suspend', [UsersController::class, 'suspend'])->name('modules.admin.users.delete');
    Route::post('/admin/users/{entity}/activate', [UsersController::class, 'activate'])->name('modules.admin.users.delete');
    Route::get('/admin/users/{entity}', [UsersController::class, 'read'])->name('modules.admin.users.read');
});
