<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Dirección Ejecutiva
Department::create([
    'name' => 'Dirección Ejecutiva', //1
    'user_id' => '2',
    'parent_id' => null,
]);

// Subdirecciones de la Dirección Ejecutiva
Department::create([
    'name' => 'Subdirección de Gestión de Recursos', //2
    'user_id' => '1',
    'parent_id' => 1,
]);

Department::create([
    'name' => 'Subdirección Asistencial', //3
    'user_id' => '3',
    'parent_id' => 1,
]);

Department::create([
    'name' => 'Subdirección de la Información', //4
    'user_id' => '4',
    'parent_id' => 1,
]);

// Unidades bajo la Subdirección de la Información
Department::create([
    'name' => 'Unidad de Estadística', //5
    'user_id' => '5',
    'parent_id' => 4,
]);

Department::create([
    'name' => 'Unidad de Epidemiología', //6
    'user_id' => '6',
    'parent_id' => 4,
]);

Department::create([
    'name' => 'Unidad de Cómputo', //7
    'user_id' => '7',
    'parent_id' => 4,
]);

// Departamentos bajo la Subdirección de Gestión de Recursos
Department::create([
    'name' => 'Talento Humano', //8
    'user_id' => '8',
    'parent_id' => 2,
]);

Department::create([
    'name' => 'Logística y Suministros', //9
    'user_id' => '9',
    'parent_id' => 2,
]);

Department::create([
    'name' => 'Gestión Financiera', //10
    'user_id' => '10',
    'parent_id' => 2,
]);

Department::create([
    'name' => 'Servicios Generales', //11
    'user_id' => '11',
    'parent_id' => 2,
]);

// Subdepartamentos de Logística y Suministros
Department::create([
    'name' => 'Almacén', //12
    'user_id' => '12',
    'parent_id' => 9,
]);

Department::create([
    'name' => 'Compras', //13
    'user_id' => '13',
    'parent_id' => 9,
]);

// Subdepartamentos de Gestión Financiera
Department::create([
    'name' => 'Bienes Nacionales', //14
    'user_id' => '14',
    'parent_id' => 10,
]);

Department::create([
    'name' => 'Contabilidad', //15
    'user_id' => '15',
    'parent_id' => 10,
]);

// Subdepartamentos de Servicios Generales
Department::create([
    'name' => 'Vigilancia', //16
    'user_id' => '16',
    'parent_id' => 11,
]);

Department::create([
    'name' => 'Transporte', //17
    'user_id' => '17',
    'parent_id' => 11,
]);

Department::create([
    'name' => 'Mantenimiento', //18
    'user_id' => '18',
    'parent_id' => 11,
]);

Department::create([
    'name' => 'Hostería', //19
    'user_id' => '19',
    'parent_id' => 11,
]);

// Subdepartamentos de Hostería
Department::create([
    'name' => 'Cocina', //20
    'user_id' => '20',
    'parent_id' => 19,
]);

Department::create([
    'name' => 'Lavandería', //21
    'user_id' => '21',
    'parent_id' => 19,
]);

Department::create([
    'name' => 'Limpieza', //22
    'user_id' => '22',
    'parent_id' => 19,
]);

// Departamentos bajo la Subdirección Asistencial
Department::create([
    'name' => 'Enfermería', //23
    'user_id' => '23',
    'parent_id' => 3,
]);

// Subdepartamentos de Enfermería
Department::create([
    'name' => 'Emergencia de Medicina Interna', //24
    'user_id' => '24',
    'parent_id' => 23,
]);

Department::create([
    'name' => 'Emergencia de Gineco-Obstetricia', //25
    'user_id' => '25',
    'parent_id' => 23,
]);

Department::create([
    'name' => 'Emergencia de Pediatría', //26
    'user_id' => '26',
    'parent_id' => 23,
]);

Department::create([
    'name' => 'Sala de Hospitalización Neonatal', //27
    'user_id' => '27',
    'parent_id' => 23,
]);

Department::create([
    'name' => 'Sala de Hospitalización de Pediatría', //28
    'user_id' => '28',
    'parent_id' => 23,
]);

Department::create([
    'name' => 'Sala de Hospitalización de Ginecología', //29
    'user_id' => '29',
    'parent_id' => 23,
]);

Department::create([
    'name' => 'Sala de Hospitalización de Obstetricia', //30
    'user_id' => '30',
    'parent_id' => 23,
]);

Department::create([
    'name' => 'Sala de Hospitalización de Medicina Interna Hombres', //31
    'user_id' => '31',
    'parent_id' => 23,
]);

Department::create([
    'name' => 'Sala de Hospitalización de Medicina Interna Mujeres', //32
    'user_id' => '32',
    'parent_id' => 23,
]);

Department::create([
    'name' => 'Sala de Hospitalización de Cirugía Hombres', //33
    'user_id' => '33',
    'parent_id' => 23,
]);

Department::create([
    'name' => 'Sala de Hospitalización de Cirugía Mujeres', //34
    'user_id' => '34',
    'parent_id' => 23,
]);

// Otros Departamentos bajo Subdirección Asistencial
Department::create([
    'name' => 'Gestión de Pacientes', //35
    'user_id' => '35',
    'parent_id' => 3,
]);

// Subdepartamentos de Gestión de Pacientes
Department::create([
    'name' => 'Unidad de Atención al Usuario (UAU)', //36
    'user_id' => '36',
    'parent_id' => 35,
]);

Department::create([
    'name' => 'Admisión y Archivo', //37
    'user_id' => '37',
    'parent_id' => 35,
]);

// Subdepartamentos de Admisión y Archivo
Department::create([
    'name' => 'Archivo', //38
    'user_id' => '38',
    'parent_id' => 37,
]);

Department::create([
    'name' => 'Admisión', //39
    'user_id' => '39',
    'parent_id' => 37,
]);

// Departamento de Gestión Clínica
Department::create([
    'name' => 'Gestión Clínica', //40
    'user_id' => '40',
    'parent_id' => 3,
]);

// Subdepartamentos de Gestión Clínica
Department::create([
    'name' => 'Laboratorio', //41
    'user_id' => '41',
    'parent_id' => 40,
]);

Department::create([
    'name' => 'Farmacia', //42
    'user_id' => '42',
    'parent_id' => 40,
]);

Department::create([
    'name' => 'Imagenología y Radiología', //43
    'user_id' => '43',
    'parent_id' => 40,
]);

Department::create([
    'name' => 'Clínicas Médicas', //44
    'user_id' => '44',
    'parent_id' => 40,
]);

    }
}
