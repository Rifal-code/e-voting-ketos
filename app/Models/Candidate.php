<?php

namespace App\Models;

use App\Models\Vote;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidate extends Model
{
    protected $table = 'candidates';

    protected $fillable = ['name'];

    public function votes(): HasMany {
        return $this->hasMany(Vote::class);
    }
}
