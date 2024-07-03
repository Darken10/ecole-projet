<?php

namespace App\Models\Cours\Partie;

use App\Models\Matiere;
use App\Models\Cours\Niveau;
use App\Models\Cours\Partie\Lesson;
use App\Models\Cours\Partie\Partie;
use App\Models\Cours\Partie\Objectif;
use App\Models\Cours\Partie\PreRequie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chapitre extends Model
{

    protected $fillable = [
        'title',
        'matiere_id',
        'niveau_id'
    ];
    use HasFactory;

    function partie(): BelongsTo
    {
        return $this->belongsTo(Partie::class);
    }

    function matiere(): BelongsTo
    {
        return $this->belongsTo(Matiere::class);
    }

    function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    function niveau(): BelongsTo
    {
        return $this->belongsTo(Niveau::class);
    }

    /*************Aides**************** */

    function has_lessons_published(): bool
    {
        return count($this->lessons()->where('published_at', '<', now())->get()) > 0;
    }

    
}
