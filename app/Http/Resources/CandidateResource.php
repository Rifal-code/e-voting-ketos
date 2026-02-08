<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CandidateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'nomor' => $this->nomor,
            'misi' => $this->misi,
            'visi' => $this->visi,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
