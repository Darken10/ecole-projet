<?php

namespace App\Models\Cours\Partie;

use App\Models\User;
use App\Models\Statut;
use App\Models\Matiere;
use App\Models\Cours\Evaluation;
use App\Models\Cours\Partie\Content;
use App\Models\Cours\Partie\Chapitre;
use App\Models\Cours\Partie\Objectif;
use App\Models\Cours\Partie\BigLetter;
use App\Models\Cours\Partie\BigNumber;
use App\Models\Cours\Partie\PreRequie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'matiere_id',
        'chapitre_id',
        'user_id',
        'statut_id',
        'lesson_numero',
        'image_uri',
        'created_at',
        'updated_at'
    ];

    function chapitre():BelongsTo|null{
        return $this->belongsTo(Chapitre::class);
    }

    function matiere():BelongsTo|null{
            return $this->belongsTo(Matiere::class);
    }

    function contents():HasMany{
        return $this->hasMany(Content::class);
    }


    function pre_requies():HasMany{
        return $this->hasMany(PreRequie::class);
    }

    function objectifs():HasMany{
        return $this->hasMany(Objectif::class);
    }


    public function is_published():bool{
        return $this->published_at < now();
    }

    function evaluations():HasMany{
        return $this->hasMany(Evaluation::class);
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

    function users():BelongsToMany{
        return $this->belongsToMany(User::class)->withPivot(['apreciation','is_view','is_learned','created_at','updated_at']);
    } 

    function eleves():BelongsToMany{
        return $this->users();
    }
}
