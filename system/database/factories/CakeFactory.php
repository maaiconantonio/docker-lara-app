<?php

namespace Database\Factories;

use App\Models\Cake;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cake>
 */
class CakeFactory extends Factory
{

    protected $model = Cake::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->sentence(3),
            'weight' => fake()->numberBetween(300, 5000),
            'price' => fake()->numberBetween(10, 200),
            'qty_avail' => fake()->numberBetween(0, 50),
        ];
    }
}
