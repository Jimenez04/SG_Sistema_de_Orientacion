<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => "1",
            'role' => "Administrador",
        ]);
        DB::table('roles')->insert([
            'id' => "2",
            'role' => "Estudiante",
        ]);
    }
}
