<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        $title = "Login";
        return view('loginDanRegister.login', compact('title'));
    }

    public function cekData(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|exists:users,name',
            'password' => 'required',
        ], [
            'name.required' => 'Username wajib diisi',
            'name.exists' => 'Username tidak ditemukan',
            'password.required' => 'Password tidak boleh kosong',
        ]);
        if (Auth::attempt($data)) {

            $request->session()->regenerate();

            return redirect()->route('index');
        } else {
            return redirect()->back()->withErrors(['password' => 'password salah'])->withInput();
        }
    }

    public function logOut(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
