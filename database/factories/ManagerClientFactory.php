<?php

namespace Database\Factories;

use App\Models\ManagerClient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ManagerClient>
 */
class ManagerClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()->where('type', 0)->inRandomOrder()->first()->id,
            'manager_id' => User::query()->where('type', 1)->inRandomOrder()->first()->id
        ];
    }
}
