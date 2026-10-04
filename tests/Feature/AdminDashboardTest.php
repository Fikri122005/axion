<?php

namespace Tests\Feature;

use App\Models\KategoriHewan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    /**
     * Test that the AdminLTE dashboard page loads successfully with database stats.
     */
    public function test_admin_dashboard_can_be_rendered(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
        $response->assertSee('Kategori Hewan');
        $response->assertSee('Data Penyakit');
        $response->assertSee('Basis Pengetahuan');
    }

    public function test_kategori_hewan_page_can_be_rendered(): void
    {
        $response = $this->get(route('admin.kategori'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.kategori.index');
        $response->assertSee('Daftar Kategori Hewan');
        $response->assertSee('Tambah Kategori');
    }

    public function test_kategori_hewan_can_be_created(): void
    {
        $response = $this->post(route('admin.kategori.store'), [
            'nama_kategori' => 'Kuda',
            'deskripsi' => 'Hewan mamalia berkuku ganjil',
        ]);

        $response->assertRedirect(route('admin.kategori'));
        $this->assertDatabaseHas('kategori_hewan', [
            'nama_kategori' => 'Kuda',
            'slug' => 'kuda',
        ]);
    }

    public function test_kategori_hewan_can_be_updated(): void
    {
        $kategori = KategoriHewan::create([
            'nama_kategori' => 'Hamster',
            'slug' => 'hamster',
            'deskripsi' => 'Hewan pengerat peliharaan',
        ]);

        $response = $this->put(route('admin.kategori.update', $kategori), [
            'nama_kategori' => 'Hamster Lucu',
            'deskripsi' => 'Deskripsi baru',
        ]);

        $response->assertRedirect(route('admin.kategori'));
        $this->assertDatabaseHas('kategori_hewan', [
            'id' => $kategori->id,
            'nama_kategori' => 'Hamster Lucu',
        ]);
    }

    public function test_kategori_hewan_can_be_deleted(): void
    {
        $kategori = KategoriHewan::create([
            'nama_kategori' => 'Reptil',
            'slug' => 'reptil',
        ]);

        $response = $this->delete(route('admin.kategori.destroy', $kategori));

        $response->assertRedirect(route('admin.kategori'));
        $this->assertDatabaseMissing('kategori_hewan', [
            'id' => $kategori->id,
        ]);
    }

    public function test_penyakit_page_can_be_rendered(): void
    {
        $response = $this->get(route('admin.penyakit'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.penyakit.index');
        $response->assertSee('Daftar Penyakit Hewan');
    }

    public function test_gejala_page_can_be_rendered(): void
    {
        $response = $this->get(route('admin.gejala'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.gejala.index');
        $response->assertSee('Daftar Gejala Klinis');
    }

    public function test_basis_pengetahuan_page_can_be_rendered(): void
    {
        $response = $this->get(route('admin.basis-pengetahuan'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.basis-pengetahuan.index');
        $response->assertSee('Basis Pengetahuan');
    }

    public function test_bobot_keyakinan_page_can_be_rendered(): void
    {
        $response = $this->get(route('admin.bobot-keyakinan'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.bobot-keyakinan.index');
        $response->assertSee('Bobot Keyakinan Certainty Factor');
    }

    public function test_riwayat_diagnosa_page_can_be_rendered(): void
    {
        $response = $this->get(route('admin.riwayat'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.riwayat-diagnosa.index');
        $response->assertSee('Riwayat & Laporan Diagnosa');
    }
}
