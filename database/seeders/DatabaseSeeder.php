<?php

namespace Database\Seeders;

use Database\Seeders\RoleTableSeeder;
use Database\Seeders\UserTableSeeder;
use Database\Seeders\CategoryTableSeeder;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\Worksheet\Dimension;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(QuestionBanksTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ContentTableSeeder::class);
        $this->call(CourseTableSeeder::class);
        $this->call(DifficultyTableSeeder::class);
        $this->call(ResourceTypeSettingsTableSeeder::class);
        $this->call(QuestionImportSeeder::class);
        $this->call(QuizTableSeeder::class);
        $this->call(QuizQuestionTableSeeder::class);
    }
}
