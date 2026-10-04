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
        Schema::create('riwayat_diagnosa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users', 'id', 'fk_riwayat_user')
                ->nullOnDelete()
                ->cascadeOnUpdate()
                ->index('idx_riwayat_user');
            $table->foreignId('kategori_id')
                ->constrained('kategori_hewan', 'id', 'fk_riwayat_kategori')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->string('nama_hewan', 100);
            $table->string('umur_hewan', 30)->nullable();
            $table->text('keluhan_tambahan')->nullable();
            $table->foreignId('penyakit_terpilih_id')
                ->constrained('penyakit', 'id', 'fk_riwayat_penyakit')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->decimal('nilai_cf_akhir', 5, 4);
            $table->decimal('persentase', 5, 2);
            $table->dateTime('tanggal_diagnosa')->useCurrent()->index('idx_riwayat_tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_diagnosa');
    }
};
