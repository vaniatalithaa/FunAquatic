<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrants', function (Blueprint $table) {
            $table->string('email_orangtua')->nullable();
            $table->string('no_hp_orangtua', 20)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('registrants', function (Blueprint $table) {
            $table->dropColumn([
                'email_orangtua',
                'no_hp_orangtua'
            ]);
        });
    }
};