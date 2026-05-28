<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registrant extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'ku',
        'tgl_lahir',
        'jk',
        'asal_swimschool',
        'kategori_lomba',
        'foto',
    ];

    protected function casts(): array
    {
        return [
            'tgl_lahir' => 'date',
        ];
    }
}
