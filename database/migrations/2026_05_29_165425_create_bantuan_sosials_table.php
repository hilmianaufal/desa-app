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
Schema::create('bantuan_sosials', function (Blueprint $table) {
    $table->id();
    $table->foreignId('penduduk_id')->constrained('penduduks')->cascadeOnDelete();
    $table->string('jenis_bantuan');
    $table->string('periode')->nullable();
    $table->decimal('nominal', 15, 2)->nullable();
    $table->enum('status', ['Diajukan', 'Diverifikasi', 'Diterima', 'Ditolak'])->default('Diajukan');
    $table->text('keterangan')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bantuan_sosials');
    }
};
