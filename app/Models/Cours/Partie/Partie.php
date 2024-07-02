<?php

namespace App\Models\Cours\Partie;

use App\Models\Matiere;
use App\Models\Cours\Partie\Chapitre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partie extends Model
{
    protected $fillable = [
        'title',
        'matiere_id',
    ];
    
    use HasFactory;

    function matiere():BelongsTo{
        return $this->belongsTo(Matiere::class);
    }

    function chapitres():HasMany{
        return $this->hasMany(Chapitre::class);
    }
}
