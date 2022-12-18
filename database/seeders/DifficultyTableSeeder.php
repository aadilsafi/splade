<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\DifficultyLevel;
use App\Utils\Common\DifficultyLevel as CommonDifficultyLevel;

class DifficultyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $difficulty_levels = [
            [
                'name'      => CommonDifficultyLevel::TYPES[CommonDifficultyLevel::EASY],
                'slug'      => 'easy',
                'weightage' => 1
            ],
            [
                'name'      => CommonDifficultyLevel::TYPES[CommonDifficultyLevel::MEDIUM],
                'slug'      => 'medium',
                'weightage' => 2
            ],
            [
                'name'      => CommonDifficultyLevel::TYPES[CommonDifficultyLevel::DIFFICULT],
                'slug'      => 'difficult',
                'weightage' => 3
            ]
        ];
        foreach ($difficulty_levels as $key => $difficulty_level) {
            DifficultyLevel::create($difficulty_level);
        }

    }
}
