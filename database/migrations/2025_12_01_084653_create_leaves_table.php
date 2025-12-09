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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');

            // tanggal mulai & selesai (untuk cuti lebih dari 1 hari)
            $table->date('start_date');
            $table->date('end_date')->nullable();

            // jenis izin/cuti: izin harian, cuti tahunan, sakit, dll
            $table->enum('type', ['izin', 'cuti', 'sakit', 'lainnya'])->default('izin');

            // alasan izin
            $table->string('reason')->nullable();

            // status approval
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            // siapa yang menyetujui (relasi ke users)
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');

            // lampiran (opsional, misalnya surat dokter)
            $table->string('attachment')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
