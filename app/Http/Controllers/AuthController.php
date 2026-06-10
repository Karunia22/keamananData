<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function login()
    {
        $title = 'Login';

        return view('loginDanRegister.login', compact('title'));
    }

    public function cekData(Request $request)
    {
        // Semua percobaan dari IP yang sama akan dihitung
        $key = 'login-attempts-'.$request->ip();

        // Maksimal 5 percobaan gagal
        if (RateLimiter::tooManyAttempts($key, 5)) {

            $seconds = RateLimiter::availableIn($key);

            return back()
                ->withInput()
                ->with('lockout_seconds', RateLimiter::availableIn($key))->setStatusCode(429);

        }

        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ], [
            'name.required' => 'Username wajib diisi',
            'password.required' => 'Password tidak boleh kosong',
        ]);

        if (Auth::attempt($credentials)) {

            // Reset jumlah percobaan jika login berhasil
            RateLimiter::clear($key);

            $request->session()->regenerate();

            return redirect()->route('index');
        }

        // Tambah jumlah percobaan gagal
        RateLimiter::hit($key, 60);

        return back()->withErrors([
            'password' => 'Username atau password salah.',
        ])->withInput();
    }

    public function logOut(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
