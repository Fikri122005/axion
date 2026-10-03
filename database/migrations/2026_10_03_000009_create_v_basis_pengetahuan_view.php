<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('DROP VIEW IF EXISTS `v_basis_pengetahuan`');
        DB::statement('
            CREATE VIEW `v_basis_pengetahuan` AS
            SELECT
                bp.id,
                k.nama_kategori,
                p.kode_penyakit,
                p.nama_penyakit,
                g.kode_gejala,
                g.nama_gejala,
                bp.cf_pakar
            FROM basis_pengetahuan bp
            JOIN penyakit p ON p.id = bp.penyakit_id
            JOIN gejala g ON g.id = bp.gejala_id
            JOIN kategori_hewan k ON k.id = p.kategori_id
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS `v_basis_pengetahuan`');
    }
};
