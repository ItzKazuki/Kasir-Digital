<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Wavey\Sweetalert\Sweetalert;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function forgot()
    {
        $title = "Forgot";

        return view('auth.forgot', compact('title'));
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Silakan masukkan alamat email yang valid.',
            'email.dns' => 'Domain email harus memiliki catatan DNS yang valid.',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::ResetLinkSent) {
            Sweetalert::success('Silahkan cek email anda untuk reset password', 'Berhasil Reset Password');
            return redirect()->route('auth.login');
        } else {
            Sweetalert::success('Silahkan cek email anda untuk reset password', 'Berhasil Reset Password');
            return redirect()->route('auth.login');
        }
    }
}
