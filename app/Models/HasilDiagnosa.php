<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilDiagnosa extends Model
{
    use HasFactory;

    protected $table = 'hasil_diagnosa';

    protected $fillable = [
        'riwayat_id',
        'penyakit_id',
        'nilai_cf',
        'persentase',
        'ranking',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'nilai_cf' => 'float',
            'persentase' => 'float',
            'ranking' => 'integer',
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
}
