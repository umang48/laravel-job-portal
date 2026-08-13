<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationStatusHistory extends Model
{
     protected $fillable = [
        'job_application_id',
        'changed_by',
        'old_status',
        'new_status',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(
            JobApplication::class,
            'job_application_id'
        );
    }

    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'changed_by'
        );
    }
}
