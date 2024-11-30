<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventCategoryController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\OrganizerAuthController;
use App\Models\Book;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentSuccessMail;

use App\Models\Regency;

Route::get('/', [EventController::class, 'index'])->name('events.index')->middleware('auth.preventorg');

// Admin login routes
Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login')->middleware('auth.admin')->middleware('auth.preventorg');
Route::post('admin/login', [AdminAuthController::class, 'login']);
Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// organizer login routes
Route::get('organizer/login', [OrganizerAuthController::class, 'showLoginForm'])->name('organizer.login')->middleware('auth.preventorg');
Route::post('organizer/login', [OrganizerAuthController::class, 'login']);
Route::post('organizer/logout', [OrganizerAuthController::class, 'logout'])->name('organizer.logout');



// Protect the admin routes with 'auth:admin' middleware
Route::middleware(['auth:admin', 'prevent.cache'])->group(function () {
    Route::resource('categories', EventCategoryController::class);
    Route::resource('organizers', OrganizerController::class);
    Route::get('admin/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{id}', [BookingController::class, 'update'])->name('bookings.update');
    Route::get('/organizers/{id}', [OrganizerController::class, 'show'])->name('organizers.show');
    Route::get('/bookings', [BookingController::class, 'search'])->name('bookings.search');

    Route::get('/master-events', [EventController::class, 'masterIndex'])->name('events.masterIndex');
});
Route::middleware(['prevent.cache'])->group(function () {
    Route::get('/master-events', [EventController::class, 'masterIndex'])->name('events.masterIndex');
});

// Protect the organizer routes with 'auth:organizer' middleware
Route::middleware(['auth:organizer', 'prevent.cache'])->group(function () {
    Route::get('organizer/home', [OrganizerController::class, 'home'])->name('organizers.home');
    Route::get('events/{event}/bookings', [BookingController::class, 'getBookings'])->name('events.bookings');
});


Route::group(['auth.preventorg'], function () {
    Route::get('/api/regencies/{province}', function ($provinceId) {
        return Regency::where('province_id', $provinceId)->get(['id', 'name']);
    });
    Route::resource('events', EventController::class);
    Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/create/{event_id}', [BookingController::class, 'create'])->name('bookings.create');
    Route::get('/payment-success/{id}', function ($id) {
        // Find and update the booking
        $booking = Book::findOrFail($id);
        $booking->update(['status_bayar' => 'paid']);

        session(['payment_success' => true]);
        // Refresh the instance to get the latest data
        $booking->refresh();

        return view('bookings.success', ['booking' => $booking]);
    });
});
