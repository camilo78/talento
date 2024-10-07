<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Department;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserDepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Esto creará un usuario usando el factory de User, o puedes obtener uno existente
            'department_id' => Department::factory(), // Lo mismo aplica para el departamento
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
