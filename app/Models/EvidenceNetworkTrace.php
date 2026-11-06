<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EvidenceNetworkTrace extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_simulation' => 'boolean',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    public function evidence(): BelongsTo
    {
        return $this->belongsTo(EvidenceItem::class, 'evidence_item_id');
    }
}
