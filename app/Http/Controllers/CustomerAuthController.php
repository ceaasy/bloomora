<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class CustomerAuthController extends Controller
{
     public function showRegisterForm()
    {
        return view('customer.auth.register');
    }
 
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:128'],
            'phone' => ['required', 'string', 'max:25'],
            'email' => ['required', 'email', 'max:128', 'unique:customers,email'],
            'address' => ['nullable', 'string'],
            'password' => ['required', 'confirmed', Password::min(8)]
        ]);
 
        $photoPath = null;
        if ($request->hasFile('profile_photo')) {
            $photoPath = $request->file('profile_photo')->store('profile_photos/customers', 'public');
        }
 
        $customer = Customer::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'address' => $validated['address'] ?? null,
            'password' => bcrypt($validated['password'])
        ]);
 
        Auth::guard('customer')->login($customer);
 
        return redirect()->route('customer.home')->with('success', 'Registrasi berhasil! Selamat datang di Bloomora.');
    }
 
    public function showLoginForm()
    {
        return view('customer.auth.login');
    }
 
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::guard('customer')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
 
            return redirect()->intended(route('customer.home'))
                ->with('success', 'Login berhasil!');
        }
 
        return back()->withErrors([
            'email' => 'Email atau password yang dimasukkan salah.',
        ])->onlyInput('email');
    }
 
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
 
        return redirect()->route('customer.login')->with('success', 'Berhasil logout.');
    }
}
