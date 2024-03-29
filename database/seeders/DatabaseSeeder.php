<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SexoTableSeeder::class,
        ]);
        $this->call([
            RoleTableSeeder::class,
        ]);
         $this->call([
            UserAdminTableSeeder::class,
        ]);
        $this->call([
            fechasSolicitudesSeeder::class,
        ]);
        
        $this->call([
            preguntasPlanDeAccionSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
