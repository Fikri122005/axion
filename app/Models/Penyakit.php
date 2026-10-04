<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penyakit extends Model
{
    use HasFactory;

    protected $table = 'penyakit';

    protected $fillable = [
        'kategori_id',
        'kode_penyakit',
        'nama_penyakit',
        'deskripsi',
        'penyebab',
        'pencegahan',
        'solusi',
        'gambar',
    ];

    /**
     * Get the category that owns the penyakit.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriHewan::class, 'kategori_id');
    }

    /**
     * Get the basis pengetahuan entries for this penyakit.
     */
    public function basisPengetahuan(): HasMany
    {
        return $this->hasMany(BasisPengetahuan::class, 'penyakit_id');
    }

    /**
     * Get the symptoms (gejala) associated with this penyakit.
     */
    public function gejala(): BelongsToMany
    {
        return $this->belongsToMany(Gejala::class, 'basis_pengetahuan', 'penyakit_id', 'gejala_id')
            ->withPivot('cf_pakar')
            ->withTimestamps();
    }

    /**
     * Get the hasil diagnosa records for this penyakit.
     */
    public function hasilDiagnosa(): HasMany
    {
        return $this->hasMany(HasilDiagnosa::class, 'penyakit_id');
    }

    /**
     * Get the riwayat diagnosa where this penyakit is chosen.
     */
    public function riwayatDiagnosa(): HasMany
    {
        return $this->hasMany(RiwayatDiagnosa::class, 'penyakit_terpilih_id');
    }

    /**
     * Get the detail diagnosa records for this penyakit.
     */
    public function detailDiagnosa(): HasMany
    {
        return $this->hasMany(DetailDiagnosa::class, 'penyakit_id');
    }
}
