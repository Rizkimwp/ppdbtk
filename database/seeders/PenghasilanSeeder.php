<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenghasilanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penghasilan = [
            'Kurang dari Rp. 1.000.000',
            'Rp. 1.000.000 - Rp. 2.000.000',
            'Rp. 2.000.001 - Rp. 3.000.000',
            'Rp. 3.000.001 - Rp. 5.000.000',
            'Rp. 5.000.001 - Rp. 10.000.000',
            'Lebih dari Rp. 10.000.000',
        ];

        foreach ($penghasilan as $income) {
            DB::table('penghasilan')->insert([
                'nama' => $income,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}