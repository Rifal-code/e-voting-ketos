<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCandidateRequest;
use App\Http\Requests\UpdateCandidateRequest;
use App\Http\Resources\CandidateResource;
use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => CandidateResource::collection(Candidate::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCandidateRequest $request)
    {
        $candidate = Candidate::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Kandidat berhasil ditambahkan',
            'data' => new CandidateResource($candidate)
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate)
    {
        return response()->json([
            'success' => true,
            'data' => new CandidateResource($candidate)
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCandidateRequest $request, Candidate $candidate)
    {
        $candidate->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Kandidat berhasil diperbarui',
            'data' => new CandidateResource($candidate)
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {
        $candidate->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kandidat berhasil dihapus'
        ],200);
    }
}
