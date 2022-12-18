<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionStoreRequest;
use App\Http\Requests\QuestionUpdateRequest;
use App\ViewModel\Category\Course\Topic\Activity\Content\Quiz\Question\QuestionViewModel as QuestionQuestionViewModel;
use App\Models\DifficultyLevel;
use App\Models\QuestionBank;
use App\ViewModel\Category\Course\Topic\Activity\Content\Quiz\Question\QuestionViewModel;
use App\Models\Answer;
use App\Models\QuestionImport as ModelQuestionImport;
use App\Models\Question;
use App\Models\QuestionImage;
use App\ViewModel\DifficultyLevel\DifficultyLevelViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class QuestionController extends Controller
{
    //
    public function index(QuestionBank $questionBank, Request $request)
    {
        if ($request->ajax()) {
            $questions = QuestionQuestionViewModel::getMultipleQuestionsViewModel($questionBank->questions);
            return response()->json($questions);
        }
        return redirect()->route('question-banks.show', $questionBank->slug);
    }

    public function create(QuestionBank $questionBank)
    {
        $difficultyLevels = DifficultyLevelViewModel::getMultipleDifficultyLevelsViewModel(DifficultyLevel::all());
        return view('lms.questions.form', compact('questionBank', 'difficultyLevels'));
    }

    public function store(QuestionBank $questionBank, QuestionStoreRequest $request)
    {
        $question = Question::create($request->validated());
        if (isset($request['answers'], $request['is_correct'])) {
            for ($i = 0; $i < count($request['answers']); $i++) {
                if ($request['answers'][$i] != "") {
                    $question->answers()->create([
                        'name' => $request['answers'][$i],
                        'is_correct' => $request['is_correct'][0] == $i
                    ]);
                }
            }
        }
        $this->createFlashMessage('Question Added Successfully', 'success');
        return redirect()->route('question-banks.show', $questionBank->slug);
    }

    public function bulkUpload(Request $request)
    {
        if ($request->hasFile('file') && isset($request->question_bank_id)) {
            $fillables      = (new Question())->getFillable();
            $fillables[]    = "answers";

            $header = [];
            $full_data = [];

            $errors = [];
            foreach (file($request->file) as $key => $line) {
                $data = explode(',', str_replace("\n", "", $line));
                foreach ($data as $key2 => $column) {
                    $column = Str::lower($column);
                    if ($key == 0) {
                        $header[] = $column;
                    } else {
                        if (Question::where('name', $column)->exists()) {
                            $errors[] = "<li> $header[$key2]: $column already exists in system </li>";
                            if (isset($full_data[$key - 1])) {
                                unset($full_data[$key - 1]);
                            }
                        } else {
                            $full_data[$key - 1][$header[$key2]] = $column;
                        }
                    }
                }

                if (count(array_diff($header, $fillables)) != 0) {
                    $errors[] = "<li>Please provide these columns " . implode(",", $fillables) . "</li>";
                    break;
                }
            }

            if (count($errors) == 0) {
                foreach ($full_data as $dd) {
                    $dd['question_bank_id'] = $request->question_bank_id;
                    $answers = explode('|', $dd['answers']);
                    unset($dd['answers']);
                    $qObj = Question::create($dd);

                    foreach ($answers as $key => $answer) {
                        $qObj->answers()->create(['name' => $answer, 'is_correct' => $key == 0]);
                    }
                }
                $this->createFlashMessage("Questions Uploaded Successfully", 'success');
                return redirect()->route('question-banks.show', $request->slug);
            } else {
                $message = "<br><ul class='pt-1'>" . implode('', $errors) . "</ul>";
                $this->createFlashMessage("Error While Uploading Question Banks. " . $message, 'danger');
                return redirect()->route('question-banks.index');
            }
        }

        return redirect()->route('user.index');
    }


    public function destroy(QuestionBank $questionBank, Question $question)
    {
        $deleted = $question->delete();
        $this->createFlashMessage("Question Deleted Successfully", 'danger');
        return route('question-banks.show', $questionBank->slug);
    }


    public function edit(QuestionBank $questionBank, Question $question)
    {
        $difficultyLevels = DifficultyLevelViewModel::getMultipleDifficultyLevelsViewModel(DifficultyLevel::all());
        $question = QuestionViewModel::getSingleQuestionViewModel($question,true,true);
        return view('lms.questions.form', compact('questionBank', 'difficultyLevels', 'question'));
    }

    public function update(QuestionUpdateRequest $request, QuestionBank $questionBank, Question $question)
    {
        $question->update($request->validated());
        if (isset($request['answers'], $request['is_correct'])) {
            // Delete Old Questions
            $question->answers()->delete();

            // Add New Questions
            for ($i = 0; $i < count($request['answers']); $i++) {
                if ($request['answers'][$i] != "") {
                    $question->answers()->create([
                        'name'       => $request['answers'][$i],
                        'is_correct' => $request['is_correct'][0] == $i
                    ]);
                }
            }
        }
        $this->createFlashMessage('Question Updated Successfully', 'success');
        return redirect()->route('question-banks.show', $questionBank->slug);
    }


	public function importedQuestions()
	{
		$imported_questions = ModelQuestionImport::with('bank','category')->get();
		return view('import.imported_question',compact('imported_questions'));
	}

    // public function 
}
