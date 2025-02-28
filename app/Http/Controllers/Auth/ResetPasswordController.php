<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Wavey\Sweetalert\Sweetalert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{
    public function resetPassword($token)
    {
        $title = "Reset Password";

        return view('auth.reset', compact('title', 'token'));
    }

    public function update(Request $request)
    {
        $customMessages = [
            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.dns' => 'The email domain must have valid DNS records.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 3 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ];

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed',
        ], $customMessages);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => $password
                ]);
                $user->save();
                event(new PasswordReset($user));
            }
        );

        if($status === Password::PasswordReset) {
            Sweetalert::success('Password kamu berhasil diubah, silahkan login.', 'Password Berhasil di Ubah');
            return redirect()->route('auth.login');
        }

        Sweetalert::error('Error saat mengubah password, silahkan coba lagi nanti atau hubungi admin.', 'Gagal Mengubah Password');
        return redirect()->route('auth.login');
    }
}
