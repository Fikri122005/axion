<?php

namespace Database\Seeders;

use App\Models\Gejala;
use App\Models\KategoriHewan;
use Illuminate\Database\Seeder;

class GejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kucing = KategoriHewan::where('slug', 'kucing')->first();
        $anjing = KategoriHewan::where('slug', 'anjing')->first();

        $gejalas = [
            [
                'kategori_id' => $kucing?->id,
                'kode_gejala' => 'G001',
                'nama_gejala' => 'Gatal hebat dan sering menggaruk',
            ],
            [
                'kategori_id' => $kucing?->id,
                'kode_gejala' => 'G002',
                'nama_gejala' => 'Bulu rontok dan muncul area botak',
            ],
            [
                'kategori_id' => $kucing?->id,
                'kode_gejala' => 'G003',
                'nama_gejala' => 'Keropeng atau kerak pada telinga/wajah',
            ],
            [
                'kategori_id' => null,
                'kode_gejala' => 'G004',
                'nama_gejala' => 'Muntah berulang',
            ],
            [
                'kategori_id' => null,
                'kode_gejala' => 'G005',
                'nama_gejala' => 'Diare',
            ],
            [
                'kategori_id' => null,
                'kode_gejala' => 'G006',
                'nama_gejala' => 'Nafsu makan hilang',
            ],
            [
                'kategori_id' => null,
                'kode_gejala' => 'G007',
                'nama_gejala' => 'Lesu dan lemas',
            ],
            [
                'kategori_id' => null,
                'kode_gejala' => 'G008',
                'nama_gejala' => 'Demam',
            ],
            [
                'kategori_id' => $anjing?->id,
                'kode_gejala' => 'G009',
                'nama_gejala' => 'Batuk',
            ],
            [
                'kategori_id' => $anjing?->id,
                'kode_gejala' => 'G010',
                'nama_gejala' => 'Keluar cairan/ingus dari mata dan hidung',
            ],
        ];

        foreach ($gejalas as $g) {
            Gejala::firstOrCreate(
                ['kode_gejala' => $g['kode_gejala']],
                $g
            );
        }
    }
}
