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
        Schema::create('road_inventories', function (Blueprint $table) {
            $table->id();
            $table->string('namaProvinsi');
            $table->string('kabupaten');
            $table->string('noProvinsi');
            $table->string('DRP')->nullable();
            $table->string('LRP')->nullable();
            $table->string('CHN')->nullable();
            $table->string('noRuas');
            $table->string('namaRuas');
            $table->string('dariPatokKm');
            $table->string('kePatokKm');
            $table->string('surveyor');
            $table->string('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('road_inventories');
    }
};
