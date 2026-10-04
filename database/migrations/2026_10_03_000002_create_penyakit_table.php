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
        Schema::create('penyakit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')
                ->constrained('kategori_hewan', 'id', 'fk_penyakit_kategori')
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
                ->index('idx_penyakit_kategori');
            $table->string('kode_penyakit', 10)->unique();
            $table->string('nama_penyakit', 150);
            $table->text('deskripsi')->nullable();
            $table->text('penyebab')->nullable();
            $table->text('pencegahan')->nullable();
            $table->text('solusi');
            $table->string('gambar', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyakit');
    }
};
