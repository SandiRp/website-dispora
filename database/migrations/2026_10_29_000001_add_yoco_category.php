<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('categories')->updateOrInsert(
            ['slug' => 'yoco'],
            [
                'name' => 'YOCO',
                'type' => 'post',
                'description' => 'Berita dan informasi terkait Yocopreneur.',
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );
    }

    public function down(): void
    {
        $category = DB::table('categories')->where('slug', 'yoco')->where('type', 'post')->first();
        if ($category && !DB::table('posts')->where('category_id', $category->id)->exists()) {
            DB::table('categories')->where('id', $category->id)->delete();
        }
    }
};
