<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventCategoryController;
use App\Http\Controllers\OrganizerController;

Route::get('/', [EventController::class, 'index'])->name('events.index');

Route::resource('categories', EventCategoryController::class); 
Route::resource('organizers', OrganizerController::class);

Route::resource('events', EventController::class);

Route::get('/organizers/{id}', [OrganizerController::class, 'show'])->name('organizers.show');

Route::get('/master-events', [EventController::class, 'masterIndex'])->name('events.masterIndex');

