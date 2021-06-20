<?php

use Illuminate\Support\Facades\Route;
use Modules\Applications\Http\Controllers\VacanciesController;
use Modules\Applications\Http\Controllers\ApplicationsController;

Route::post('/apply/{realtor}/{token}', [\Modules\Applications\Http\Controllers\ApplyController::class, 'apply'])->name('modules.client.apply');
Route::get('/apply/{realtor}/{token}', [\Modules\Applications\Http\Controllers\ApplyController::class, 'getVacancy'])->name('modules.client.get-vacancy');


Route::middleware(['auth:api'])->group(function () {

    Route::get('/vacancies', [VacanciesController::class, 'browse'])->name('modules.client.browse');
    Route::post('/vacancies/add', [VacanciesController::class, 'add'])->name('modules.client.add');
    Route::post('/vacancies/{entity}/edit', [VacanciesController::class, 'edit'])->name('modules.client.edit');
    Route::post('/vacancies/{entity}/delete', [VacanciesController::class, 'delete'])->name('modules.client.delete');
    Route::get('/vacancies/{entity}', [VacanciesController::class, 'read'])->name('modules.client.read');


    Route::get('/applications', [ApplicationsController::class, 'browse'])->name('modules.applications.browse');
    Route::get('/applications/{entity}', [ApplicationsController::class, 'read'])->name('modules.applications.read');
    Route::post('/applications/{entity}/delete', [ApplicationsController::class, 'delete'])->name('modules.applications.read');

});
