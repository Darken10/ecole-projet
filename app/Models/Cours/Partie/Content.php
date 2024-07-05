<?php

namespace App\Models\Cours\Partie;

use App\Models\User;
use App\Models\Matiere;

use App\Models\Cours\Niveau;
use App\Models\Cours\Exercice;
use App\Models\Cours\PieceJoint;
use App\Models\Cours\Partie\Lesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class Content extends Model
{

    protected $fillable = [
        'content',
        'numero_section',
        'section_title',
        'lesson_id',
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

    /*function matiere(): BelongsTo
    {
        return $this->belongsTo(Matiere::class);
    }

    function niveau(): BelongsTo
    {
        return $this->belongsTo(Niveau::class);
    }*/

    function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    function users():BelongsToMany{
        return $this->belongsToMany(User::class);
    }

    function exercices():HasMany{
        return $this->hasMany(Exercice::class);
    }

    static function all_contents():Collection{
        $contents = [];
        foreach (Lesson::all_lessons() as $key => $value) {
            # code...
        }

        return Collection::make($contents);
    }

}
