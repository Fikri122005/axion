<?php

namespace Database\Seeders;

use App\Models\BobotKeyakinan;
use Illuminate\Database\Seeder;

class BobotKeyakinanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bobots = [
            ['label' => 'Tidak', 'nilai_cf' => 0.00, 'urutan' => 1],
            ['label' => 'Tidak tahu', 'nilai_cf' => 0.20, 'urutan' => 2],
            ['label' => 'Sedikit yakin', 'nilai_cf' => 0.40, 'urutan' => 3],
            ['label' => 'Cukup yakin', 'nilai_cf' => 0.60, 'urutan' => 4],
            ['label' => 'Yakin', 'nilai_cf' => 0.80, 'urutan' => 5],
            ['label' => 'Sangat yakin', 'nilai_cf' => 1.00, 'urutan' => 6],
        ];

        foreach ($bobots as $bobot) {
            BobotKeyakinan::firstOrCreate(
                ['label' => $bobot['label']],
                $bobot
            );
        }
    }
}
