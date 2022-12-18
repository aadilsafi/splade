<?php

namespace Database\Seeders;

use App\Models\QuizQuestion;
use Illuminate\Database\Seeder;

class QuizQuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $questions = [
            [
                'quiz_id'       => 1,
                'question_id'   => 1,
                'marks'         => 5,
            ],
            [
                'quiz_id'       => 1,
                'question_id'   => 2,
                'marks'         => 5,
            ],
            [
                'quiz_id'       => 1,
                'question_id'   => 3,
                'marks'         => 5,
            ],
            [
                'quiz_id'       => 1,
                'question_id'   => 4,
                'marks'         => 5,
            ],
            [
                'quiz_id'       => 1,
                'question_id'   => 5,
                'marks'         => 5,
            ],
        ];

        QuizQuestion::insert($questions);
    }
}
