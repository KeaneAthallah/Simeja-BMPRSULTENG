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
        Schema::create('soils_streets', function (Blueprint $table) {
            $table->id();
            $table->string('noProvinsi');
            $table->string('namaProvinsi');
            $table->string('kabupaten');
            $table->string('noRuas');
            $table->string('namaRuas');
            $table->string('fungsi');
            $table->string('date');
            $table->string('surveyor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soils_streets');
    }
};
