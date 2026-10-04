<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RiwayatDiagnosa extends Model
{
    use HasFactory;

    protected $table = 'riwayat_diagnosa';

    protected $fillable = [
        'user_id',
        'kategori_id',
        'nama_hewan',
        'umur_hewan',
        'keluhan_tambahan',
        'penyakit_terpilih_id',
        'nilai_cf_akhir',
        'persentase',
        'tanggal_diagnosa',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'nilai_cf_akhir' => 'float',
            'persentase' => 'float',
            'tanggal_diagnosa' => 'datetime',
        ];
    }

    /**
     * Get the user who ran the diagnosis.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the category of animal.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriHewan::class, 'kategori_id');
    }

    /**
     * Get the top selected disease.
     */
    public function penyakitTerpilih(): BelongsTo
    {
        return $this->belongsTo(Penyakit::class, 'penyakit_terpilih_id');
    }

    /**
     * Get all disease rankings for this diagnosis.
     */
    public function hasilDiagnosa(): HasMany
    {
        return $this->hasMany(HasilDiagnosa::class, 'riwayat_id');
    }

    /**
     * Get the detailed symptom calculations for this diagnosis.
     */
    public function detailDiagnosa(): HasMany
    {
        return $this->hasMany(DetailDiagnosa::class, 'riwayat_id');
    }
}
