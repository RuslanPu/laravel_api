<?php

namespace Database\Seeders;

use App\Models\ApiServiceCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApiServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            3 => 'Followers',
            4 => 'Likes',
            5 => 'Views',
            6 => 'Comments',
            7 => 'Statistics',
        ];

        foreach ($data as $key => $value) {
            ApiServiceCategory::create([
                'id' => $key,
                'title' => $value
            ]);
        }
    }
}
