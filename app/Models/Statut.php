<?php

namespace App\Models;

use App\Models\Cours\Evaluation;
use App\Models\Cours\Partie\Lesson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Statut extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name'
    ] ;

    function evaluations():HasMany{
        return $this->hasMany(Evaluation::class);
    }
    
    function lessons():HasMany{
        return $this->hasMany(Lesson::class);
    }

}
