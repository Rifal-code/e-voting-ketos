<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
       public function showRegister() {
            $classes = SchoolClass::all();

            return view('auth.register', compact('classes'));
       } 

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

       return redirect()->route('home')->with('success', 'Berhasil register dan anda sudah masuk');
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function login(LoginRequest $request) {
      $credentials = $request->only('email', 'password');

      if(Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Berhasil Login');
      }

      return redirect()->back()->withErrors([
            'email' => 'Emal atau password salah'
      ],403);
    }

    public function logout(Request $request) {
       Auth::logout();

       $request->session()->invalidate();

       return redirect('/')->with('success', 'Logout berhasil');
    }

    public function home() {
        $user = Auth::user();

        if($user?->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

          return redirect()->route('voter.dashboard');
    }
}
