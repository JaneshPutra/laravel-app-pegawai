<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();

            // Relasi ke pegawai
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');

            // Salinan gaji pokok dari jabatan saat itu
            $table->integer('gaji_pokok');

            // Tunjangan dan potongan opsional
            $table->integer('tunjangan')->default(0);
            $table->integer('potongan')->default(0);

            // Total gaji = gaji_pokok + tunjangan - potongan
            $table->integer('total_gaji');

            // Periode gaji (misal: 2025-10-01 untuk Oktober 2025)
            $table->date('periode');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
