<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::with('votes', 'schoolClass')->get();

        return view('admin.users.index', compact('users'));
    }

    public function create() {
        $classes = SchoolClass::all();

        return view('admin.users.create', compact('classes'));
    }

    public function store(RegisterRequest $request) {
       User::create($request->validated());

        return redirect()->route('admin.users')->with('success', 'User berhasil ditambahkan.');
    }

    public function destroy(User $user) {
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus.');
    } 
}
