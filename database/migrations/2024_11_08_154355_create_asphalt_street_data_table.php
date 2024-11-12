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
        Schema::create('asphalt_street_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asphalt_street_id');
            $table->string('noRuas')->nullable();
            $table->string('jenisPerkerasan')->default('Aspal');
            $table->string('image')->nullable();
            $table->text('koordinat')->nullable();
            $table->string('permukaanPerkerasan');
            $table->string('kondisi');
            $table->string('penurunan');
            $table->string('tambalan');
            $table->string('dariPatok');
            $table->string('kePatok');
            $table->string('jenis');
            $table->string('lebar');
            $table->string('luas');
            $table->string('jumlahLubang');
            $table->string('ukuranLubang');
            $table->string('bekasRoda');
            $table->string('kerusakanTepiKiri');
            $table->string('kerusakanTepiKanan');
            $table->string('kondisiBahuKiri');
            $table->string('kondisiBahuKanan');
            $table->string('permukaanBahuKiri');
            $table->string('permukaanBahuKanan');
            $table->string('kondisiSaluranKiri');
            $table->string('kondisiSaluranKanan');
            $table->string('kerusakanLerengKiri');
            $table->string('kerusakanLerengKanan');
            $table->string('trotoarKiri');
            $table->string('trotoarKanan');
            $table->string('sdi')->nullable();
            $table->string('kondisiJalan')->nullable();
            $table->string('penanganan')->nullable();
            $table->string('panjang')->nullable();
            $table->string('nilaiIri')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asphalt_street_data');
    }
};
