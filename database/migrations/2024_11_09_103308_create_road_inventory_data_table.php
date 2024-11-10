<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('road_inventory_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('road_inventory_id');
            $table->string('dariSta');
            $table->string('keSta');
            $table->string('tipeJalan');
            $table->string('median');
            $table->string('lapisPermukaanTahun');
            $table->string('lapisPermukaanJenis');
            $table->string('lapisPermukaanLebar');
            $table->string('bahuKiriJenis');
            $table->string('bahuKiriLebar');
            $table->string('bahuKiriTahun');
            $table->string('bahuKananJenis');
            $table->string('bahuKananLebar');
            $table->string('bahuKananTahun');
            $table->string('saluranKiriJenis');
            $table->string('saluranKiriLebar');
            $table->string('saluranKiriDalam');
            $table->string('saluranKananJenis');
            $table->string('saluranKananLebar');
            $table->string('saluranKananDalam');
            $table->string('terrainKiri');
            $table->string('terrainKanan');
            $table->string('alinyemenVertical');
            $table->string('alinyemenHorizontal');
            $table->string('tataKiri');
            $table->string('tataKanan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('road_inventory_data');
    }
};
