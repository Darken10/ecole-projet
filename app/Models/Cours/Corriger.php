<?php

namespace App\Models\Cours;

use App\Models\Cours\Question;
use App\Models\Cours\Response;
use App\Models\Cours\Soumission;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Corriger extends Model
{
    use HasFactory;

    protected $fillable = [
        'response_id',
        'soumission_id',
        'question_id',
        'response_text',
    ];

    function question():BelongsTo{
        return $this->belongsTo(Question::class);
    }

    function soumission():BelongsTo{
        return $this->belongsTo(Soumission::class);
    }

    function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    function response():BelongsTo|BelongsToMany|null{
        if($this->question->type_question_id==1){
            return $this->belongsTo(Response::class);
        } elseif ($this->question->type_question_id==2) {
            return $this->belongsToMany(Response::class);
        } elseif ($this->question->type_question_id==3) {
            return $this->response_text;
        }else {
            return null;
        }
    }

    function isGoodResponse():bool{
        $isGood = False;

        return $isGood;
    }

    
}
