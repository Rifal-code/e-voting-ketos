<?php

namespace App\Http\Controllers\Voter;

use App\Models\User;
use App\Models\Vote;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function index() {
        $candidates = Candidate::all();

        $myVote = Vote::where('user_id', Auth::id());

        return view('voter.index', compact('candidates', 'myVote'));
    }

   public function store( Candidate $candidate) {
       if(Vote::where('user_id', Auth::id())->exists()) {
        return redirect()->back()->with('error', 'Ada sudah melakukan voting');
   }

   Vote::create([
    'user_id' => Auth::id(),
    'candidate_id' => $candidate->id,
   ]);

   return redirect()->back()->with('success', 'Voting berhasil dilakukan');
}

public function results() {
     $totalCandidates = Candidate::count();
    $totalVotes = Vote::count();
     $totalStudents = User::where('role', 'voter')->count();
    $totalParticipation = $totalStudents > 0 ? round($totalVotes / $totalStudents * 100, 2) : 0;

    $candidates = Candidate::withCount('votes')->get();

    $chartData = $candidates->map(function($candidate) use ($totalVotes) {
        $voteCount = $candidate->votes_count;
        $percentage = $totalVotes > 0 ? round(($voteCount / $totalVotes) * 100, 2) : 0;

        return [
            'label' => 'Kandidat ' . $candidate->name,
            'name' => $candidate->name,
            'votes' => $voteCount,
            'percentage' => $percentage,
        ];
    });

    return view('pages.results', compact('totalCandidates', 'totalVotes', 'totalStudents', 'totalParticipation', 'chartData'));
}
}
