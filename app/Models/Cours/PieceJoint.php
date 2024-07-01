<?php

namespace App\Models\Cours;

use App\Models\Cours\Lesson;
use App\Models\Cours\TypePieceJoint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PieceJoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'type_piece_joint_id',
        'create_at',
        'updated_at',
    ];


    function lessons():BelongsToMany{
        return $this->belongsToMany(Lesson::class);
    }

    function type_piece_joint():BelongsTo{
        return $this->belongsTo(TypePieceJoint::class);
    }
}
