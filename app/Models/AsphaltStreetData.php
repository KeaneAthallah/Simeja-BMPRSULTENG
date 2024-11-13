<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AsphaltStreetData extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function asphaltStreet(): BelongsTo
    {
        return $this->belongsTo(AsphaltStreet::class);
    }
    public function roadInventoryData()
    {
        return $this->belongsTo(RoadInventoryData::class, 'road_id', 'id');
    }
}
