<?php

namespace Database\Seeders;

use App\Models\SocialAccountType;
use Illuminate\Database\Seeder;

class SocialAccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accountTypes = [
          'Instagram',
          'Facebook',
        ];

        foreach ($accountTypes as $accountType) {
            SocialAccountType::create([
                'name_social_network' => $accountType
            ]);
        }
    }
}
