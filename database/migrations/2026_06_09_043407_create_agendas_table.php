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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pembuat agenda
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            // Waktu dan Tempat
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->string('location'); // Bisa lokasi fisik atau "Virtual (Zoom/Meet)"

            // Kolom File & Link sesuai permintaan
            $table->string('attachment_path')->nullable(); // Menyimpan path file (PDF/Docx)
            $table->text('link_url')->nullable(); // Tautan pendaftaran, live streaming, dll.

            // Status Kegiatan
            $table->enum('status', ['upcoming', 'ongoing', 'completed', 'cancelled'])->default('upcoming');

            $table->timestamps();
            $table->softDeletes(); // Keamanan data jika tidak sengaja terhapus

            // Index untuk kecepatan query kalender/agenda terdekat
            $table->index(['start_date', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
