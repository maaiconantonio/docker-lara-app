<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CakeUser extends Pivot
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    
    protected $table = 'cake_user';
    protected $fillable = [
        'user_id',
        'cake_id',
    ];
}
