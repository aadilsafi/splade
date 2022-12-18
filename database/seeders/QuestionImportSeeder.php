<?php

namespace Database\Seeders;

use App\Imports\QuestionImport;
use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionImport as ModelsQuestionImport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class QuestionImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $file = public_path('sample_file.csv');
        Excel::import(new QuestionImport,$file);
        $ids = ModelsQuestionImport::pluck('id');
        $this->approveQuestions($ids);
    }
    public function approveQuestions($question_ids)
    {

        foreach($question_ids as $question_id)
        {
            $imported_question = ModelsQuestionImport::find($question_id);

            $questionData = $imported_question->only('name','difficulty_level_id','question_bank_id');
            $question = Question::create($questionData);
            foreach(explode(',',$imported_question->answers) as $key => $answerName)
            {
                $answer = Answer::create([
                    'name' => $answerName,
                    'question_id' => $question->id,
                    'is_correct'  => $key == 0
                ]);
            }

        }

           DB::table('question_imports')->truncate();

    }
}
