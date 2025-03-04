<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use App\Enums\MemberStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Wavey\Sweetalert\Sweetalert;
use App\Http\Controllers\Controller;
use App\Notifications\MemberCreatedNotification;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Members";
        $members = Member::paginate(10);
        return view('dashboard.members.index', compact('title', 'members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Members";
        return view('dashboard.members.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $memberDetail = $request->validate([
            'full_name' => 'required|min:3',
            'phone_number' => 'required|numeric',
            'point' => 'required|numeric',
            'email' => 'required|email:dns',
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
         $member->notify(new MemberCreatedNotification($member));

        Sweetalert::success('berhasil menabah member baru', 'Tambah Member Berhasil!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        $title = "Edit Members";
        return view('dashboard.members.edit', compact('title', 'member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $memberDetail = $request->validate([
            'full_name' => 'required|min:3',
            'phone_number' => 'required|numeric',
            'point' => 'required|numeric',
            'email' => 'required|email:dns',
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

        $member->update(array_merge($memberDetail, [
            'no_telp' => $memberDetail['phone_number']
        ]));

        Sweetalert::success('berhasil mengubah detail member', 'Ubah Member Berhasil!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();

        Sweetalert::success('berhasil menghapus member dengan nama: ' . $member->full_name, 'Hapus Berhasil');
        return back();
    }
}
