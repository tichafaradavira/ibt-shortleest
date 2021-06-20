<?php

use Illuminate\Support\Facades\Route;
use Modules\Properties\Http\Controllers\PropertiesController;
use Modules\Properties\Http\Controllers\ClientsController;


Route::middleware(['auth:api'])->group(function () {
    Route::get('/properties', [PropertiesController::class, 'browse'])->name('modules.property.browse');
    Route::post('/properties/add', [PropertiesController::class, 'add'])->name('modules.property.add');
    Route::post('/properties/{entity}/edit', [PropertiesController::class, 'edit'])->name('modules.property.edit');
    Route::post('/properties/{entity}/delete', [PropertiesController::class, 'delete'])->name('modules.property.delete');
    Route::post('/properties/{entity}/restore', [PropertiesController::class, 'restore'])->name('modules.property.restore');
    Route::get('/properties/{entity}', [PropertiesController::class, 'read'])->name('modules.property.read');


    Route::get('/clients', [ClientsController::class, 'browse'])->name('modules.client.browse');
    Route::get('/clients/list', [ClientsController::class, 'labelList'])->name('modules.client.list');
    Route::post('/clients/add', [ClientsController::class, 'add'])->name('modules.client.add');
    Route::post('/clients/{entity}/edit', [ClientsController::class, 'edit'])->name('modules.client.edit');
    Route::post('/clients/{entity}/delete', [ClientsController::class, 'delete'])->name('modules.client.delete');
    Route::post('/clients/{entity}/restore', [ClientsController::class, 'restore'])->name('modules.client.restore');
    Route::get('/clients/{entity}', [ClientsController::class, 'read'])->name('modules.client.read');

});
