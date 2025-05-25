<?php

namespace Database\Factories;

use App\Models\FreelanceUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = $this->faker->dateTimeBetween('-1 year', 'now');
        return [
            'amount' => $this->faker->numberBetween(1000, 100000),
            'notes' => $this->faker->sentence(),
            'contract_id' => FreelanceUser::where('status', 'accepted')->inRandomOrder()->first()?->id,
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
