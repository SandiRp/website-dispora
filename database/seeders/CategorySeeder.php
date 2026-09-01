<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documentCategories = ['RENJA', 'RENSTRA', 'LKJIP', 'PK'];
        $postCategories = ['OLAHRAGA', 'KEPEMUDAAN', 'KEPRAMUKAAN', 'GUBERNUR', 'UMUM'];

        foreach ($documentCategories as $name) {
            Category::firstOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name), 'type' => 'document']
            );
        }

        foreach ($postCategories as $name) {
            Category::firstOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name), 'type' => 'post']
            );
        }
    }
}
