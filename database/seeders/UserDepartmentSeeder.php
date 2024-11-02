<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Department;

class UserDepartmentSeeder extends Seeder
{
    public function run()
    {
        // Dirección Ejecutiva y sus Subdirecciones
        $user1 = User::create([
            'name' => 'Juan Pérez',
            'gender' => true,
            'email' => 'juan.perez@example.com',
            'dni' => '123456789',
            'rtn' => '987654321',
            'functional' => '12345',
            'nominal' => '67890',
            'type' => 'Permanente',
            'password' => bcrypt('password'),
        ]);

        $department1 = Department::where('name', 'Dirección Ejecutiva')->first();
        $department2 = Department::where('name', 'Subdirección de Gestión de Recursos')->first();
        $user1->departments()->attach([$department1->id, $department2->id]);

        // Subdirección de la Información y sus Unidades
        $user2 = User::create([
            'name' => 'María Gómez',
            'gender' => false,
            'email' => 'maria.gomez@example.com',
            'dni' => '5265256325658',
            'rtn' => '256585658554',
            'functional' => '54321',
            'nominal' => '09876',
            'type' => 'Contrato',
            'password' => bcrypt('password'),
        ]);

        $department3 = Department::where('name', 'Subdirección de la Información')->first();
        $department4 = Department::where('name', 'Unidad de Estadística')->first();
        $department5 = Department::where('name', 'Unidad de Epidemiología')->first();
        $department6 = Department::where('name', 'Unidad de Cómputo')->first();
        $user2->departments()->attach([$department3->id, $department4->id]);

        // Subdirección de la Información y Unidad de Epidemiología
        $user3 = User::create([
            'name' => 'Carlos Martínez',
            'gender' => true,
            'email' => 'carlos.martinez@example.com',
            'dni' => '456789123',
            'rtn' => '321654987',
            'functional' => '67890',
            'nominal' => '12345',
            'type' => 'Interinato',
            'password' => bcrypt('password'),
        ]);

        $user3->departments()->attach([$department3->id, $department5->id]);

        // Subdirección de la Información y Unidad de Cómputo
        $user4 = User::create([
            'name' => 'Ana Torres',
            'gender' => false,
            'email' => 'ana.torres@example.com',
            'dni' => '654987321',
            'rtn' => '789456123',
            'functional' => '11223',
            'nominal' => '44556',
            'type' => 'Permanente',
            'password' => bcrypt('password'),
        ]);

        $user4->departments()->attach([$department3->id, $department6->id]);

        // Subdirección Asistencial y Departamento de Enfermería
        $user5 = User::create([
            'name' => 'Sofía Méndez',
            'gender' => false,
            'email' => 'sofia.mendez@example.com',
            'dni' => '321456789',
            'rtn' => '987654321',
            'functional' => '99887',
            'nominal' => '55678',
            'type' => 'Contrato',
            'password' => bcrypt('password'),
        ]);

        $department7 = Department::where('name', 'Subdirección Asistencial')->first();
        $department8 = Department::where('name', 'Departamento de Enfermería')->first();
        $user5->departments()->attach([$department7->id, $department8->id]);

        // Departamento de Enfermería y sus Emergencias
        $user6 = User::create([
            'name' => 'Roberto Sánchez',
            'gender' => true,
            'email' => 'roberto.sanchez@example.com',
            'dni' => '159753456',
            'rtn' => '357951753',
            'functional' => '11234',
            'nominal' => '22345',
            'type' => 'Permanente',
            'password' => bcrypt('password'),
        ]);

        $department9 = Department::where('name', 'Emergencia de Medicina Interna')->first();
        $department10 = Department::where('name', 'Emergencia de Gineco Obstetricia')->first();
        $department11 = Department::where('name', 'Emergencia de Pediatría')->first();
        $user6->departments()->attach([$department8->id, $department9->id]);

        // Departamento de Logística y Suministros y sus Subdivisiones
        $user7 = User::create([
            'name' => 'Marta López',
            'gender' => false,
            'email' => 'marta.lopez@example.com',
            'dni' => '753951654',
            'rtn' => '951753852',
            'functional' => '55667',
            'nominal' => '77889',
            'type' => 'Contrato',
            'password' => bcrypt('password'),
        ]);

        $department12 = Department::where('name', 'Departamento de Logística y Suministros')->first();
        $department13 = Department::where('name', 'Almacén')->first();
        $department14 = Department::where('name', 'Compras')->first();
        $user7->departments()->attach([$department12->id, $department13->id]);

        // Departamento de Gestión Financiera y Bienes Nacionales
        $user8 = User::create([
            'name' => 'Pedro Torres',
            'gender' => true,
            'email' => 'pedro.torres@example.com',
            'dni' => '159258357',
            'rtn' => '753159258',
            'functional' => '44789',
            'nominal' => '66778',
            'type' => 'Permanente',
            'password' => bcrypt('password'),
        ]);

        $department15 = Department::where('name', 'Gestión Financiera')->first();
        $department16 = Department::where('name', 'Bienes Nacionales')->first();
        $user8->departments()->attach([$department15->id, $department16->id]);

        // Otros usuarios pueden añadirse de forma similar asignándolos a sus respectivos departamentos

        // Departamento de Contabilidad
        $user9 = User::create([
            'name' => 'Laura Medina',
            'gender' => false,
            'email' => 'laura.medina@example.com',
            'dni' => '123123123',
            'rtn' => '321321321',
            'functional' => '99876',
            'nominal' => '55432',
            'type' => 'Interinato',
            'password' => bcrypt('password'),
        ]);

        $department17 = Department::where('name', 'Contabilidad')->first();
        $user9->departments()->attach($department17->id);

        // Departamento de Servicios Generales y sus Subdivisiones
        $user10 = User::create([
            'name' => 'Luis Hernández',
            'gender' => true,
            'email' => 'luis.hernandez@example.com',
            'dni' => '741852963',
            'rtn' => '963852741',
            'functional' => '77889',
            'nominal' => '55678',
            'type' => 'Permanente',
            'password' => bcrypt('password'),
        ]);

        $department18 = Department::where('name', 'Servicios Generales')->first();
        $department19 = Department::where('name', 'Vigilancia')->first();
        $user10->departments()->attach([$department18->id, $department19->id]);
    }
}

