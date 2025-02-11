<?php

namespace Database\Factories;

use App\Models\Cake;
use App\Models\User;
use App\Models\CakeUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CakeUser>
 */
class CakeUserFactory extends Factory
{
    protected $model = CakeUser::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'cake_id' => Cake::factory(),
        ];
    }
}
