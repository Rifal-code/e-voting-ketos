<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VoteResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

    $totalVotes = $this->additional['total_votes'] ?? 0;

        return [
            'candidate_id' => $this->id,
            'candidate_name' => $this->name,
            'vote_count' => $this->votes_count,
            'percentage' => $totalVotes > 0 ? round(($this->votes_count / $totalVotes) * 100, 1 ) : 0
        ];
    }
}
