<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoadInventory extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function dataRoadInventory(): HasMany
    {
        return $this->hasMany(RoadInventoryData::class);
    }
}
