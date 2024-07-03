<?php

namespace App\Models\Cours\Partie;

use App\Models\Cours\Partie\Lesson;
use App\Models\Cours\Partie\Chapitre;
use App\Models\Matiere;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PreRequie extends Model
{

    
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'lesson_id',
        'lesson_id',
        'chapitre_id',
        'matiere_id',
    ];

    function lesson():BelongsTo{
        return $this->belongsTo(Lesson::class);
    }

    
}
