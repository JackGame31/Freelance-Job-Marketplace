<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Freelance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FreelanceUser>
 */
class FreelanceUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'freelance_id' => Freelance::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'status' => $status = fake()->randomElement(['pending', 'accepted', 'rejected']),
            'start_date' => $status === 'accepted' ? fake()->dateTimeBetween('-1 month', 'now') : null,
            'end_date' => $status === 'accepted' ? fake()->dateTimeBetween('now', '+1 month') : null,
            'final_salary' => $status === 'accepted' ? fake()->randomFloat(2, 100, 10000) : null,
        ];
    }
}
