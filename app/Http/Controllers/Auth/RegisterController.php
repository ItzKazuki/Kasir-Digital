<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Wavey\Sweetalert\Sweetalert;

class RegisterController extends Controller
{
    public function register()
    {
        $title = "Register";
        return view('auth.register', compact('title'));
    }

    public function store(Request $request)
    {
        $customMessages = [
            'full_name.required' => 'Full name is required.',
            'full_name.min' => 'Full name must be at least 3 characters.',
            'username.required' => 'Username is required.',
            'username.unique' => 'This username is already taken.',
            'username.min' => 'Username must be at least 3 characters.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.dns' => 'The email domain must have valid DNS records.',
            'phone_number.required' => 'Phone number is required.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 3 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ];

        $users = $request->validate([
            'full_name' => 'required|min:3',
            'username' => 'required|unique:users,username|min:3',
            'email' => 'required|email:dns',
            'phone_number' => 'required',
            'password' => 'required|min:3|confirmed',
        ], $customMessages);

        // create user and redirect to login with success
        User::create(array_merge($users, [
            'no_telp' => $users['phone_number'],
            'role' => 'kasir',
            'image_url' => null,
        ]));

        // message success
        Sweetalert::success('Akun berhasil di buat, silahkan login terlebih dahulu', 'Pendaftaran Berhasil!');
        return redirect()->route('auth.login');
    }
}
