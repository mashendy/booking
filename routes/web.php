<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;

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
    return view('auth.login'); // file: resources/views/auth/login.blade.php
})->name('login');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard.index'); // file: resources/views/dashboard/index.blade.php
})->name('dashboard');

// ========================
// Rooms (CRUD)
// ========================
Route::resource('rooms', RoomController::class);

// ========================
// Bookings (CRUD)
// ========================
Route::resource('bookings', BookingController::class);
