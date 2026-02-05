<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVoteRequest;
use App\Http\Resources\VoteResource;
use App\Http\Resources\VoteResultResource;
use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function store(StoreVoteRequest $request) {
        if(Vote::where('user_id', Auth::id())->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah melakukan voting'
            ],400);
        }

        $vote = Vote::create([
            'user_id' => Auth::id(),
            'candidate_id' => $request->candidate_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Vote berhasil disimpan',
            'data' => new VoteResource($vote)
        ],201);
    }

    public function results() {
        $totalVotes = Vote::count();
        $candidates = Candidate::withCount('votes')->get();

        return response()->json([
            'success' => true,
            'data' => [
                'total_votes' => $totalVotes,
                'results' => VoteResultResource::collection($candidates)->additional(['total_votes' => $totalVotes])
            ]
        ]);

    }

    public function status() {
        $vote = Vote::with('candidate')->where('user_id', Auth::id())->first();

        return response()->json([
            'success' => true,
            'data' => [
                'has_voted' => (bool)$vote,
                'vote' => $vote ? new VoteResource($vote) : null
            ]
        ]);
    }

}
