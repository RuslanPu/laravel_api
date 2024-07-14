<?php

namespace Database\Factories;

use App\Models\PackageService;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ManagerPackage>
 */
class ManagerPackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $package = PackageService::query()->inRandomOrder()->first();
        $manager = User::query()->where('type', 1)->inRandomOrder()->first();

        return [
            'package_id' => $package?->id,
            'manager_id' => $manager?->id,
            'is_active' => true
        ];
    }
}
