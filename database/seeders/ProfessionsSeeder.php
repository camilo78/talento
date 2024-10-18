<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profession;

class ProfessionsSeeder extends Seeder
{
    public function run()
    {
        // Profesiones y especialidades
        $professions = [
            // Grados Académicos Básicos (sin especialidad)
            ['profession' => 'Primaria', 'specialty' => null, 'other_studies' => null],
            ['profession' => 'Ciclo Común', 'specialty' => null, 'other_studies' => null],
            ['profession' => 'Bachillerato en Humanidades', 'specialty' => null, 'other_studies' => null],
            ['profession' => 'Perito Mercantil', 'specialty' => null, 'other_studies' => null],

            // Profesiones asistenciales (sin especialidad)
            ['profession' => 'Médico General', 'specialty' => null, 'other_studies' => null],
            ['profession' => 'Enfermera Auxiliar', 'specialty' => null, 'other_studies' => null],
            ['profession' => 'Licenciada en Enfermería', 'specialty' => null, 'other_studies' => null],
            ['profession' => 'Técnico Anestesista', 'specialty' => null, 'other_studies' => null],
            ['profession' => 'Técnico en Radiología', 'specialty' => null, 'other_studies' => null],
            ['profession' => 'Técnico de Laboratorio Clínico', 'specialty' => null, 'other_studies' => null],
            ['profession' => 'Psicólogo', 'specialty' => null, 'other_studies' => null],
            ['profession' => 'Fisioterapeuta', 'specialty' => null, 'other_studies' => null],

            // Profesiones administrativas (sin especialidad)
            ['profession' => 'Administrador de Hospital', 'specialty' => null, 'other_studies' => null],
            ['profession' => 'Contador', 'specialty' => null, 'other_studies' => null],
            ['profession' => 'Secretario Administrativo', 'specialty' => null, 'other_studies' => null],
            ['profession' => 'Trabajador Social', 'specialty' => null, 'other_studies' => null],
            ['profession' => 'Asistente Administrativo', 'specialty' => null, 'other_studies' => null],

            // Otras profesiones relacionadas (sin especialidad)
            ['profession' => 'Bioquímico Clínico', 'specialty' => null, 'other_studies' => null],
            ['profession' => 'Farmacéutico', 'specialty' => null, 'other_studies' => null],
            ['profession' => 'Nutricionista', 'specialty' => null, 'other_studies' => null],
            ['profession' => 'Archivista Médico', 'specialty' => null, 'other_studies' => null],

            // Especialidades médicas relacionadas con 'Médico General'
            ['profession' => 'Médico General', 'specialty' => 'Cardiología', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Pediatría', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Ginecología', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Dermatología', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Neurología', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Oncología', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Psiquiatría', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Neumología', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Oftalmología', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Traumatología', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Geriatría', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Endocrinología', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Gastroenterología', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Nefrología', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Reumatología', 'other_studies' => null],

            // Especialidades adicionales relacionadas con 'Médico General'
            ['profession' => 'Médico General', 'specialty' => 'Medicina Interna', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Anestesiología', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Cirugía General', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Cirugía Vascular', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Gineco-Obstetricia', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Urología', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Hematología', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Infectología', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Neurocirugía', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Radiología', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Otorrinolaringología', 'other_studies' => null],

            // Nuevas especialidades
            ['profession' => 'Médico General', 'specialty' => 'Epidemiología', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Medicina Familiar', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Medicina del Deporte', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Medicina del Trabajo', 'other_studies' => null],
            ['profession' => 'Médico General', 'specialty' => 'Toxicología', 'other_studies' => null],
        ];

        // Insertar profesiones y especialidades en la base de datos
        foreach ($professions as $profession) {
            Profession::create($profession);
        }
    }
}
