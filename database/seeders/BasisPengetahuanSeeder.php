<?php

namespace Database\Seeders;

use App\Models\BasisPengetahuan;
use App\Models\Gejala;
use App\Models\Penyakit;
use Illuminate\Database\Seeder;

class BasisPengetahuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rules = [
            ['kp' => 'P001', 'kg' => 'G001', 'cf' => 0.80],
            ['kp' => 'P001', 'kg' => 'G002', 'cf' => 0.60],
            ['kp' => 'P001', 'kg' => 'G003', 'cf' => 0.80],
            ['kp' => 'P002', 'kg' => 'G004', 'cf' => 0.60],
            ['kp' => 'P002', 'kg' => 'G005', 'cf' => 0.60],
            ['kp' => 'P002', 'kg' => 'G006', 'cf' => 0.40],
            ['kp' => 'P002', 'kg' => 'G007', 'cf' => 0.40],
            ['kp' => 'P002', 'kg' => 'G008', 'cf' => 0.60],
            ['kp' => 'P003', 'kg' => 'G005', 'cf' => 0.40],
            ['kp' => 'P003', 'kg' => 'G006', 'cf' => 0.40],
            ['kp' => 'P003', 'kg' => 'G008', 'cf' => 0.40],
            ['kp' => 'P003', 'kg' => 'G009', 'cf' => 0.60],
            ['kp' => 'P003', 'kg' => 'G010', 'cf' => 0.80],
        ];

        $penyakitMap = Penyakit::pluck('id', 'kode_penyakit');
        $gejalaMap = Gejala::pluck('id', 'kode_gejala');

        foreach ($rules as $rule) {
            $penyakitId = $penyakitMap[$rule['kp']] ?? null;
            $gejalaId = $gejalaMap[$rule['kg']] ?? null;

            if ($penyakitId && $gejalaId) {
                BasisPengetahuan::firstOrCreate(
                    [
                        'penyakit_id' => $penyakitId,
                        'gejala_id' => $gejalaId,
                    ],
                    [
                        'cf_pakar' => $rule['cf'],
                    ]
                );
            }
        }
    }
}
