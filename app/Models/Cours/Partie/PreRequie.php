<?php

namespace App\Models\Cours\Partie;

use App\Models\Matiere;
use App\Models\Cours\Partie\Lesson;
use App\Models\Cours\Partie\Chapitre;
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
        'liens',
        'lesson_id',
    ];

    function lesson():BelongsTo{
        return $this->belongsTo(Lesson::class);
    }

    
}
