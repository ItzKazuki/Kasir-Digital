<?php

namespace App\Http\Controllers\Kasir;

use App\Models\Member;
use App\Enums\MemberStatus;
use Illuminate\Http\Request;
use App\Traits\StoreBase64Image;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Notification;
use App\Notifications\MemberCreatedNotification;

class MemberController extends Controller
{
    use StoreBase64Image;

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $memberDetail = $request->validate([
            'full_name' => 'required|min:3',
            'phone_number' => 'required|numeric|unique:members,no_telp',
            'point' => 'required|numeric',
            'email' => 'required|email|unique:members,email',
            'status' => ['required', Rule::enum(MemberStatus::class)]
        ], [
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'full_name.min' => 'Nama lengkap harus minimal 3 karakter.',
            'phone_number.required' => 'Nomor telepon wajib diisi.',
            'phone_number.numeric' => 'Nomor telepon harus berupa angka.',
            'point.required' => 'Poin wajib diisi.',
            'point.numeric' => 'Poin harus berupa angka.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'status.required' => 'Status member wajib diisi.'
        ]);

        $member = Member::create(array_merge($memberDetail, [
            'no_telp' => $memberDetail['phone_number']
        ]));

        // Kirim notifikasi ke member baru
        Notification::route('mail', $member->email)->notify(new MemberCreatedNotification($member));

        return response()->json([
            'status' => 'success',
            'message' => 'Member created successfully.',
        ]);
    }
}
