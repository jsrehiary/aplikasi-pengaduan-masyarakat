<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('laporans')->insert([
                'id_laporan' => $this->generateRandom(),
                'category_id' => rand(1, 7), 
                'nama_laporan' => 'Random Name ' . ($i + 1),
                'detail' => 'Random Detail ' . ($i + 1),
                'alamat' => 'Random Address ' . ($i + 1),
                'foto' => 'path/to/your/photo' . ($i + 1) . '.jpg', 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
    protected function generateRandom(): string
    {
        return 'LAPOR_' . now()->timestamp . '_' . Str::random(5);
    }
}
