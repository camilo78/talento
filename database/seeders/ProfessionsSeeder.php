<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Database\Seeder;

class ProfessionsSeeder extends Seeder
{
    public function run()
    {
        // Profesiones comunes
        $professions = [
            // Grados Académicos
            ['profession' => 'Primaria', 'specialty' => null],
            ['profession' => 'Ciclo Común', 'specialty' => null],
            ['profession' => 'Bachillerato en Humanidades', 'specialty' => null],
            ['profession' => 'Perito Mercantil', 'specialty' => null],

            // Ingenieros
            ['profession' => 'Ingeniero Civil', 'specialty' => null],
            ['profession' => 'Ingeniero en Sistemas', 'specialty' => null],

            // Licenciados y licenciaturas
            ['profession' => 'Licenciado en Administración de Empresas', 'specialty' => null],
            ['profession' => 'Licenciada en Enfermería', 'specialty' => null],
            ['profession' => 'Enfermera Auxiliar', 'specialty' => null],
            ['profession' => 'Abogado', 'specialty' => null],

            // Profesión médica
            ['profession' => 'Médico General', 'specialty' => null],  // Médico General General general sin especialidad
            ['profession' => 'Médico General', 'specialty' => 'Cardiología'],
            ['profession' => 'Médico General', 'specialty' => 'Pediatría'],
            ['profession' => 'Médico General', 'specialty' => 'Dermatología'],
            ['profession' => 'Médico General', 'specialty' => 'Oncología'],
            ['profession' => 'Médico General', 'specialty' => 'Ginecología'],
            ['profession' => 'Médico General', 'specialty' => 'Neurología'],
            ['profession' => 'Médico General', 'specialty' => 'Psiquiatría'],
            ['profession' => 'Médico General', 'specialty' => 'Oftalmología'],
            ['profession' => 'Médico General', 'specialty' => 'Traumatología'],
            ['profession' => 'Médico General', 'specialty' => 'Neumología'],
            ['profession' => 'Médico General', 'specialty' => 'Geriatría'],
            ['profession' => 'Médico General', 'specialty' => 'Endocrinología'],
            ['profession' => 'Médico General', 'specialty' => 'Gastroenterología'],
            ['profession' => 'Médico General', 'specialty' => 'Nefrología'],
            ['profession' => 'Médico General', 'specialty' => 'Reumatología'],
            ['profession' => 'Médico General', 'specialty' => 'Otorrinolaringología'],

            // Profesines de la Salud
            ['profession' => 'Técnico Anestesista', 'specialty' => null],
            ['profession' => 'Técnico en Radiología', 'specialty' => null],


            // Otras profesiones
            ['profession' => 'Profesor', 'specialty' => null],
            ['profession' => 'Arquitecto', 'specialty' => null],
            ['profession' => 'Psicólogo', 'specialty' => null],

        ];

        // Insertar profesiones en la base de datos
        foreach ($professions as $profession) {
            Profession::create($profession);
        }
    }
}
