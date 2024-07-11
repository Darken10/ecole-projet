<?php

namespace App\Models\Cours;

use App\Models\Cours\Corriger;
use App\Models\Cours\Exercice;
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
        'text',
        'point',
        'options',
        'evaluation_id',
    ];

    protected function casts(): array
    {
        return [
            'options' => 'array',
        ];
    }
    

    function evaluation():BelongsTo {
        return $this->belongsTo(Evaluation::class);
    }
    // La reponse traiter par l'utilisateur
    function corrigers():HasMany{
        return $this->hasMany(Corriger::class);
    }

    function exercices():BelongsToMany{
        return $this->belongsToMany(Exercice::class);
    }
}