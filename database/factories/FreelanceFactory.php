<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Freelance>
 */
class FreelanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraph(),
            'logo' => 'https://picsum.photos/id/' . fake()->unique()->randomNumber(2) . '/800/800',
            'start_salary' => fake()->randomFloat(2, 30000, 50000),
            'end_salary' => fake()->randomFloat(2, 60000, 100000),
            'status' => fake()->randomElement(['open', 'closed']),
            'admin_id' => Admin::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
