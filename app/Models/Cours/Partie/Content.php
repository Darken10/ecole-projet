<?php

namespace App\Models\Cours\Partie;

use App\Models\Cours\PieceJoint;
use App\Models\Cours\Partie\BigPoint;
use App\Models\Cours\Partie\BigLetter;
use App\Models\Cours\Partie\BigNumber;
use App\Models\Cours\Partie\SmallPoint;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cours\Partie\SmallLetter;
use App\Models\Cours\Partie\SmallNumber;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Content extends Model
{

    protected $fillable = [
        'content',
        'section_title',
    ];

    use HasFactory;

    function piece_joint():HasMany{
        return $this->hasMany(PieceJoint::class);
    }

    function lesson():HasMany{
        return $this->hasMany(Lesson::class);
    }

}
