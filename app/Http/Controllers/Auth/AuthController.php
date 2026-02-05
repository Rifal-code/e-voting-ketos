<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request) {
        $data = $request->validated();
       

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'class_id' => $data['class_id'],
            'role' => $request->role ?? 'voter'
        ]);

        Auth::login($user);

      return redirect()->route('dashboard')->with('success', 'Registrasi berhasil dan Anda telah masuk.');
    }

    public function login(LoginRequest $request) {
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard')->with('success', 'Login berhasil');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request) {
       Auth::logout();

       $request->session()->invalidate();

       return redirect('/')->with('success', 'Logout berhasil');
    }
}
