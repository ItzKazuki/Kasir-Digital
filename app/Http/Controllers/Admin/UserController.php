<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Wavey\Sweetalert\Sweetalert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Users";
        $users = User::paginate(10);
        return view('dashboard.users.index', compact('title', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Users";
        return view('dashboard.users.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|regex:/08[0-9]{8,11}/',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,kasir',
        ], [
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'full_name.string' => 'Nama lengkap harus berupa string.',
            'full_name.max' => 'Nama lengkap maksimal 255 karakter.',
            'phone_number.required' => 'Nomor telepon wajib diisi.',
            'phone_number.string' => 'Nomor telepon harus berupa string.',
            'phone_number.regex' => 'Nomor telepon tidak valid.',
            'email.required' => 'Email wajib diisi.',
            'email.string' => 'Email harus berupa string.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'email.unique' => 'Email sudah terdaftar.',
            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa string.',
            'username.max' => 'Username maksimal 255 karakter.',
            'username.unique' => 'Username sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.string' => 'Password harus berupa string.',
            'password.min' => 'Password minimal 8 karakter.',
            'role.required' => 'Role wajib diisi.',
            'role.string' => 'Role harus berupa string.',
            'role.in' => 'Role harus salah satu dari: admin, kasir.',
        ]);

        User::create([
            'full_name' => $request->full_name,
            'no_telp' => $request->phone_number,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        Sweetalert::success('Pengguna baru berhasil dibuat', 'Buat Berhasil');
        return redirect()->route('dashboard.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $title = "Edit Users";
        return view('dashboard.users.edit', compact('title', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|regex:/08[0-9]{8,11}/',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:admin,kasir',
        ], [
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'full_name.string' => 'Nama lengkap harus berupa string.',
            'full_name.max' => 'Nama lengkap maksimal 255 karakter.',
            'phone_number.required' => 'Nomor telepon wajib diisi.',
            'phone_number.string' => 'Nomor telepon harus berupa string.',
            'phone_number.regex' => 'Nomor telepon tidak valid.',
            'email.required' => 'Email wajib diisi.',
            'email.string' => 'Email harus berupa string.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'email.unique' => 'Email sudah terdaftar.',
            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa string.',
            'username.max' => 'Username maksimal 255 karakter.',
            'username.unique' => 'Username sudah terdaftar.',
            'password.string' => 'Password harus berupa string.',
            'password.min' => 'Password minimal 8 karakter.',
            'role.required' => 'Role wajib diisi.',
            'role.string' => 'Role harus berupa string.',
            'role.in' => 'Role harus salah satu dari: admin, kasir.',
        ]);

        $data = [
            'full_name' => $request->full_name,
            'no_telp' => $request->phone_number,
            'email' => $request->email,
            'username' => $request->username,
            'role' => $request->role,
        ];

        if ($request->password) {
            $data['password'] = $request->password;
        }

        $user->update($data);

        Sweetalert::success('Detail pengguna berhasil diperbarui', 'Update Berhasil');
        return redirect()->route('dashboard.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        Sweetalert::success('berhasil menghapus user ' . $user->full_name, 'Hapus Berhasil');
        return back();
    }
}
