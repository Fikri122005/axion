<?php

namespace Tests\Feature;

use App\Models\BobotKeyakinan;
use App\Models\DetailDiagnosa;
use App\Models\Gejala;
use App\Models\HasilDiagnosa;
use App\Models\KategoriHewan;
use App\Models\Penyakit;
use App\Models\RiwayatDiagnosa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AxionVetDatabaseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Run seeders before each test.
     */
    protected bool $seed = true;

    /**
     * Test that seeded users exist with correct roles.
     */
    public function test_users_are_seeded_with_roles(): void
    {
        $this->assertDatabaseHas('users', [
            'email' => 'admin@axionvet.test',
            'role' => 'admin',
            'is_active' => 1,
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'pakar@axionvet.test',
            'role' => 'pakar',
            'is_active' => 1,
        ]);
    }

    /**
     * Test that animal categories, diseases, and symptoms are seeded and related.
     */
    public function test_kategori_penyakit_and_gejala_seeded(): void
    {
        $kucing = KategoriHewan::where('slug', 'kucing')->first();
        $this->assertNotNull($kucing);
        $this->assertTrue($kucing->penyakit()->count() >= 2);

        $scabies = Penyakit::where('kode_penyakit', 'P001')->first();
        $this->assertNotNull($scabies);
        $this->assertSame('kucing', $scabies->kategori->slug);
        $this->assertTrue($scabies->gejala()->count() >= 3);

        $generalSymptom = Gejala::where('kode_gejala', 'G004')->first();
        $this->assertNotNull($generalSymptom);
        $this->assertNull($generalSymptom->kategori_id);
    }

    /**
     * Test that certainty factor weights (bobot keyakinan) are seeded.
     */
    public function test_bobot_keyakinan_seeded(): void
    {
        $this->assertSame(6, BobotKeyakinan::count());
        $sangatYakin = BobotKeyakinan::where('label', 'Sangat yakin')->first();
        $this->assertNotNull($sangatYakin);
        $this->assertEquals(1.00, $sangatYakin->nilai_cf);
    }

    /**
     * Test that database view v_basis_pengetahuan exists and contains data.
     */
    public function test_v_basis_pengetahuan_view_accessible(): void
    {
        $count = DB::table('v_basis_pengetahuan')->count();
        $this->assertSame(13, $count);
    }

    /**
     * Test diagnosis records (riwayat, hasil, detail) can be created with relationships.
     */
    public function test_diagnosis_flow_records_creation(): void
    {
        $user = User::where('role', 'admin')->first();
        $kucing = KategoriHewan::where('slug', 'kucing')->first();
        $scabies = Penyakit::where('kode_penyakit', 'P001')->first();
        $gejala1 = Gejala::where('kode_gejala', 'G001')->first();

        $riwayat = RiwayatDiagnosa::create([
            'user_id' => $user?->id,
            'kategori_id' => $kucing->id,
            'nama_hewan' => 'Mimi',
            'umur_hewan' => '1 tahun',
            'keluhan_tambahan' => 'Sering menggaruk telinga',
            'penyakit_terpilih_id' => $scabies->id,
            'nilai_cf_akhir' => 0.8520,
            'persentase' => 85.20,
            'tanggal_diagnosa' => now(),
        ]);

        $hasil = HasilDiagnosa::create([
            'riwayat_id' => $riwayat->id,
            'penyakit_id' => $scabies->id,
            'nilai_cf' => 0.8520,
            'persentase' => 85.20,
            'ranking' => 1,
        ]);

        $detail = DetailDiagnosa::create([
            'riwayat_id' => $riwayat->id,
            'penyakit_id' => $scabies->id,
            'gejala_id' => $gejala1->id,
            'cf_user' => 0.80,
            'cf_pakar' => 0.80,
            'cf_gejala' => 0.6400,
        ]);

        $this->assertDatabaseHas('riwayat_diagnosa', ['id' => $riwayat->id]);
        $this->assertSame('Mimi', $riwayat->nama_hewan);
        $this->assertSame(1, $riwayat->hasilDiagnosa()->count());
        $this->assertSame(1, $riwayat->detailDiagnosa()->count());
    }
}
