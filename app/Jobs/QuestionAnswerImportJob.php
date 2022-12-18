<?php

namespace App\Jobs;

use App\Imports\QuestionImport;
use App\Models\ImportQuestion;
use Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use File;
class QuestionAnswerImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        //
        // dd($question_csv);
       
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        // dd($this->question);  
        $questions = ImportQuestion::where('is_imported',false)->get();
        foreach ($questions as $key => $question) {
            $file = public_path('storage/'.$question->path);
           
            Excel::import(new QuestionImport,$file);
            // $question->is_imported = true;
            // $question->save();
        }
        
    }
}
