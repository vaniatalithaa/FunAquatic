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
    'email_orangtua',
    'no_hp_orangtua',
    'asal_swimschool',
    'kategori_lomba',
    'foto',
    'bukti_pembayaran',
];

    protected function casts(): array
    {
        return [
            'tgl_lahir' => 'date',
        ];
    }
}
