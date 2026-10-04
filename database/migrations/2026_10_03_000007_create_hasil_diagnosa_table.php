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
        Schema::create('hasil_diagnosa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('riwayat_id')
                ->constrained('riwayat_diagnosa', 'id', 'fk_hasil_riwayat')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('penyakit_id')
                ->constrained('penyakit', 'id', 'fk_hasil_penyakit')
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
                ->index('idx_hasil_penyakit');
            $table->decimal('nilai_cf', 5, 4);
            $table->decimal('persentase', 5, 2);
            $table->unsignedTinyInteger('ranking');
            $table->timestamps();

            $table->unique(['riwayat_id', 'penyakit_id'], 'unique_hasil');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_diagnosa');
    }
};
