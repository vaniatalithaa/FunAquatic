<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'collective_registration_id',
    ];

    protected function casts(): array
    {
        return [
            'tgl_lahir' => 'date',
        ];
    }

    // Relasi ke pendaftaran kolektif
    public function collectiveRegistration(): BelongsTo
    {
        return $this->belongsTo(CollectiveRegistration::class);
    }
}
