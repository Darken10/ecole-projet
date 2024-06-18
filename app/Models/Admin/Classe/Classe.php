<?php

namespace App\Models\Admin\Classe;

use App\Models\Matiere;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_exam',
        'level',
        'serie',
    ] ;

    function matieres():BelongsToMany{
        return $this->belongsToMany(Matiere::class);
    }
}
