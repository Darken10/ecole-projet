<?php

namespace App\Models\Cours;

use App\Models\Cours\PieceJoint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypePieceJoint extends Model
{
    use HasFactory;


    function piece_joints():HasMany{
        return $this->hasMany(PieceJoint::class);
    }
}
