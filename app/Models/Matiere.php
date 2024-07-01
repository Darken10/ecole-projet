<?php

namespace App\Models;

use App\Models\Statut;
use App\Models\Cours\Lesson;
use App\Models\Admin\Classe\Classe;
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
}
