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
        $customMessages = [
            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.dns' => 'The email domain must have valid DNS records.',
        ];

        $request->validate([
            'email' => 'required|email:dns',
        ], $customMessages);

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

        // $user = User::where('email', $request->email)->first();

        // if (isset($user)) {
        //     $token = $user->createToken();

        //     DB::table('password_resets')->insert([
        //         'email' => $request->email,
        //         'token' => $token,
        //         'created_at' => Carbon::now()
        //     ]);

        //     Sweetalert::success('Silahkan cek email anda untuk reset password', 'Berhasil Reset Password');
        //     return redirect()->route('auth.login');
        // } else {
        //     Sweetalert::success('Silahkan cek email anda untuk reset password', 'Berhasil Reset Password');
        //     return redirect()->route('auth.login');
        // }
    }
}
