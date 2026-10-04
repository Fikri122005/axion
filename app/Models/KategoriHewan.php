<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriHewan extends Model
{
    use HasFactory;

    protected $table = 'kategori_hewan';

    protected $fillable = [
        'nama_kategori',
        'slug',
        'deskripsi',
    ];

    /**
     * Get the penyakit for the kategori.
     */
    public function penyakit(): HasMany
    {
        return $this->hasMany(Penyakit::class, 'kategori_id');
    }

    /**
     * Get the gejala specific to this kategori.
     */
    public function gejala(): HasMany
    {
        return $this->hasMany(Gejala::class, 'kategori_id');
    }

    /**
     * Get the riwayat diagnosa for this kategori.
     */
    public function riwayatDiagnosa(): HasMany
    {
        return $this->hasMany(RiwayatDiagnosa::class, 'kategori_id');
    }
}
