<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::with('votes', 'schoolClass')->get();
        

        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user) {
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus.');
    } 
}
