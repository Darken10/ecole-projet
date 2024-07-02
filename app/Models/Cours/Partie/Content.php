<?php

namespace App\Models\Cours\Partie;

use App\Models\User;
use App\Models\Matiere;

use App\Models\Cours\Niveau;
use App\Models\Cours\PieceJoint;
use App\Models\Cours\Partie\Lesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Content extends Model
{

    protected $fillable = [
        'content',
        'section_title',
        'matiere_id',
        'lesson_id',
        'niveau_id',
        'user_id'
    ];

    use HasFactory;

    function piece_joint(): HasMany
    {
        return $this->hasMany(PieceJoint::class);
    }

    function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    function matiere(): BelongsTo
    {
        return $this->belongsTo(Matiere::class);
    }

    function niveau(): BelongsTo
    {
        return $this->belongsTo(Niveau::class);
    }

    function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

}
