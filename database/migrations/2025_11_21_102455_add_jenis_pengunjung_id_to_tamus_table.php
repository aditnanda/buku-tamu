<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->foreignId('jenis_pengunjung_id')
                ->nullable()
                ->after('nama') // sesuaikan posisi kalau mau
                ->constrained('jenis_pengunjungs')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->dropConstrainedForeignId('jenis_pengunjung_id');
        });
    }
};
