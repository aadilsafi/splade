<?php

namespace App\Imports;

use App\Models\Question;
use App\Models\Answer;
use App\Models\QuestionBank;
use App\Models\Category;
use App\Models\DifficultyLevel;
use App\Models\QuestionImport as ModelsQuestionImport;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
class QuestionImport implements ToCollection,WithHeadingRow,WithChunkReading
{
    public function collection(Collection $rows)
    {
        // dd($rows);
        // dd($this->choices);
        $allBanks = QuestionBank::select('id','slug')->get();
        $allDifficultyLevel = DifficultyLevel::select('id','slug')->get();
        foreach($rows as $item)
        {
            $difficultyLevelObj = $allDifficultyLevel->where('slug', Str::slug($item['difficulty_level']))->first();
            $bankObj     = $allBanks->where('slug', Str::slug($item['bank']))->first();
            if($difficultyLevelObj && $bankObj){
                
                $questionImportObj = [
                    'name'              => $item['name'],
                    'difficulty_level_id'       => $difficultyLevelObj->id,
                    'question_bank_id'  => $bankObj->id,
                ];
                $answers  = collect($item)->except(['name', 'difficulty_level', 'bank']);
                $questionImportObj['answers'] = implode(',',$answers->toArray());
                ModelsQuestionImport::create($questionImportObj);
                
            }
        }        
    }
    public function chunkSize(): int
    {
        return 100;
    }
}
