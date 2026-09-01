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
        Schema::create('skm_data', function (Blueprint $table) {
            $table->id();
            $table->string('year'); // Tahun Pelaksanaan
            $table->string('period')->nullable(); // Periode (Misal: Semester 1, Triwulan 1)
            $table->decimal('index_value', 5, 2); // Nilai Indeks, misal 85.50
            $table->string('category')->nullable(); // Kategori (Sangat Baik, Baik, dll)
            $table->string('document_path')->nullable(); // Laporan PDF jika ada
            $table->boolean('is_published')->default(true); // Status publikasi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skm_data');
    }
};
