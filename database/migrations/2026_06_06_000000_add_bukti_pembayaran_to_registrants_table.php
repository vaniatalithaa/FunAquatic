<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('registrants', 'bukti_pembayaran')) {
            return;
        }

        Schema::table('registrants', function (Blueprint $table) {
            $table->string('bukti_pembayaran')->nullable()->after('foto');
        });
    }

    public function down(): void
    {
        if (! Schema::hasColumn('registrants', 'bukti_pembayaran')) {
            return;
        }

        Schema::table('registrants', function (Blueprint $table) {
            $table->dropColumn('bukti_pembayaran');
        });
    }
};
