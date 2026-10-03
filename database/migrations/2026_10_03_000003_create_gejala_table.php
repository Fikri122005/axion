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
        Schema::create('gejala', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')
                ->nullable()
                ->constrained('kategori_hewan', 'id', 'fk_gejala_kategori')
                ->nullOnDelete()
                ->cascadeOnUpdate()
                ->index('idx_gejala_kategori');
            $table->string('kode_gejala', 10)->unique();
            $table->text('nama_gejala');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gejala');
    }
};
