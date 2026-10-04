<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailDiagnosa extends Model
{
    use HasFactory;

    protected $table = 'detail_diagnosa';

    protected $fillable = [
        'riwayat_id',
        'penyakit_id',
        'gejala_id',
        'cf_user',
        'cf_pakar',
        'cf_gejala',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'cf_user' => 'float',
            'cf_pakar' => 'float',
            'cf_gejala' => 'float',
        ];
    }

    /**
     * Get the riwayat diagnosa record.
     */
    public function riwayat(): BelongsTo
    {
        return $this->belongsTo(RiwayatDiagnosa::class, 'riwayat_id');
    }

    /**
     * Get the disease.
     */
    public function penyakit(): BelongsTo
    {
        return $this->belongsTo(Penyakit::class, 'penyakit_id');
    }

    /**
     * Get the symptom.
     */
    public function gejala(): BelongsTo
    {
        return $this->belongsTo(Gejala::class, 'gejala_id');
    }
}
