<?php

namespace App\Models\Cours;

use App\Models\User;
use App\Models\Cours\Partie\Lesson;
use App\Models\cours\CommentResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'user_id',
        'lesson_id',
    ];

    function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    function lesson():BelongsTo{
        return $this->belongsTo(Lesson::class);
    }

    function commentResponses():HasMany{
        return $this->hasMany(CommentResponse::class);
    }

    function count_responses():int{
        return count($this->commentResponses);
    }

    function count_likes():int{
        return count($this->users);
    }

    function users():BelongsToMany{
        return $this->belongsToMany(User::class);
    }

}
