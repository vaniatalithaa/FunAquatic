<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CollectiveRegistration extends Model
{
    protected $fillable = [
        'nama_pelatih',
        'nama_swimschool',
        'email',
        'whatsapp',
        'file_excel',
        'file_akte',
        'jumlah_peserta',
        'status',
        'bukti_pembayaran',
    ];

    public function registrants(): HasMany
    {
        return $this->hasMany(Registrant::class);
    }
}