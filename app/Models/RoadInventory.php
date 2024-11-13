<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\AsphaltStreetData;
use App\Models\SoilsStreetData;

class RoadInventory extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function dataRoadInventory(): HasMany
    {
        return $this->hasMany(RoadInventoryData::class);
    }
    public function asphaltStreet(): HasMany
    {
        return $this->hasMany(AsphaltStreet::class);
    }
    public function soilsStreet(): HasMany
    {
        return $this->hasMany(SoilsStreet::class);
    }
    public function road()
    {
        // Retrieve all dataRoadInventory records related to this RoadInventory instance
        $dataRoadInventory = $this->dataRoadInventory;
        // Initialize an empty collection for streets
        $streets = collect();
        // Loop through the dataRoadInventory
        foreach ($dataRoadInventory as $data) {
            // Check the jenisPerkerasan value
            if ($data->jenisPerkerasan == 1) {
                // If jenisPerkerasan is 1 (Asphalt), get the related AsphaltStreetData
                $street = AsphaltStreetData::find($data->road_id);
                if ($street) {
                    $streets->push($street);  // Add the asphalt street to the collection
                }
            } elseif ($data->jenisPerkerasan == 5) {
                // If jenisPerkerasan is 5 (Soil), get the related SoilsStreetData
                $street = SoilsStreetData::find($data->road_id);
                if ($street) {
                    $streets->push($street);  // Add the soil street to the collection
                }
            }
        }

        // Return the streets collection
        return $streets;
    }
}
