<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventCategoryController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminAuthController;
use App\Models\Regency;

Route::get('/', [EventController::class, 'index'])->name('events.index');
Route::get('/api/regencies/{province}', function ($provinceId) {
    return Regency::where('province_id', $provinceId)->get(['id', 'name']);
});
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/create/{event_id}', [BookingController::class, 'create'])->name('bookings.create');

// Admin login routes
Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login']);

Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


// Protect the admin routes with 'auth:admin' middleware
Route::middleware(['auth:admin'])->group(function () {
    Route::resource('categories', EventCategoryController::class);
    Route::resource('organizers', OrganizerController::class);
    Route::resource('events', EventController::class);

    Route::get('admin/bookings', [BookingController::class, 'index'])->name('bookings.index');
    
    // Admin-only booking edit, update, and delete routes
    Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{id}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    
    // Admin-only organizer detail view
    Route::get('/organizers/{id}', [OrganizerController::class, 'show'])->name('organizers.show');

    Route::get('/master-events', [EventController::class, 'masterIndex'])->name('events.masterIndex');
});