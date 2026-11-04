<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            // Pengenal acak dari cookie browser. Data lama tetap ada (NULL).
            $table->string('visitor_id', 64)->nullable()->after('id');

            // Satu IP bersama kini boleh punya banyak pengunjung (cookie berbeda).
            $table->dropUnique(['ip_address', 'visit_date']);
            $table->index(['ip_address', 'visit_date']);
            $table->unique(['visitor_id', 'visit_date']);
        });
    }

    public function down(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropUnique(['visitor_id', 'visit_date']);
            $table->dropIndex(['ip_address', 'visit_date']);
            $table->dropColumn('visitor_id');
            $table->unique(['ip_address', 'visit_date']);
        });
    }
};

