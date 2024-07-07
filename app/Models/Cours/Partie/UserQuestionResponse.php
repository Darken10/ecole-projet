<?php

namespace App\Models\Cours\Partie;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cours\Partie\UserQuestion;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserQuestionResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'response',
        'user_id',
        'user_question_id',
    ];

    function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    function user_question_id():BelongsTo{
        return $this->belongsTo(UserQuestion::class);
    }
}
