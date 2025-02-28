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
        $customMessages = [
            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.dns' => 'The email domain must have valid DNS records.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 3 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ];

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
        ], $customMessages);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
