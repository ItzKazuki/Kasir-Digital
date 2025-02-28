<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Wavey\Sweetalert\Sweetalert;

class SettingController extends Controller
{
    public function index(Request $request) {
        $title = "Settings";
        $user = $request->user();
        return view('dashboard.settings', compact('title', 'user'));
    }

    public function update(Request $request)
    {
        //
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'profile_img' => 'required|image|mimes:png,jpg|max:1024'
        ]);

        $imageName = $request->user()->username.'-'.date('dmyHis').'.'.$request->file('profile_img')->extension();
        $path = Storage::putFileAs('static/images/profiles', $request->file('profile_img'), $imageName);

        $user = User::findOrFail($request->only('user_id'))->first();

        // cek apakah sebelumnya ada/udh punya gambar belum
        // kalo udh hapus dulu, baru di save.
        if($user->profile_img != null) {
            Storage::delete('static/images/profiles/' . $user->profile_img);
        }

        // update image profile
        $user->profile_img = $imageName;
        $user->save();

        Sweetalert::success('berhasil mengubah gambar profile', 'Ubah Profile Berhasil!');
        return redirect()->route('dashboard.settings');
    }
}
