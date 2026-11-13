<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrants', function (Blueprint $table) {
            $table->foreignId('collective_registration_id')
                ->nullable()
                ->constrained('collective_registrations')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('registrants', function (Blueprint $table) {
            $table->dropConstrainedForeignId('collective_registration_id');
        });
    }
};