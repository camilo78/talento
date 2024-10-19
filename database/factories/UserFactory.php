<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Profession;
use App\Models\Specialty;

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
            'gender'=> fake()->boolean(),
            'email' => fake()->unique()->safeEmail(),
            'dni' => fake()->numerify('#############'),
            'rtn' => fake()->numerify('##############'),
            'functional' => 'Enfermera Auxiliar',
            'nominal' => 'Auxiliar de Mantenimiento',
            'profession_id' => Profession::inRandomOrder()->first()->id,  // Asigna una profesión aleatoria
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
