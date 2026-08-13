<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobApplication extends Model
{
    protected $fillable = [
        'job_id',
        'user_id',
        'resume',
        'cover_letter',
        'status',
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function statusHistories(): HasMany
    {
        return $this->hasMany(
            ApplicationStatusHistory::class,
            'job_application_id'
        )->latest();
    }
}
