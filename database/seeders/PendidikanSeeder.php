<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pendidikan = [
            'Tidak Sekolah',
            'SD',
            'SMP',
            'SMA',
            'D1',
            'D2',
            'D3',
            'S1/D4',
            'S2',
            'S3',
        ];

        foreach ($pendidikan as $education) {
            DB::table('pendidikan')->insert([
                'nama' => $education,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}