<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('basis_pengetahuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penyakit_id')
                ->constrained('penyakit', 'id', 'fk_rule_penyakit')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('gejala_id')
                ->constrained('gejala', 'id', 'fk_rule_gejala')
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
                ->index('idx_rule_gejala');
            $table->decimal('cf_pakar', 3, 2);
            $table->timestamps();

            $table->unique(['penyakit_id', 'gejala_id'], 'unique_rule');
        });

        // Add check constraint for CF Pakar (0 - 1)
        if (DB::getDriverName() === 'mysql' || DB::getDriverName() === 'mariadb') {
            DB::statement('ALTER TABLE `basis_pengetahuan` ADD CONSTRAINT `chk_cf_pakar` CHECK (`cf_pakar` >= 0 AND `cf_pakar` <= 1)');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basis_pengetahuan');
    }
};
