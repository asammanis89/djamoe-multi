<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login dengan username atau email.
     */
    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ], [
            'login.required' => 'Username atau email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Tentukan apakah input adalah email atau username
        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        $credentials = [
            $loginField => $request->login,
            'password'  => $request->password,
        ];

        // Cari user berdasarkan field yang digunakan
        $user = \App\Models\User::where($loginField, $request->login)->first();

        // Jika user tidak ditemukan
        if (!$user) {
            throw ValidationException::withMessages([
                'login' => ['Username atau email tidak ditemukan.'],
            ]);
        }

        // Jika user ditemukan tapi tidak aktif
        if (!$user->is_active) {
            throw ValidationException::withMessages([
                'login' => ['Akun ini telah dinonaktifkan.'],
            ]);
        }

        // Coba autentikasi
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        // Jika password salah
        throw ValidationException::withMessages([
            'login' => ['Password salah.'],
        ]);
    }

    /**
     * Logout pengguna.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    /**
     * Beri tahu Laravel bahwa field login bisa dinamis.
     * (Opsional, tapi disarankan untuk kompatibilitas)
     */
    public function username()
    {
        return 'login'; // Tidak digunakan langsung, tapi aman
    }
}