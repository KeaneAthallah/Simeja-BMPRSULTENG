<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoadInventoryData extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function roadInventory(): BelongsTo
    {
        return $this->belongsTo(RoadInventory::class);
    }
}
