<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        $title = "Login";

        return view('auth.login', compact('title'));
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            // 'email' => 'required|email:dns', // check is must be a valid domain of mail.
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Silakan masukkan alamat email yang valid.',
            'email.dns' => 'Domain email harus memiliki catatan DNS yang valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus minimal 8 karakter.',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
