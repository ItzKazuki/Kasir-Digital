<?php

namespace App\Http\Controllers\Api\Auth;

use Carbon\Carbon;
use App\Mail\OtpMail;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Mail\LoginSuccessMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\MemberResource;

class AuthController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:members,email'
        ]);

        // get member detail from email
        $member = Member::where('email', $request->email)->first();

        $otpKey = "otp_" . $member->id;
        $otpAttemptsKey = "otp_attempts_" . $member->id;

        $attemptsOtp = Cache::get($otpAttemptsKey, 0);

        if($attemptsOtp >= 3) {
            return response()->json([
               'status' => 'failed',
               'message' => 'Too many OTP requests. Please try again later.'
            ], 429);
        }

        // generate 6 code otp and expired
        $otp = rand(100000, 999999);

        Cache::put($otpKey, $otp, now()->addMinutes(10));
        Cache::put($otpAttemptsKey, $attemptsOtp + 1, now()->addMinutes(10));

        // Mail::raw("Your OTP code is: $otp. It will expire in 10 minutes.", function($message) use ($member) {
        //     $message->to($member->email)->subject('Your Login OTP');
        // });

        Mail::to($member->email)->send(new OtpMail($otp, $member));

        return response()->json([
            'status' => 'success',
            'message' => 'OTP send successfully'
        ]);
    }

    public function register(Request $request)
    {
        //
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:members,email',
            'otp' => 'required|digits:6'
        ]);

        $otp = intval($request->otp);

        $member = Member::where('email', $request->email)->first();

        $otpKey = "otp_" . $member->id;
        $otpAttemptsKey = "otp_attempts_" . $member->id;

        $cachedOtp = Cache::get($otpKey);

        if(!$cachedOtp || $cachedOtp !== $otp) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Invalid or expired OTP token.'
            ], 401);
        }

        Cache::forget($otpKey);
        Cache::forget($otpAttemptsKey);

        $token = $member->createToken('member-token')->plainTextToken;

        $ipAddress = $request->ip();
        $time = now()->format('Y-m-d H:i:s');

        Mail::to($member->email)->send(new LoginSuccessMail($member, $ipAddress, $time));

        return response()->json([
            'status' => 'success',
            'message' => 'Login Successfull',
            'token' => $token,
            'member' => new MemberResource($member)
        ]);
    }

    public function logout(Request $request) {
        // logout here

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logout berhasil'
        ], 200);
    }

    public function profile(Request $request) {
        // this will be return data as a member

        return new MemberResource($request->user());
    }
}
