<?php

namespace App\Models;

use App\Models\User;
use App\Models\Candidate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    protected $table = 'votes';

    protected $fillable = ['candidate_id', 'user_id'];

    public function candidate():BelongsTo {
        return $this->belongsTo(Candidate::class);
    }

    public function user():BelongsTo {
        return $this->belongsTo(User::class);
    }
}
