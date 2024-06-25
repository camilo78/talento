<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
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
        $user = User::create([
            'name' => 'Camilo Gabriel',
            'boss'=> '1',
            'gender'=> '1',
            'last_name' => 'Alvarado Ramírez',
            'email' => 'camilo.alvarado0501@gmail.com',
            'dni' => '0501197809263',
            'functional' => 'Subdirector de Gestión de Recursos',
            'nominal' => '',
            'type' => 'Contrato',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        Department::create([
            'name' => 'Subdirección de Recursos',
        ]);
        Department::create([
            'name' => 'Emergencia de Cirugía y Ortopedia',
        ]);
        Department::create([
            'name' => 'Emergencia de Medicina Interna',
        ]);
        Department::create([
            'name' => 'Emergencia de Gineco Obtreticia',
        ]);
        Department::create([
            'name' => 'Emergencia de Pediatría',
        ]);
        Department::create([
            'name' => 'Sala de Hospitalización de Medicina Interna Hombres',
        ]);
        Department::create([
            'name' => 'Sala de Hospitalización de Cirugía de Hombres',
        ]);
        Department::create([
            'name' => 'Sala de Hospitalización de Medicina Interna Mujeres',
        ]);
        Department::create([
            'name' => 'Sala de Hospitalización de Cirugía de Mujeres',
        ]);


        $user->department_id = '1';
        $user->save();

    }
}
