<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', function () {
    return view('landing.index');
})->name('landing');

// ✅ ROUTE LOGIN/LOGOUT
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ✅ Redirect setelah login
Route::get('/redirect-after-login', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        return redirect()->route('rooms.index'); // Admin → Rooms
    }

    if ($user->role === 'petugas') {
        return redirect()->route('petugas.reservations.index'); // Petugas → Reservations
    }

    return redirect()->route('bookings.index'); // User → Bookings
})->middleware('auth')->name('redirect.after.login');

// Rooms (CRUD) - hanya admin
Route::resource('rooms', RoomController::class)->middleware('auth');

// Bookings (CRUD) - hanya user biasa
Route::resource('bookings', BookingController::class)->middleware('auth');

// FITUR PETUGAS
Route::prefix('petugas')->name('petugas.')->middleware(['auth', 'petugas'])->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations/{id}/approve', [ReservationController::class, 'approve'])->name('reservations.approve');
    Route::post('/reservations/{id}/reject', [ReservationController::class, 'reject'])->name('reservations.reject');
});
