<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BobotKeyakinan extends Model
{
    use HasFactory;

    protected $table = 'bobot_keyakinan';

    protected $fillable = [
        'label',
        'nilai_cf',
        'urutan',
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
            'urutan' => 'integer',
        ];
    }
}
