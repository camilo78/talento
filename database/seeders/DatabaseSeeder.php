<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use App\Models\Profession;
use App\Models\Specialty;
use Illuminate\Database\Seeder;
use Database\Seeders\ReasonsTableSeeder;
use Database\Seeders\ProfessionsSeeder;
use Database\Seeders\DepartmentSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(ProfessionsSeeder::class);

        $user = User::create([
            'name' => 'Camilo Gabriel Alvarado Ramírez',
            'gender' => '1',
            'email' => 'camilo.alvarado0501@gmail.com',
            'dni' => '0501197809263',
            'rtn' => '05011978092632',
            'profession_id' => Profession::inRandomOrder()->first()->id,
            // Asigna una profesión aleatoria
            'functional' => 'Subdirector de Gestión de Recursos',
            'nominal' => '',
            'type' => 'Contrato',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $user = User::create([
            'name' => 'Sylvia Elaine Bardales García',
            'gender' => '1',
            'email' => 'Sylvia.bardales@gmail.com',
            'dni' => '0501197409263',
            'rtn' => '05014978092632',
            'profession_id' => Profession::inRandomOrder()->first()->id,  // Asigna una profesión aleatoria
            'functional' => 'Directora Ejecutiva',
            'nominal' => 'Médico General',
            'type' => 'Permanente',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $user->save();
        User::factory(500)->create();
        $this->call(SpecialtiesSeeder::class);

        $this->call(DepartmentSeeder::class);
       // $this->call(UserDepartmentSeeder::class);

        $this->call(ReasonsTableSeeder::class);

        // Ejemplo: Asignar usuarios a departamentos
        $users = User::all();
        $departments = Department::all();

        foreach ($users as $user) {
            // Obtener los departamentos actuales del usuario
            $userDepartments = $user->departments;

            // Si ya pertenece a un departamento
            if ($userDepartments->isNotEmpty()) {
                // Obtener el departamento actual
                $currentDepartment = $userDepartments->first();

                // Obtener el departamento padre del departamento actual
                $parentDepartment = $currentDepartment->parent_id ? $departments->find($currentDepartment->parent_id) : null;

                // Si el usuario ya pertenece a ambos (el departamento y su padre), no asignar más
                if ($userDepartments->count() >= 2 || ($parentDepartment && $userDepartments->contains($parentDepartment))) {
                    continue; // No hacer nada si ya pertenece al máximo de departamentos permitidos
                }

                // Si solo pertenece a un departamento, asignar el departamento padre (si existe)
                if ($parentDepartment && !$userDepartments->contains($parentDepartment)) {
                    $user->departments()->attach($parentDepartment->id);
                }
            } else {
                // Si no pertenece a ningún departamento, asignar uno aleatoriamente
                $department = $departments->random();

                // Asignar el departamento aleatoriamente
                $user->departments()->attach($department->id);

                // Si ese departamento tiene un padre, también asignarlo
                if ($department->parent_id) {
                    $user->departments()->attach($department->parent_id);
                }
            }
        }


    }
}
