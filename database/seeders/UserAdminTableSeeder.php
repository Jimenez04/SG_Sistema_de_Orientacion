<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personas')->insert([
            'cedula' => '123456789',
            'nombre1' => 'Isaac',
            'nombre2' => '',
            'apellido1' => 'Coordinador',
            'apellido2' => 'Orientador',
            'fecha_Nacimiento' => '1999-10-01', //investigar
            'sexo_id' => 1,
        ]);
        DB::table('emails')->insert([
            'email' => "coordinador22@ucr.ac.cr",
            'persona_cedula' => "123456789",
        ]);
        DB::table('contactos')->insert([
            'numero' => "123456789",
            'persona_cedula' => "123456789",
        ]);
        DB::table('users')->insert([
            'email' => 'coordinador22@ucr.ac.cr',
            'password' => '$2y$10$Lj7gn4RH6w4OCXfVrpLXrOMuC0zp4KChGStRvh46An8flht5lv.gm', //123456789
            'role_id' => 1
        ]);
    }
}
