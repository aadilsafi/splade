<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionToQuizStoreRequest;
use App\Http\Requests\QuestionUpdateRequest;
use App\Http\Requests\QuizStoreRequest;
use App\Http\Requests\QuizUpdateRequest;
use App\Models\Answer;
use App\Models\Quiz;
use App\Utils\Common\AttemptStatus;
use App\Utils\Common\SystemTypes;
use App\ViewModel\Category\Course\Topic\Activity\Content\Quiz\Question\Answer\AnswerViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    //
    public function index()
    {
    	$quizzes = auth()->user()->quizzes()->get();
    	return view('portal.quiz.index',compact('quizzes'));
    }
	public function create()
	{
		return view('portal.quiz.create');
	}
    public function store(QuizStoreRequest $request)
    {
    	
    	$data = $request->validated();
		$quiz = auth()->user()->quizzes()->create($data);
		$this->createFlashMessage('Quiz Created Successfully','alert-success');
		return redirect()->route('portal.quiz.index');


    }
    public function destroy(Quiz $quiz)
    {
    	
    }
    public function edit(Quiz $quiz)
    {
    	return view('quiz.edit',compact('quiz'));
    }
    public function update(QuizUpdateRequest $request,Quiz $quiz)
    {
    	$data = $request->validated();
    	$quiz->update([
    		'name' 		 => $data['name'] ?? $quiz->name,
    		'duration' 	 => $data['duration'] ?? $quiz->duration,
    		'start_date' => $data['start_date'] ?? $quiz->start_date,
    		'end_date'	 => $data['end_date'] ?? $quiz->end_date,
    		'total_marks' => $data['total_marks'] ?? $quiz->total_marks,
    		'passing_marks' => $data['passing_marks'] ?? $quiz->passing_marks,
    	]);
		$this->createFlashMessage('Quiz Updated Successfully','alert-success');
    	return view('portal.quiz.index',compact('quizzes'));
    }

	public function weeklyQuiz()
	{
		$quizzes = Quiz::all();
		return view('portal.trainee.weeklyquiz',compact('quizzes'));
	}
	public function addQuestionToQuiz(Request $request)
	{
		// $data = $request->validated();
		// $quiz = Quiz::find($data['quiz']);
		$quiz = Quiz::find(2);
		$question_ids = $request->question_ids;
		$marks = $request->marks;
		$quizQuestions = $this->mapQuestionMarks($question_ids,$marks);
		$quiz->questions()->sync($quizQuestions);
		dd($quiz);
	}
	public function mapQuestionMarks($question_ids,$marks) : array
	{
		$questionWithMarks = [];
		foreach($question_ids as $key => $question_id)
		{
			$questionWithMarks[$question_id] = [
										'marks' => $marks[$key]
									];
		}
		return $questionWithMarks;
	}
	
}
