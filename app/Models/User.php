<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Role;
use App\Models\Cours\Exercice;
use App\Models\Cours\Response;
use App\Models\Cours\Evaluation;
use App\Models\Cours\Soumission;
use App\Models\Cours\Partie\Lesson;
use App\Models\Cours\Partie\Content;
use App\Models\Cours\EvaluationsTraiter;
use Illuminate\Notifications\Notifiable;
use App\Models\Cours\Partie\UserQuestion;
use App\Models\Cours\Partie\UserQuestionResponse;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'numero',
        'date_naissance',
        'sexe',
        'name',
        'email',
        'password',
        'profile_uri',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    /****************************************************************** */

    function roles():BelongsToMany{
        return $this->belongsToMany(Role::class);
    }

    function responses():HasMany{
        return $this->hasMany(Response::class);
    }

    function evaluationsCreated():HasMany{
        return $this->hasMany(Evaluation::class);
    }

    function lessonsCreated():HasMany{
        return $this->hasMany(Lesson::class);
    }

    function lessons():BelongsToMany{
        return $this->belongsToMany(Lesson::class)->withPivot(['apreciation','is_view','is_learned','created_at','updated_at']);
    }

    function evaluationsTraiter():HasMany{
        return $this->hasMany(EvaluationsTraiter::class);
    }

    function soumissions():HasMany{
        return $this->hasMany(Soumission::class);
    }

    function contents():HasMany{
        return $this->hasMany(User::class);
    }

    function sections():BelongsToMany{
        return $this->belongsToMany(Content::class);
    }

    function user_questions():HasMany{
        return $this->hasMany(UserQuestion::class);
    }

    function user_question_responses():HasMany{
        return $this->hasMany(UserQuestionResponse::class);
    }

    function exercices():BelongsToMany{
        return $this->belongsToMany(Exercice::class)->withPivot(['note','note_max','response','created_at','updated_at']);
    }
}
