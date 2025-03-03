<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Wavey\Sweetalert\Sweetalert;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $title = "Settings";
        $user = $request->user();
        return view('dashboard.settings', compact('title', 'user'));
    }

    public function update(Request $request, User $user)
    {
        $userInput = $request->validate([
            'full_name' => 'required|min:3',
            'phone_number' => 'required|min:11|max:13',
            'email' => 'required|email:dns|unique:users,email,' . $user->id,
            'username' => 'required|min:3|unique:users,username,' . $user->id
        ], [
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'full_name.min' => 'Nama lengkap harus memiliki minimal 3 karakter.',

            'phone_number.required' => 'Nomor telepon wajib diisi.',
            'phone_number.min' => 'Nomor telepon harus memiliki minimal 11 digit.',
            'phone_number.max' => 'Nomor telepon tidak boleh lebih dari 13 digit.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain.',

            'username.required' => 'Username wajib diisi.',
            'username.min' => 'Username harus memiliki minimal 3 karakter.',
            'username.unique' => 'Username sudah digunakan. Silakan pilih username lain.'
        ]);

        $user->full_name = $userInput['full_name'];
        $user->no_telp = $userInput['phone_number'];
        $user->email = $userInput['email'];
        $user->username = $userInput['username'];
        $user->save();

        Sweetalert::success('berhasil mengubah detail account', 'Ubah Profile Berhasil!');
        return back();
    }

    public function updateProfile(Request $request, User $user)
    {
        $request->validate([
            'profile_img' => 'required|string'
        ], [
            'profile_img.required' => 'Foto profil wajib diunggah.',
            'profile_img_base64.string' => 'Data gambar tidak valid.'
        ]);

        // convert base64 image to file
        $imageData = $request->input('profile_img');
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $imageData = base64_decode($imageData);

        // add filename
        $imageName = $request->user()->username . '-' . date('dmyHis') . '.png';

        Storage::put('static/images/profiles/' . $imageName, $imageData);

        // cek apakah sebelumnya ada/udh punya gambar belum
        // kalo udh hapus dulu, baru di save.
        if ($user->profile_img != null) {
            Storage::delete('static/images/profiles/' . $user->profile_img);
        }

        // update image profile
        $user->profile_img = $imageName;
        $user->save();

        Sweetalert::success('berhasil mengubah gambar profile', 'Ubah Profile Berhasil!');
        return back();
    }

    public function deleteProfile(Request $request, User $user)
    {
        Storage::delete('static/images/profiles/' . $user->profile_img);

        $user->profile_img = NULL;
        $user->save();

        Sweetalert::success('berhasil menghapus gambar profile', 'Hapus Profile Berhasil!');
        return back();
    }
}
