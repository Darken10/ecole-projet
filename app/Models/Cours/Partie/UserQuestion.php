<?php

namespace App\Models\Cours\Partie;

use App\Models\User;
use App\Models\Cours\Partie\Lesson;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cours\Partie\UserQuestionResponse;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserQuestion extends Model
{
    use HasFactory;

    protected $fillable =[
        'Question',
        'user_id',
        'lesson_id',
    ];

    function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    function lesson():BelongsTo{
        return $this->belongsTo(Lesson::class);
    }

    function user_question_responses():HasMany{
        return $this->hasMany(UserQuestionResponse::class);
    }
}
