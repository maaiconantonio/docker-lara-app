<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;

class Cake extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    protected $fillable = [
        'description',
        'weight',
        'price',
        'qty_avail',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(CakeUser::class);
    }
}
