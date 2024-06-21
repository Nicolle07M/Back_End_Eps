<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadSeeder extends Seeder
{
    public function run()
    {
        DB::table('especialidades')->insert([
            ['name' => 'Cardiología'],
            ['name' => 'Dermatología'],
            ['name' => 'Neurología'],
            // Agrega más especialidades según sea necesario
        ]);
    }
}