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
    Schema::create('penduduks', function (Blueprint $table) {
        $table->id();
        $table->string('nik', 16)->unique();
        $table->string('no_kk', 16)->nullable();
        $table->string('nama');
        $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
        $table->string('tempat_lahir')->nullable();
        $table->date('tanggal_lahir')->nullable();
        $table->string('agama')->nullable();
        $table->string('pendidikan')->nullable();
        $table->string('pekerjaan')->nullable();
        $table->string('status_perkawinan')->nullable();
        $table->text('alamat')->nullable();
        $table->string('rt')->nullable();
        $table->string('rw')->nullable();
        $table->enum('status', ['Aktif', 'Pindah', 'Meninggal'])->default('Aktif');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};
