<?php

namespace App\Models\Chat;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable=[
        'from_id',
        'to_id',
        'message',
        'read_at',
        
    ];
    
    protected  $with =[
        'to',
        'from',
    ];

    protected  $dates = [
        'read_at',
        'created_at',
        'update_at'
    ];

    function from():BelongsTo {
        return $this->belongsTo(User::class,'from_id');
    }

    function to():BelongsTo {
        return $this->belongsTo(User::class,'to_id');
    }
}
