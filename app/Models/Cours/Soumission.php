<?php

namespace App\Models\Cours;

use App\Models\User;
use App\Models\Cours\Corriger;
use App\Models\Cours\Evaluation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Soumission extends Model
{
    use HasFactory;

    protected $fillable = [
        'note',
        'evaluation_id',
        'user_id',
    ];

    function evaluation():BelongsTo{
        return $this->belongsTo(Evaluation::class);
    }

    function users():BelongsTo{
        return $this->belongsTo(User::class);
    }

    function corrigers():HasMany{
        return $this->hasMany(Corriger::class);
    }
}
