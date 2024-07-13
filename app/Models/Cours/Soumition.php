<?php

namespace App\Models\Cours;

use App\Models\User;
use App\Models\Cours\Evaluation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Soumition extends Model
{
    use HasFactory;

    protected $fillable = [
        'response',
        'note',
        'evaluation_id',
        'user_id',
    ];


    protected function casts(): array
    {
        return [
            'response'=>'array',
        ];
    }

    function evaluation():BelongsTo{
        return $this->belongsTo(Evaluation::class);
    }

    function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
