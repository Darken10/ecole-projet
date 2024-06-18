<?php

namespace App\Models\Cours;

use App\Models\User;
use App\Models\Cours\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Response extends Model
{
    use HasFactory;

    protected  $fillable = [
        'text',
        'user_id',
        'is_correct'
    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function questions():BelongsTo{
        return $this->belongsTo(Question::class);
    }
}
