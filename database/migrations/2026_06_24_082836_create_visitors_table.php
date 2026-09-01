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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 64); // Menyimpan IP
            $table->date('visit_date'); // Menyimpan tanggal kunjungan
            $table->text('user_agent')->nullable(); // Menyimpan info browser/perangkat
            $table->timestamps();

            // Mencegah duplikasi: 1 IP hanya dihitung 1 kali per hari
            $table->unique(['ip_address', 'visit_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
