<?php

namespace App\Models;

use App\Models\Statut;
use App\Models\Admin\Classe\Classe;
use App\Models\Cours\Partie\Lesson;
use App\Models\Cours\Partie\Partie;
use App\Models\Cours\Partie\Content;
use App\Models\Cours\Partie\Chapitre;
use App\Models\Cours\Partie\Objectif;
use App\Models\Cours\Partie\PreRequie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Matiere extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'statut_id',
    ];

    protected $with = [
        'classes',
    ];

    function classes(): BelongsToMany
    {
        return $this->belongsToMany(Classe::class);
    }

    function statut(): BelongsTo
    {
        return $this->belongsTo(Statut::class);
    }

    function chapitres(): HasMany
    {
        return $this->hasMany(Chapitre::class);
    }

    
}
