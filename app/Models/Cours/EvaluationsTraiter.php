<?php

namespace App\Models\Cours;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EvaluationsTraiter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    function users():BelongsTo{
        return $this->belongsTo(User::class);
    }

    function evaluations():BelongsToMany{
        return $this->belongsToMany(Evaluation::class);
    }
}
