<?php

namespace Database\Factories;

use App\Models\SocialAccount;
use App\Models\SocialAccountType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SocialAccount>
 */
class SocialAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /** @var User $user */
        $user = User::query()->where('type', 0)->inRandomOrder()->first();
        $socialAccountType = SocialAccountType::query()->inRandomOrder()->first();

        return [
            'user_id' => $user?->id,
            'social_account_type_id' => $socialAccountType?->id,
            'account_link' => $this->faker->url
        ];
    }
}
