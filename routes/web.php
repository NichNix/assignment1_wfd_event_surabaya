<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventCategoryController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminAuthController;
use App\Models\Regency;

Route::get('/', [EventController::class, 'index'])->name('events.index');

// Admin login routes
Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login')->middleware('auth.admin');
Route::post('admin/login', [AdminAuthController::class, 'login']);
Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


// Protect the admin routes with 'auth:admin' middleware
Route::middleware(['auth:admin', 'prevent.cache'])->group(function () {
    Route::resource('categories', EventCategoryController::class);
    Route::resource('organizers', OrganizerController::class);
    Route::get('admin/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{id}', [BookingController::class, 'update'])->name('bookings.update');
    Route::get('/organizers/{id}', [OrganizerController::class, 'show'])->name('organizers.show');
    Route::get('/master-events', [EventController::class, 'masterIndex'])->name('events.masterIndex');
});


Route::group([], function () {
    Route::get('/api/regencies/{province}', function ($provinceId) {
        return Regency::where('province_id', $provinceId)->get(['id', 'name']);
    });
    Route::resource('events', EventController::class);
    Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/create/{event_id}', [BookingController::class, 'create'])->name('bookings.create');
});
