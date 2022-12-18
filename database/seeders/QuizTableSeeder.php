<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class QuizTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $date = Carbon::parse('2022-01-01');
        $date = Carbon::now();
   
        $quizzes = [];
        for($i = 1; $i <= 26; $i++)
        {
            $quiz = [
                'name' => "Quiz ".$i,
                'slug' => Str::slug("Quiz ".$i),
                'trainer_id' => 1,
                'duration' => 1800,
                'start_date' => clone $date,
                'end_date' => clone $date->addDays($i+6),
                'total_marks' => 100,
                'passing_marks' => 80,
                'created_at'    => now(),
                'updated_at'    => now(),
            ];

            $quizzes[] = $quiz;
            $date = clone $quiz['end_date'];
            $date = $date->addDays(14);
        }
        Quiz::insert($quizzes);
    }
}
