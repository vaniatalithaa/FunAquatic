<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('pendaftar')) {
            return;
        }

        $rows = DB::table('pendaftar')
            ->select([
                'nama_lengkap',
                'ku',
                'tgl_lahir',
                'jk',
                'asal_swimschool',
                'kategori_lomba',
            ])
            ->get();

        foreach ($rows as $row) {
            DB::table('registrants')->updateOrInsert([
                'nama_lengkap' => $row->nama_lengkap,
                'tgl_lahir' => $row->tgl_lahir,
                'kategori_lomba' => $row->kategori_lomba,
            ], [
                'ku' => $row->ku,
                'jk' => $row->jk,
                'asal_swimschool' => $row->asal_swimschool,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        //
    }
};
