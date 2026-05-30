<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penduduk_id')->nullable()->constrained('penduduks')->nullOnDelete();
            $table->string('nomor_surat')->unique();
            $table->string('jenis_surat');
            $table->text('keperluan')->nullable();
            $table->enum('status', ['Diajukan', 'Diproses', 'Selesai', 'Ditolak'])->default('Diajukan');
            $table->date('tanggal_surat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
