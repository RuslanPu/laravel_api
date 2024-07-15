<?php

namespace Database\Factories;

use App\Models\ApiService;
use App\Models\PackageService;
use App\Models\PackageServicesApiServices;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PackageServicesApiServices>
 */
class PackageServicesApiServicesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $package = PackageService::query()->inRandomOrder()->first();
        $services = ApiService::query()->inRandomOrder()->first();
        return [
            'package_id' => $package?->id,
            'service_id' => $services?->id,
        ];
    }
}
