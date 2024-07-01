<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Department;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            //'department_id'=>  Department::inRandomOrder()->first(),
            //'boss'=> fake()->boolean(),
            'gender'=> fake()->boolean(),
            'last_name' => fake()->lastname(),
            'email' => fake()->unique()->safeEmail(),
            'dni' => fake()->numerify('##############'),
            'functional' => 'Enfermera Auxiliar',
            'nominal' => 'Auxiliar de Mantenimiento',
            'type' => 'Permanente',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('milogaqw12'),
            'remember_token' => Str::random(10),
        ];
    }

        /**
         * Indicate that the model's email address should be unverified.
         */
        public function unverified(): static
        {
            return $this->state(fn (array $attributes) => [
                'email_verified_at' => null,
            ]);
        }
    }
