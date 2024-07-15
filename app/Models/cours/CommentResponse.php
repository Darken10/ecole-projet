<?php

namespace App\Models\cours;

use App\Models\User;
use App\Models\Cours\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommentResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'user_id',
        'comment_id',
    ];

    function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    function comment():BelongsTo{
        return $this->belongsTo(Comment::class);
    }
}
