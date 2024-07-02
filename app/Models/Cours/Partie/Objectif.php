<?php

namespace App\Models\Cours\Partie;

use App\Models\Cours\Partie\Lesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Objectif extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'lesson_id',
    ];

    function lessons():BelongsTo{
        return $this->belongsTo(Lesson::class);
    }
}
