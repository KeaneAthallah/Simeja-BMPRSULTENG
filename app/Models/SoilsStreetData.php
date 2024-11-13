<?php

namespace App\Models;

use App\Models\SoilsStreet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SoilsStreetData extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function soilsStreet(): BelongsTo
    {
        return $this->belongsTo(SoilsStreet::class);
    }
    public function roadInventoryData()
    {
        return $this->belongsTo(RoadInventoryData::class, 'road_id', 'id');
    }
}
