<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AdminProfileController extends Controller
{
    /**
     * Tampilkan form ubah profil admin yang sedang login
     */
    public function edit()
    {
        $admin = Auth::guard('web')->user();
        return view('admin.profile.edit', compact('admin'));
    }

    /**
     * Proses simpan perubahan profil admin
     */
    public function update(Request $request)
    {
        $admin = Auth::guard('web')->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:128'],
            'email' => ['required', 'email', 'max:128', 'unique:users,email,' . $admin->id],
            'profile_photo' => ['nullable', 'image', 'max:2048'],
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh akun lain.',
            'profile_photo.image' => 'File foto harus berupa gambar.',
            'profile_photo.max' => 'Ukuran foto maksimal 2MB.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];

        if ($request->hasFile('profile_photo')) {
            $admin->profile_photo = $request->file('profile_photo')->store('profile_photos/admins', 'public');
        }

        if (!empty($validated['password'])) {
            $admin->password = bcrypt($validated['password']);
        }

        $admin->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}