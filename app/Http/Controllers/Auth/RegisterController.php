<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Wavey\Sweetalert\Sweetalert;
use App\Http\Controllers\Controller;
use App\Notifications\AccountCreatedNotification;

class RegisterController extends Controller
{
    public function register()
    {
        $title = "Register";

        return view('auth.register', compact('title'));
    }

    public function store(Request $request)
    {
        $users = $request->validate([
            'full_name' => 'required|min:3',
            'username' => 'required|unique:users,username|min:3',
            'email' => 'required|email:dns',
            'phone_number' => 'required|numeric',
            'password' => 'required|min:8|confirmed',
        ], [
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'full_name.min' => 'Nama lengkap harus minimal 3 karakter.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username ini sudah digunakan.',
            'username.min' => 'Username harus minimal 3 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Silakan masukkan alamat email yang valid.',
            'email.dns' => 'Domain email harus memiliki catatan DNS yang valid.',
            'phone_number.required' => 'Nomor telepon wajib diisi.',
            'phone_number.numeric' => 'Nomor telepon harus berupa angka.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);


        // create user and redirect to login with success
        $user = User::create(array_merge($users, [
            'no_telp' => $users['phone_number'],
            'role' => 'kasir',
            'image_url' => null,
        ]));

        // Kirim notifikasi ke pengguna
        $user->notify(new AccountCreatedNotification($user));

        // message success
        Sweetalert::success('Akun berhasil di buat, silahkan login terlebih dahulu', 'Pendaftaran Berhasil!');
        return redirect()->route('auth.login');
    }
}
