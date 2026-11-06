<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SentimentSnapshot extends Model
{
    protected $guarded = [];

    protected $casts = [
        'measured_at' => 'datetime',
        'positive_pct' => 'decimal:2',
        'neutral_pct' => 'decimal:2',
        'negative_pct' => 'decimal:2',
        'is_simulation' => 'boolean',
    ];

    public function case(): BelongsTo
    {
        return $this->belongsTo(InvestigationCase::class, 'case_id');
    }
}
