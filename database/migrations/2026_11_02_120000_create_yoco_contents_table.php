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
        Schema::create('yoco_contents', function (Blueprint $table) {
            $table->id();
            $table->string('type', 30)->index(); // 'sosialisasi', 'advokasi', 'marketing'
            $table->string('title');
            $table->text('content');
            $table->string('image_path')->nullable();
            $table->string('link_url')->nullable();
            $table->string('link_label')->nullable()->default('Selengkapnya');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yoco_contents');
    }
};

