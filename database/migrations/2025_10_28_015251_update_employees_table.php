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
        Schema::table('employees', function (Blueprint $table) {
            // Tambahkan kolom setelah 'tanggal_masuk'
            $table->unsignedBigInteger('departemen_id')->after('tanggal_masuk');
            $table->unsignedBigInteger('jabatan_id')->after('departemen_id');

            // Set foreign key constraint (mengacu ke tabel 'departments')
            $table->foreign('departemen_id')
                ->references('id')
                ->on('departemens')
                ->onDelete('cascade');

            $table->foreign('jabatan_id')
                ->references('id')
                ->on('positions')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Hapus foreign key
            $table->dropForeign(['departemen_id']);
            $table->dropForeign(['jabatan_id']);

            // Hapus kolom
            $table->dropColumn(['departemen_id', 'jabatan_id']);
        });
    }
};