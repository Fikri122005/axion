<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BasisPengetahuan extends Model
{
    use HasFactory;

    protected $table = 'basis_pengetahuan';

    protected $fillable = [
        'penyakit_id',
        'gejala_id',
        'cf_pakar',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'cf_pakar' => 'float',
        ];
    }

    /**
     * Get the disease for this rule.
     */
    public function penyakit(): BelongsTo
    {
        return $this->belongsTo(Penyakit::class, 'penyakit_id');
    }

    /**
     * Get the symptom for this rule.
     */
    public function gejala(): BelongsTo
    {
        return $this->belongsTo(Gejala::class, 'gejala_id');
    }
}
