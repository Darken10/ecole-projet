<?php

namespace App\Models;

use App\Models\Admin\Classe\Classe;
use App\Models\Cours\Lesson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
