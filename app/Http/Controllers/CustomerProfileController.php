<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class CustomerProfileController extends Controller
{
    public function edit()
    {
        $customer = Auth::guard('customer')->user();
        return view('customer.profile.edit', compact('customer'));
    }

    public function update(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:128'],
            'email' => ['required', 'email', 'max:128', 'unique:customers,email,' . $customer->id],
            'phone' => ['required', 'string', 'max:25'],
            'address' => ['nullable', 'string'],
            'profile_photo' => ['nullable', 'image', 'max:2048'],
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh akun lain.',
            'phone.required' => 'Nomor HP wajib diisi.',
            'profile_photo.image' => 'File foto harus berupa gambar.',
            'profile_photo.max' => 'Ukuran foto maksimal 2MB.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $customer->name = $validated['name'];
        $customer->email = $validated['email'];
        $customer->phone = $validated['phone'];
        $customer->address = $validated['address'] ?? null;

        if ($request->hasFile('profile_photo')) {
            $customer->profile_photo = $request->file('profile_photo')->store('profile_photos/customers', 'public');
        }

        if (!empty($validated['password'])) {
            $customer->password = bcrypt($validated['password']);
        }

        $customer->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}