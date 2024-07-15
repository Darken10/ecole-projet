<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'transaction_id',
        'montant',
        'statut',
        'token',
        'user_id',
        'type_abonnement',
    ];

    function user():HasOne{
        return $this->hasOne(User::class);
    } 
}
