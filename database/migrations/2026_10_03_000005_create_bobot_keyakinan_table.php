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
        Schema::create('bobot_keyakinan', function (Blueprint $table) {
            $table->id();
            $table->string('label', 50)->unique('unique_label');
            $table->decimal('nilai_cf', 3, 2);
            $table->unsignedTinyInteger('urutan')->default(0);
            $table->timestamps();
        });

        // Add check constraint for Nilai CF (0 - 1)
        if (DB::getDriverName() === 'mysql' || DB::getDriverName() === 'mariadb') {
            DB::statement('ALTER TABLE `bobot_keyakinan` ADD CONSTRAINT `chk_bobot_cf` CHECK (`nilai_cf` >= 0 AND `nilai_cf` <= 1)');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bobot_keyakinan');
    }
};
