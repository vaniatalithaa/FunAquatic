<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('registrants', 'foto')) {
            return;
        }

        Schema::table('registrants', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('kategori_lomba');
        });
    }

    public function down(): void
    {
        if (! Schema::hasColumn('registrants', 'foto')) {
            return;
        }

        Schema::table('registrants', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
};
