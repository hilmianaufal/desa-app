<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            $table->foreignId('kartu_keluarga_id')
                ->nullable()
                ->after('id')
                ->constrained('kartu_keluargas')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            $table->dropConstrainedForeignId('kartu_keluarga_id');
        });
    }
};