<?php

namespace App\Models\Cours;

use App\Models\User;
use App\Models\Statut;
use App\Models\Cours\Question;
use App\Models\Cours\Partie\Content;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Exercice extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'questions',
        'content_id',
        'statut_id',
    ];

    protected function casts(): array
    {
        return [
            'questions' => 'array',
        ];
    }

    function content():BelongsTo{
        return $this->belongsTo(Content::class);
    }
    
    function statut():BelongsTo{
        return $this->belongsTo(Statut::class);
    }

    function questions():BelongsToMany{
        return $this->belongsToMany(Question::class);
    }

    function users():BelongsToMany{
        return $this->belongsToMany(User::class)->withPivot(['note','note_max','response','created_at','updated_at']);
    }
}
