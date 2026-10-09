<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'username' => 'required|string|max:50|alpha_dash|unique:users,username',
            'password' => ['required', 'confirmed', Password::min(8)],
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'required|string',
        ]);

        do {
            $idUser = 'USR' . Str::upper(Str::random(12));
        } while (User::where('id_user', $idUser)->exists());

        $user = User::create([
            'id_user' => $idUser,
            'nama_lengkap' => $validated['nama_lengkap'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'no_hp' => $validated['no_hp'] ?? null,
            'alamat' => $validated['alamat'],
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('products.index')
            ->with('success', 'Pendaftaran berhasil. Selamat datang!');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('products.index'))
                ->with('success', 'Login berhasil.');
        }

        return back()
            ->withErrors([
                'username' => 'Username atau password salah.',
            ])
            ->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('products.index')
            ->with('success', 'Kamu berhasil logout.');
    }
}