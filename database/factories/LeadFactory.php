<?php

namespace Database\Factories;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $managers = User::whereRole('manager')->get();

        $response = [
            'name' => $this->faker->name,
            'source' => $this->faker->randomElement(['web', 'phone', 'email']),
            'owner' => $managers->random()->id,
            'created_by' => $managers->random()->id,
        ];

        dd($response);
    }
}
