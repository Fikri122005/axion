<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gejala extends Model
{
    use HasFactory;

    protected $table = 'gejala';

    protected $fillable = [
        'kategori_id',
        'kode_gejala',
        'nama_gejala',
    ];

    /**
     * Get the category that owns the gejala (null for general symptoms).
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriHewan::class, 'kategori_id');
    }

    /**
     * Get the basis pengetahuan entries for this gejala.
     */
    public function basisPengetahuan(): HasMany
    {
        return $this->hasMany(BasisPengetahuan::class, 'gejala_id');
    }

    /**
     * Get the diseases associated with this gejala.
     */
    public function penyakit(): BelongsToMany
    {
        return $this->belongsToMany(Penyakit::class, 'basis_pengetahuan', 'gejala_id', 'penyakit_id')
            ->withPivot('cf_pakar')
            ->withTimestamps();
    }

    /**
     * Get detail diagnosa records for this gejala.
     */
    public function detailDiagnosa(): HasMany
    {
        return $this->hasMany(DetailDiagnosa::class, 'gejala_id');
    }
}
