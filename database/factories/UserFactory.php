<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'email' => fake()->unique()->safeEmail(),
            'position' => fake()->jobTitle(),
            // 'salary' => Hash::make(fake()->randomNumber(5)),
            'salary' => fake()->randomNumber(5),
            'role' => 'user',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'department' => fake()->randomElement(['HR', 'Finance', 'Development', 'Marketing']),
            'date_of_birth' => fake()->date(),
            'nrc' => $this->generateNRC(),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'gender' => fake()->randomElement(['male', 'female', 'other']),
            'skills' => fake()->words(3, true),
            'emergency_contact' => fake()->name(),
            'emergency_contact_number' => fake()->phoneNumber(),
            'joining_date' => now(),
            'system_status' => fake()->randomElement(['active', 'inactive', 'deleted']),
            'remember_token' => Str::random(10),
        ];
    }

    private function generateNRC(): string
    {
        $stateRegionCode = fake()->numberBetween(1, 14);  // Generate state/region code
        $districtCode = strtoupper(fake()->lexify('???')); // Generate random district code
        $citizenIdentifier = fake()->randomElement(['N', 'M', 'F']); // Citizen identifier
        $uniqueNumber = fake()->numberBetween(100000, 999999); // Generate unique 6-digit number

        // Construct NRC format
        return "{$stateRegionCode}/{$districtCode}({$citizenIdentifier}){$uniqueNumber}";
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
