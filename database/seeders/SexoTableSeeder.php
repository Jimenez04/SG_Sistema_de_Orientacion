<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SexoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sexos')->insert([
            'id' => "1",
            'nombre' => "Masculino",
        ]);
        DB::table('sexos')->insert([
            'id' => "2",
            'nombre' => "Femenino",
        ]);
    }
}
