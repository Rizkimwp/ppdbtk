<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agamas = [
            ['nama_agama' => 'Islam'],
            ['nama_agama' => 'Kristen Protestan'],
            ['nama_agama' => 'Kristen Katolik'],
            ['nama_agama' => 'Hindu'],
            ['nama_agama' => 'Buddha'],
            ['nama_agama' => 'Konghucu'],
        ];

        DB::table('agama')->insert($agamas);
    }
}