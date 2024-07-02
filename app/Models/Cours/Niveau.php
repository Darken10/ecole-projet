<?php

namespace App\Models\Cours;

use App\Models\Cours\Partie\Chapitre;
use App\Models\Cours\Partie\Content;
use App\Models\Cours\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;

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

    function chapitres():HasMany{
        return $this->hasMany(Chapitre::class);
    }

    function all_lessons():Collection{
        $lessons = [];
        foreach ($this->chapitres as $chapitre) {
            foreach ($chapitre->lessons as $lesson) {
                $lessons[] = $lesson;
            }
        }
        return Collection::make($lessons);
    }

    function contents():HasMany{
        return $this->hasMany(Content::class);
    }

}
