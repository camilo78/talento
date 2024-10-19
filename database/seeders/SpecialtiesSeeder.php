<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtiesSeeder extends Seeder
{
    public function run()
    {
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

        DB::table('specialties')->insert($specialties);
    }
}
