<?php

namespace App\Models;

use App\Models\SoilsStreetData;
use App\Models\AsphaltStreetData;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoadInventory extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function dataRoadInventory(): HasMany
    {
        return $this->hasMany(RoadInventoryData::class)->cascadeOnDelete();
    }
    public function asphaltStreet(): HasMany
    {
        return $this->hasMany(AsphaltStreet::class)->cascadeOnDelete();
    }
    public function soilsStreet(): HasMany
    {
        return $this->hasMany(SoilsStreet::class)->cascadeOnDelete();
    }
}
