<?php

namespace App\Models;

use App\Models\Surveyor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SoilsStreet extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function soilsStreetData(): HasMany
    {
        return $this->hasMany(SoilsStreetData::class);
    }
    public function roadInventory(): BelongsTo
    {
        return $this->belongsTo(RoadInventory::class);
    }
}
