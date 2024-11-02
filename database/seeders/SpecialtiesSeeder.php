<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Specialty;

class SpecialtiesSeeder extends Seeder
{
    public function run()
    {
        // Definimos las especialidades
        $specialties = [
            ['name' => 'Cardiología', 'profession_id' => 5],
            ['name' => 'Pediatría', 'profession_id' => 5],
            ['name' => 'Ginecología', 'profession_id' => 5],
            ['name' => 'Dermatología', 'profession_id' => 5],
            ['name' => 'Neurología', 'profession_id' => 5],
            ['name' => 'Oncología', 'profession_id' => 5],
            ['name' => 'Psiquiatría', 'profession_id' => 5],
            ['name' => 'Neumología', 'profession_id' => 5],
            ['name' => 'Oftalmología', 'profession_id' => 5],
            ['name' => 'Traumatología', 'profession_id' => 5],
            ['name' => 'Medicina Interna', 'profession_id' => 5],
            ['name' => 'Anestesiología', 'profession_id' => 5],
            ['name' => 'Cirugía General', 'profession_id' => 5],
            ['name' => 'Cirugía Vascular', 'profession_id' => 5],
            ['name' => 'Gineco-Obstetricia', 'profession_id' => 5],
            ['name' => 'Urología', 'profession_id' => 5],
            ['name' => 'Hematología', 'profession_id' => 5],
            ['name' => 'Infectología', 'profession_id' => 5],
            ['name' => 'Neurocirugía', 'profession_id' => 5],
            ['name' => 'Radiología', 'profession_id' => 5],
            ['name' => 'Medicina Familiar', 'profession_id' => 5],
            ['name' => 'Medicina del Deporte', 'profession_id' => 5],
            ['name' => 'Medicina del Trabajo', 'profession_id' => 5],
            ['name' => 'Toxicología', 'profession_id' => 5],
            ['name' => 'Endocrinología', 'profession_id' => 5],
            ['name' => 'Gastroenterología', 'profession_id' => 5],
            ['name' => 'Nefrología', 'profession_id' => 5],
            ['name' => 'Reumatología', 'profession_id' => 5],
        ];

        // Insertamos las especialidades si no existen
        foreach ($specialties as $specialty) {
            Specialty::firstOrCreate($specialty);
        }

        // Obtenemos los usuarios cuya profesión es "médico general" (id 5)
        $users = User::where('profession_id', 5)->get();

        // Asignamos una especialidad aleatoria a cada usuario
        foreach ($users as $user) {
            // Seleccionamos una especialidad aleatoria de la lista
            $randomSpecialty = Specialty::where('profession_id', 5)->inRandomOrder()->first();

            // Asignamos la especialidad al usuario
            $user->specialty_id = $randomSpecialty->id;
            $user->save();
        }
    }
}
