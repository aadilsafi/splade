<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApproveQuestionRequest;
use App\Imports\QuestionImport;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\QuestionImport as QuestionImportModel;
use App\Utils\Helper;
use Maatwebsite\Excel\Facades\Excel;
class QuestionImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $paginator = QuestionImportModel::with('bank','category')->paginate(5);
        return response()->json($paginator,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('import.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'questions' => 'required|file|mimes:csv,txt'
        ]);  
        $file = $request->questions;
        $data = [];
        // Open file
        $file = fopen($file, 'r');
        $defaultHeaders = ['Name','Difficulty_level','Bank','Answer_1'];
        // Headers
        $headers = fgetcsv($file);
        // Rows
        // dd($headers);
        $data = [];
        $answers = [];

        while (($row = fgetcsv($file)) !== false)
        {
            $item = [];
            // $answersCol = [];
            foreach ($row as $key => $value)
            {
                $item[$headers[$key]] = $value ?? null;
                // dd($row);

            }
            $data[] = $item;
            // $answers[] = $answersCol;
        }

        // Close file
        fclose($file);
        dump($answers);
        dd($data);
        dd($request->all());
    
    }
    public function removeNumber($string)
    {
        return preg_replace('/[0-9]+/', '', $string);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function importQuestions(Request $request)
    {
        $request->validate([
            'question_csv' => 'required|file|mimes:csv,txt'
        ]);
        if($request->hasFile('question_csv'))
        {
            
            Excel::import(new QuestionImport,$request->question_csv);
            return Helper::sendResponse([],"Your File is uploaded Successfully and will imported soon");
		}
        
    }
    public function approveQuestions(ApproveQuestionRequest $request)
    {
        $question_ids = $request->question_ids;
        foreach($question_ids as $question_id)
        {
            $imported_question = QuestionImportModel::find($question_id);
            $alreadyQuestion = Question::whereName($imported_question->name)->exists();
           if(!$alreadyQuestion)
           {
                $questionData = $imported_question->only('name','difficulty_level_id','question_bank_id');
                $question = Question::create($questionData);
                foreach(explode(',',$imported_question->answers) as $key => $answerName)
                {
                    $answer = Answer::create([
                        'name' => $answerName,
                        'question_id' => $question->id,
                        'is_correct'  => $key == 0 ? true : false
                    ]);
                }
           }
           else
           {
               return Helper::sendError('Question Already Exists');
           }
           $imported_question->delete();
        }
        return Helper::sendResponse([],'Question Approved Successfully');
        
    }

    public function sampleFile()
    {
        $file = 'sample_file.csv';
        return response()->download($file);
    }
    
}
