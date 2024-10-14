<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Party>
 */
class PartyFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('now', '+1 year');
        $endDate = Carbon::instance($startDate)->addHours($this->faker->numberBetween(2, 8));
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'location' => $this->faker->address(),
            'max_guests' => $this->faker->numberBetween(10, 500),
            'started_at' => $startDate,
            'ended_at' => $endDate,
        ];
    }
}
