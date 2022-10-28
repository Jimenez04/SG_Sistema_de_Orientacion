<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class fechasSolicitudesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fechas_solicitudes')->insert([
            'id' => "1",
            'nombre' => "Solicitud de adecuación",
            'desde' => '2022-09-09',
            'hasta' => "2023-10-10",
        ]);
        DB::table('fechas_solicitudes')->insert([
            'id' => "2",
            'nombre' => "Plan de acción individual",
            'desde' => "2022-09-09",
            'hasta' => "2023-10-10",
        ]);
    }
}
