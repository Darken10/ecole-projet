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

    function corriger(){
        if($this->question()->first()->type_question_id==1){
            return $this->hasMany(Corriger::class)->one();
        } elseif ($this->question()->first()->type_question_id==2) {
            return $this->belongsToMany(Corriger::class);
        } elseif ($this->question()->first()->type_question_id==3) {
            return $this->hasMany(Corriger::class)->one();
        }else {
            return null;
        }
    }

}
