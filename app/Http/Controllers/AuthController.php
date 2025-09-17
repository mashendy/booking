<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // ✅ CEK ROLE DAN ARAHKAN SESUAI
            if (Auth::user()->role === 'admin') {
                return redirect()->route('rooms.index'); // ke halaman Rooms
            } elseif (Auth::user()->role === 'petugas') {
                return redirect()->route('petugas.reservations.index'); // ke halaman petugas
            } else {
                return redirect()->route('bookings.index'); // default user
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
