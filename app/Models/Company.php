<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'logo',
        'website',
        'email',
        'phone',
        'description',
        'address',
        'city',
        'is_verified',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function jobs(): HasMany
{
    return $this->hasMany(Job::class);
}
}
