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
        Schema::create('survey_data', function (Blueprint $table) {
            $table->id();
            $table->boolean('validasi')->default(false);
            $table->string('jalan');
            $table->string('surveyor');
            $table->string('tanggal_survey');
            $table->string('jenis_pengkerasan');
            $table->string('lat_awal');
            $table->string('long_awal');
            $table->string('lat_akhir');
            $table->string('long_akhir');
            $table->string('dari');
            $table->string('ke');
            $table->string('panjang');
            $table->string('kemiringan');
            $table->string('susunan');
            $table->string('erosi_permukaan');
            $table->string('ukuran_terbanyak');
            $table->string('tebal_lapis');
            $table->string('distribusi');
            $table->string('perkerasan_kondisi');
            $table->string('perkerasan_turunan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_data');
    }
};
