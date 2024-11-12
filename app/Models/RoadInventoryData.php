<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoadInventoryData extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function roadInventory(): BelongsTo
    {
        return $this->belongsTo(RoadInventory::class);
    }
    // public function dataAspal(): HasMany
    // {
    //     return $this->hasMany(AsphaltStreetData::class);
    // }
    // public function dataTanah(): HasMany
    // {
    //     return $this->hasMany(SoilsStreetData::class);
    // }
}
