<?php

namespace App\Models\Cours;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
