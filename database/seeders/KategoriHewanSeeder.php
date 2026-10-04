<?php

namespace Database\Seeders;

use App\Models\KategoriHewan;
use Illuminate\Database\Seeder;

class KategoriHewanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'nama_kategori' => 'Kucing',
                'slug' => 'kucing',
                'deskripsi' => 'Kucing peliharaan',
            ],
            [
                'nama_kategori' => 'Anjing',
                'slug' => 'anjing',
                'deskripsi' => 'Anjing peliharaan',
            ],
            [
                'nama_kategori' => 'Hewan Ternak',
                'slug' => 'hewan-ternak',
                'deskripsi' => 'Sapi, kambing, domba, dan sejenisnya',
            ],
        ];

        foreach ($categories as $cat) {
            KategoriHewan::firstOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }
    }
}
