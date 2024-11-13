<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoadInventoryData extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function roadInventory(): BelongsTo
    {
        return $this->belongsTo(RoadInventory::class);
    }
    public function asphaltStreet()
    {
        return $this->hasMany(AsphaltStreetData::class, 'id', 'road_id');
    }

    public function soilsStreet()
    {
        return $this->hasMany(SoilsStreetData::class, 'id', 'road_id');
    }
}
