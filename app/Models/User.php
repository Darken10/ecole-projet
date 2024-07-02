<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Cours\Response;
use App\Models\Cours\Evaluation;
use App\Models\Cours\Soumission;
use App\Models\Cours\Partie\Lesson;
use App\Models\Cours\EvaluationsTraiter;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
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
        'name',
        'email',
        'password',
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
}
