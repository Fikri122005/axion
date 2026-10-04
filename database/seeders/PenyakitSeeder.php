<?php

namespace Database\Seeders;

use App\Models\KategoriHewan;
use App\Models\Penyakit;
use Illuminate\Database\Seeder;

class PenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kucing = KategoriHewan::where('slug', 'kucing')->first();
        $anjing = KategoriHewan::where('slug', 'anjing')->first();

        $penyakits = [
            [
                'kategori_id' => $kucing?->id,
                'kode_penyakit' => 'P001',
                'nama_penyakit' => 'Scabies (Kudis)',
                'deskripsi' => 'Infestasi tungau pada kulit yang menimbulkan gatal dan kerontokan bulu.',
                'solusi' => 'Segera konsultasikan ke dokter hewan untuk pemberian obat anti-tungau; pisahkan dari hewan lain dan bersihkan lingkungan.',
            ],
            [
                'kategori_id' => $kucing?->id,
                'kode_penyakit' => 'P002',
                'nama_penyakit' => 'Feline Panleukopenia',
                'deskripsi' => 'Infeksi virus pada kucing yang menyerang saluran cerna dan sistem imun.',
                'solusi' => 'Kondisi serius, segera bawa ke dokter hewan; pisahkan dari kucing lain dan pastikan vaksinasi lengkap.',
            ],
            [
                'kategori_id' => $anjing?->id,
                'kode_penyakit' => 'P003',
                'nama_penyakit' => 'Canine Distemper',
                'deskripsi' => 'Infeksi virus pada anjing yang menyerang saluran napas, cerna, dan saraf.',
                'solusi' => 'Kondisi serius, segera bawa ke dokter hewan; isolasi hewan dan lengkapi vaksinasi.',
            ],
        ];

        foreach ($penyakits as $p) {
            Penyakit::firstOrCreate(
                ['kode_penyakit' => $p['kode_penyakit']],
                $p
            );
        }
    }
}
