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
        Schema::create('detail_diagnosa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('riwayat_id')
                ->constrained('riwayat_diagnosa', 'id', 'fk_detail_riwayat')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('penyakit_id')
                ->constrained('penyakit', 'id', 'fk_detail_penyakit')
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
                ->index('idx_detail_penyakit');
            $table->foreignId('gejala_id')
                ->constrained('gejala', 'id', 'fk_detail_gejala')
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
                ->index('idx_detail_gejala');
            $table->decimal('cf_user', 3, 2);
            $table->decimal('cf_pakar', 3, 2);
            $table->decimal('cf_gejala', 5, 4);
            $table->timestamps();

            $table->unique(['riwayat_id', 'penyakit_id', 'gejala_id'], 'unique_detail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_diagnosa');
    }
};
