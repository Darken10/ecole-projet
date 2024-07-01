<?php

namespace App\Models\Cours;

use App\Models\Cours\Evaluation;
use App\Models\Cours\PieceJoint;
use App\Models\Matiere;
use App\Models\Statut;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lesson extends Model
{
    use HasFactory;



    public function is_published():bool{
        return $this->published_at<now();
    }

    function evaluations():HasMany{
        return $this->hasMany(Evaluation::class);
    }

    function piece_joints():BelongsToMany{
        return $this->belongsToMany(PieceJoint::class);
    }

    function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    function prof(){
        return $this->user();
    }


    function matiere():BelongsTo{
        return $this->belongsTo(Matiere::class);
    }

    function statut():BelongsTo{
        return $this->belongsTo(Statut::class);
    }

    function users():BelongsToMany{
        return $this->belongsToMany(User::class)->withPivot(['apreciation','is_view','is_learned','created_at','updated_at']);
    } 
}
