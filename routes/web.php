<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', function () {
    return view('landing.index');
})->name('landing');

// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

// Rooms (CRUD)
Route::resource('rooms', RoomController::class);

// Bookings (CRUD)
Route::resource('bookings', BookingController::class);

// ========================
// FITUR PETUGAS BARU (Recommended)
// ========================
Route::prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations/{id}/approve', [ReservationController::class, 'approve'])->name('reservations.approve');
    Route::post('/reservations/{id}/reject', [ReservationController::class, 'reject'])->name('reservations.reject');
});

// ========================
// Routes Lama Petugas (Bisa dihapus jika tidak digunakan)
// ========================
Route::prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/bookings', [PetugasController::class, 'index'])->name('bookings.index');
    Route::put('/bookings/{booking}', [PetugasController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{booking}', [PetugasController::class, 'destroy'])->name('bookings.destroy');
});