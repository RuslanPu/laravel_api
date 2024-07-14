<?php

namespace Database\Factories;

use App\Models\ManagerPackage;
use App\Models\User;
use App\Models\UserPackage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserPackage>
 */
class UserPackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::query()->where('type', 0)->inRandomOrder()->first();
        $managerPackage = ManagerPackage::query()->inRandomOrder()->first();

        return [
            'package_id' => $managerPackage?->package_id,
            'user_id' => $user?->id,
            'valid' => true,
        ];
    }
}
