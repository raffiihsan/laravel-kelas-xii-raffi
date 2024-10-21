<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User; // Model untuk pengguna
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan semua profil yang tersedia
        $profiles = Profile::all();
        return view('profile.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk membuat profil baru
        return view('profile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfileRequest $request)
    {
        // Menyimpan profil baru
        $profile = Profile::create($request->validated());
        return redirect()->route('profiles.index')->with('success', 'Profile created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        // Menampilkan profil tertentu
        return view('profile.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        // Menampilkan form untuk mengedit profil
        return view('profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        // Memperbarui profil yang ada
        $profile->update($request->validated());
        return redirect()->route('profiles.index')->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        // Menghapus profil tertentu
        $profile->delete();
        return redirect()->route('profiles.index')->with('success', 'Profile deleted successfully.');
    }

    /**
     * Show the form for login.
     */
    public function showLoginForm()
    {
        // Menampilkan form login
        return view('auth.login');
    }

    /**
     * Process login.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')->with('success', 'Login successful.');
        }

        return back()->withErrors([
            'username' => 'These credentials do not match our records.',
        ]);
    }

    /**
     * Show the form for registration.
     */
    public function showRegisterForm()
    {
        // Menampilkan form registrasi
        return view('auth.register');
    }

    /**
     * Process registration.
     */
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful, please login.');
    }

}
