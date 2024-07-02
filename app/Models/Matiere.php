<?php

namespace App\Models;

use App\Models\Statut;
use App\Models\Cours\Partie\Lesson;
use App\Models\Admin\Classe\Classe;
use App\Models\Cours\Partie\Content;
use App\Models\Cours\Partie\Partie;
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
    ] ;

    protected $with = [
        'classes',
    ];

    function classes():BelongsToMany{
        return $this->belongsToMany(Classe::class);
    }

    function lessons():HasMany{
        return $this->hasMany(Lesson::class);
    }

    function statut():BelongsTo{
        return $this->belongsTo(Statut::class);
    }

    function parties():HasMany{
        return $this->hasMany(Partie::class);
    }

    function contents():HasMany{
        return $this->hasMany(Content::class);
    }
}
