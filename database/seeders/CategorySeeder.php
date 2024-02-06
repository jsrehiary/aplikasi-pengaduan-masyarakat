<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'category_name' => 'Lingkungan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Layanan Publik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Keamanan & Ketertiban',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Infrastruktur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Kesehatan & Kebersihan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Aksesibilitas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Teknologi dan Komunikasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
