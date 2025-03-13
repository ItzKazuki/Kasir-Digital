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
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Silakan masukkan alamat email yang valid.',
            'email.dns' => 'Domain email harus memiliki catatan DNS yang valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus minimal 3 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

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
