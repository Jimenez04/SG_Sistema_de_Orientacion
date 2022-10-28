<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        DB::table('users')->insert([
            'id' => 0,
            'email_verified_at' => '2022-08-01 20:08:30',
            'email' => 'ISAAC.JIMENEZALFARO@ucr.ac.cr',
            'password' => '$2y$10$Lj7gn4RH6w4OCXfVrpLXrOMuC0zp4KChGStRvh46An8flht5lv.gm', //123456789
            'role_id' => 1
        ]);
        DB::table('personas')->insert([
            'cedula' => '123456789',
            'nombre1' => 'Isaac',
            'nombre2' => '',
            'apellido1' => 'Coordinador',
            'apellido2' => 'Orientador',
            'fecha_Nacimiento' => '1999-10-01', 
            'sexo_id' => 1,
            'user_id' => 0,
        ]);
        DB::table('emails')->insert([
            'email' => "ISAAC.JIMENEZALFARO@ucr.ac.cr",
            'persona_cedula' => "123456789",
        ]);
        DB::table('contactos')->insert([
            'numero' => "123456789",
            'persona_cedula' => "123456789",
        ]);

        DB::table('administradors')->insert([
            'persona_cedula' => "123456789",
            'created_at' => Carbon::now(),
        ]);
    }
}
