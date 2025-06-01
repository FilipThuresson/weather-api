<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WeatherLog>
 */
class WeatherLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $date = fake()->dateTimeBetween('-1 year', 'now');

        return [
            "client_id" => fake()->numberBetween(1, 100), // Assuming client IDs are between 1 and 100
            "temperature" => fake()->randomFloat(2, -30, 50), // Temperature in Celsius
            "humidity" => fake()->numberBetween(0, 100), // Humidity in percentage
            "created_at" => $date,
            "updated_at" => $date,
        ];
    }
}
