<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    protected $table = 'job_posts';

    protected $fillable = [
        'company_id',
        'job_category_id',
        'title',
        'slug',
        'location',
        'job_type',
        'experience',
        'salary_min',
        'salary_max',
        'description',
        'last_date',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'last_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

   public function company(): BelongsTo
{
    return $this->belongsTo(Company::class);
}

public function category(): BelongsTo
{
    return $this->belongsTo(JobCategory::class, 'job_category_id');
}

public function applications(): HasMany
{
    return $this->hasMany(JobApplication::class);
}
}