<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')
                ->constrained('employees')
                ->onDelete('cascade'); // relasi ke tabel employees
            $table->date('date'); // otomatis tanggal hari ini
            $table->time('clock_in')->nullable(); // jam masuk
            $table->time('clock_out')->nullable(); // jam keluar
            $table->timestamps();

            // optional: agar tidak ada duplikasi absensi per hari
            $table->unique(['employee_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
