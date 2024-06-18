<?php

namespace App\Models\Cours;

use App\Models\Cours\Response;
use App\Models\Cours\Evaluation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'text',
        'point',
        'evaluation_id',
        'type_question_id',
        'good_response',
    ];

    function niveau():BelongsTo{
        return $this->belongsTo(Niveau::class);
    }
    
    function responses():HasMany{
        return $this->hasMany(Response::class);
    }

    function evaluations():BelongsTo {
        return $this->belongsTo(Evaluation::class);
    }
}
