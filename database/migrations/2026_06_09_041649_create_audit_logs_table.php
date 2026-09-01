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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Tetap mencatat log meski user dihapus
            $table->string('activity'); // Contoh: "Menerbitkan Berita", "Mengubah Dokumen SOP"
            $table->string('model_type')->nullable(); // Nama Class Model (e.g., App\Models\Post)
            $table->unsignedBigInteger('model_id')->nullable(); // ID data yang dimodifikasi
            $table->json('old_values')->nullable(); // Data sebelum diubah
            $table->json('new_values')->nullable(); // Data setelah diubah
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable(); // Informasi browser/perangkat
            $table->timestamp('created_at')->useCurrent(); // Log tidak boleh di-update, hanya di-insert
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
