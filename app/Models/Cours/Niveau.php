<?php

namespace App\Models\Cours;

use App\Models\Cours\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Niveau extends Model
{
    use HasFactory;

    protected  $fillable=[
        'name',
        'difficulty',
    ];

    function questions():HasMany{
        return $this->hasMany(Question::class);
    }

}
