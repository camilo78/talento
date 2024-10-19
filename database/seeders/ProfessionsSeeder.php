<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profession;

class ProfessionsSeeder extends Seeder
{
    public function run()
    {
        // Profesiones
        $professions = [
            // Grados Académicos Básicos
            ['profession' => 'Primaria'],
            ['profession' => 'Ciclo Común'],
            ['profession' => 'Bachillerato en Humanidades'],
            ['profession' => 'Perito Mercantil'],

            // Profesiones asistenciales
            ['profession' => 'Médico General'],
            ['profession' => 'Enfermera Auxiliar'],
            ['profession' => 'Licenciada en Enfermería'],
            ['profession' => 'Técnico Anestesista'],
            ['profession' => 'Técnico en Radiología'],
            ['profession' => 'Técnico de Laboratorio Clínico'],
            ['profession' => 'Psicólogo'],
            ['profession' => 'Fisioterapeuta'],

            // Profesiones administrativas
            ['profession' => 'Licenciado en Administración de Empresas'],
            ['profession' => 'Contador'],
            ['profession' => 'Secretario Administrativo'],
            ['profession' => 'Trabajador Social'],
            ['profession' => 'Asistente Administrativo'],

            // Otras profesiones relacionadas
            ['profession' => 'Bioquímico Clínico'],
            ['profession' => 'Farmacéutico'],
            ['profession' => 'Nutricionista'],
            ['profession' => 'Ingeniero Civíl'],
        ];
        // Insertar profesiones y especialidades en la base de datos
        foreach ($professions as $profession) {
            Profession::create($profession);
        }
        // Aquí puedes continuar con la lógica para insertar las profesiones en la base de datos.
    }
}
