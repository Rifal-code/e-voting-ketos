<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Vote;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
        $totalCandidates = Candidate::count();
        $totalVotes = Vote::count();
        $totalStudents = User::where('role', 'voter')->count();
        $totalParticipation = $totalStudents > 0 ? round($totalVotes / $totalStudents * 100, 2) : 0;

        return view('admin.dashboard', compact('totalCandidates', 'totalVotes', 'totalStudents', 'totalParticipation')); 
     }
}
