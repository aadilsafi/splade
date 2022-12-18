<?php

namespace App\Console\Commands;

use App\Jobs\QuestionAnswerImportJob;
use App\Models\ImportQuestion;
use Illuminate\Console\Command;

class ImportQuestionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:questions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Question to Database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $questions = ImportQuestion::where('is_imported',false)->get();
        // foreach ($questions as $key => $question) {
        //     dump();
        //    Excel::import(new QuestionImport(public_path($question->path)))
        // }
        dispatch(new QuestionAnswerImportJob());
        
    }
}
