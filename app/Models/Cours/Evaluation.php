<?php

namespace App\Models\Cours;

use App\Models\User;
use App\Models\Statut;
use App\Models\Cours\Partie\Lesson;
use App\Models\Cours\Question;
use App\Models\Cours\Soumission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'statut_id',
        'cote',
        'user_id',
        'cours_id',
        'title',
        'description',
        'note_max',
        'difficulty',
        'time',
        'prof',
        'lesson_id',
    ];

    function userCreated(){
        return $this->user();
    }

    function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    function prof(){
        return $this->user();
    }

    function statut():BelongsTo{
        return $this->belongsTo(Statut::class);
    }

    function lesson():BelongsTo{
        return $this->belongsTo(Lesson::class);
    }

    function questions():HasMany{
        return $this->hasMany(Question::class);
    }

    function evaluation_tratiter():BelongsToMany{
        return $this->belongsToMany(EvaluationsTraiter::class);
    }

    function soumissions():HasMany{
        return $this->hasMany(Soumission::class);
    }
}
