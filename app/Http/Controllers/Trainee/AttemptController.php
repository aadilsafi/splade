<?php

namespace App\Http\Controllers\Trainee;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuizAttemptRequest;
use App\Http\Resources\AttemptResource;
use App\Models\Activity;
use App\ViewModel\Category\Course\Topic\Activity\Content\Quiz\Attempt\AttemptViewModel;
use App\Models\Answer;
use App\Models\Attempt;
use App\Models\AttemptView;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Topic;
use App\Utils\Common\AttemptStatus;
use App\Utils\Common\SystemTypes;
use App\Utils\Helper;
use App\ViewModel\Category\Course\Topic\Activity\Content\Quiz\Question\Answer\AnswerViewModel;
use App\ViewModel\Category\Course\Topic\Activity\Content\Quiz\QuizViewModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttemptController extends Controller
{
	//
	public function index()
	{
		$quizzes = Quiz::all();
		return view('attempt.index', compact('quizzes'));
	}
	public function quizAttempt(Quiz $quiz)
	{
		// New Work
		if (is_numeric()) {
			return Quiz::where('id', $value)->orWhere('slug', $value)->firstOrFail();
		}
		return Quiz::where('slug', $value)->firstOrFail();
		$user = auth()->user();
		$attempts = Attempt::where('quiz_id', $quiz->id)->where('user_id', $user->id)->get();

		if (count($attempts) == 0) {
			$questions = Question::inRandomOrder()->limit(3)->get();

			$attempt_data = [];
			foreach ($questions as $question) {
				$attemp_obj = Attempt::create([
					'user_id'		=> $user->id,
					'question_id' 	=> $question->id,
					'quiz_id'	    => $quiz->id
				]);

				$attempt = [
					'attempt_id'	=>	$attemp_obj->id,
					'question_id'	=>	$question->id,
					'question'		=>	$question->description,
					'answers'		=>	$question->answers()->get(['id', 'title', 'description'])->toArray(),
				];

				$attempt_data[] = $attempt;
			}

			$attempts = $attempt_data;
		} else {
			$attempt_data = [];
			foreach ($attempts as $attempt) {
				$question = $attempt->question;
				$data = [
					'attempt_id'	=>	$attempt->id,
					'question_id'	=>	$question->id,
					'question'		=>	$question->description,
					'answers'		=>	$question->answers()->get(['id', 'title', 'description'])->toArray(),
				];

				$attempt_data[] = $data;
			}

			$attempts = $attempt_data;
		}

		return view('attempt.create', compact('quiz', 'attempts'));




		// Old Work
		$user = auth()->user();
		$attempt_ids = Attempt::pluck('id');
		// dd($attempt);
		$question_gap = count(Attempt::select('question_id')->distinct()->get());
		// dd($question_gap);
		$attempt = Attempt::with('question')->where('user_id', $user->id)
			->get();
		// dd($attempt);

		$old_attempt = $this->quizData($attempt);
		$all_questions = [];
		if (count($old_attempt) > 0) {
			return view('attempt.create', compact('old_attempt', 'quiz', 'question_gap'));
		} else if (count($attempt) > 0) {
			dump('yes');
			$questions = Question::whereNotIn('id', $attempt)->limit(3)->get();
			dd($questions);
		} else {
			$questions = Question::inRandomOrder()->limit(3)->get();
			foreach ($questions as $question) {
				foreach ($question->answers as $key => $answer) {
					$all_questions = Attempt::create([
						'user_id'		=> $user->id,
						'question_id' 	=> $question->id,
						'answer_id'	    => $answer->id,
						'quiz_id'	    => $quiz->id
					]);
				}
			}
		}

		dd($all_questions);
		dd('end');

		if ($attempt)
			return view('attempt.create', compact('quiz'));
	}
	public function quizData($old_attempt)
	{
		// dd($old_attempt);
		$new_data = [];
		$answer_data = [];
		foreach ($old_attempt as $key => $attempt) {
			$data = [
				'attempt_id' => $attempt->id,
				'question_id' => $attempt->question_id,
				'question'	  => $attempt->question->description,
				'answers' => []

			];

			foreach ($attempt->question->answers as $answer) {
				$answer_data[] = [
					'id' => $answer->id,
					'title' => $answer->title,
					'description' => $answer->description,
					'created_at' => $answer->created_at,
					'updated_at' => $answer->updated_at
				];
			}
			// dd($answer_data);
			$data['answers'] = $answer_data;
			$answer_data = [];
			$new_data[] = $data;
		}
		return $new_data;
	}
	public function updateAttempt()
	{
		// return $request->all();
		$quiz = Quiz::find(1);
		$attempt = Attempt::whereRaw('created_at = updated_at')->get();
		dd($attempt);
		//quiz duration is not
		dd(Helper::quizRemainingTimeInMinute($attempt->created_at, $quiz->duration));


		dd($attempt);
		if ($attempt) {
			// $correct = $attempt->answer->is_correct;
			if ($request->answer != 0) {
				$attempt = $attempt->update(['answer_id' => $request->answer, 'is_correct' => 1]);
				return $attempt;
			}
			$attempt = $attempt->update(['answer_id' => null]);
			return $attempt;
		}
	}
	public function myQuizAttempt($slug)
	{
		$quiz = Quiz::where('slug', $slug)->firstOrFail();
		$user = auth()->user();
		$total_questions = 5; //change to quiz->total_question
		if (!(Helper::isQuizDuration($quiz))) {

			$this->createFlashMessage('Quiz Duration is no more', 'danger');
			return view('portal.attempt.index')->with('attempts', []);
		}
		// dd($quiz->attempts);
		// $attempts = Attempt::query();
		// $attempts = $attempts->where([
		// 							'quiz_id' => $quiz->id ,
		// 							'user_id' => $user->id
		// 							]);
		$attempts = $quiz->attempts;

		$attempt_ids = $attempts->pluck('question_id');
		$newAttempts = [];
		if (count($attempts) == 0) //no attempt exists
		{

			$question_ids = $this->randomQuestion($quiz, $attempt_ids, $total_questions);
			// dd($question_ids);
			if (count($question_ids) != 0) //question are remaining for quiz
			{
				foreach ($question_ids as $question_id) {
					$newAttempts[] = $user->attempts()->create([
						'question_id' => $question_id,
						'is_correct'  => false,
						'marks'       => 0,
						'type'        => SystemTypes::PORTAL,
						'quiz_id'     => $quiz->id
					]);
				}
				$myAttempts = AttemptViewModel::getMultipleAttemptViewModel(collect($newAttempts)->shuffle());
				// return $myAttempts;
				$this->createFlashMessage('Quiz Started Successfully', 'success');

				return view('portal.attempt.index')->with('attempts', $myAttempts);
				// return AttemptResource::collection(collect($newAttempt));

			} else //
			{
				dd('Questions are not Remaining');
				//admin ko notify kr lo k question khatam hogae hy

			}
		} else //Current Quiz attempt are generated already
		{
			$attempts = $attempts->where('status', AttemptStatus::PENDING)->shuffle();
			$attempts = AttemptViewModel::getMultipleAttemptViewModel($attempts);

			if (array_key_exists('questions', $attempts) && count($attempts['questions']) != 0)
				$this->createFlashMessage('Quiz Continue Successfully', 'success');
			// else
			//     $this->createFlashMessage('Quiz Duration is No More','danger');

			return view('portal.attempt.index')->with(['attempts' => $attempts]);
		}
	}
	//attemp id's is for except these question
	public function randomQuestion($quiz, $attempt_ids, $limit)
	{
		$question_ids = Question::inRandomOrder()
			->limit($limit)
			->whereNotIn('id', $attempt_ids)
			->pluck('id');
		return $question_ids;
	}
	public function attemptQuestion(Request $request)
	{
		$request->validate([
			'quiz_id'   => 'required|exists:quizzes,id',
			'answer_id' =>  'required|exists:answers,id',
			'question_id' => 'required|exists:questions,id',
		]);
		$quiz_id = $request->quiz_id;
		$answer_id = $request->answer_id;
		$question_id = $request->question_id;
		$quiz = Quiz::find($quiz_id);
		// Quiz have No Duration Time
		if (!Helper::isQuizDuration($quiz)) {
			// dd('Quiz Duration is no more');
			$this->createFlashMessage('Quiz Duration is no more', 'danger');
			return view('portal.attempt.index');
		}
		//quiz have duration
		$attempt = Attempt::where([
			'quiz_id'     => $quiz_id,
			'question_id' => $question_id,
			'user_id'     => auth()->id()
		])->first();

		if (!$attempt) {
			$response = [
				'message' => 'Invalid Attempt! No Question exist in this Quiz',
			];
			return response()->json($response, 400);
		}
		//
		if (Helper::isQuestionToBeAttempt($attempt)) {
			$question = Question::find($question_id);
			$answer = Answer::find($answer_id);
			if (Helper::isQuestionHaveAnswer($question, $answer_id)) {
				//question to be attempt
				if ($this->isCorrectAnswer($answer_id)) {
					$total_attempts = Attempt::where([
						'quiz_id' => $quiz->id,
						'user_id' => auth()->id()
					])->count();
					$attempt->update([
						'marks' => $quiz->total_marks / $total_attempts,
						'is_correct' => true,
						'status' => AttemptStatus::ATTEMPTED
					]);
					$response = [
						'message' => 'Question Attempt Successfully',
						'is_correct' => true,
						'answer'     => AnswerViewModel::getSingleAnswerViewModel($answer, true),
						'remaining_time' => Helper::QuizAttemptRemainingTime($attempt->created_at, $quiz->duration)
					];
					return response()->json($response, 200);
				} else {
					$attempt->update(['marks' => 0, 'is_correct' => false, 'status' => AttemptStatus::ATTEMPTED]);
					$response = [
						'message' => 'Question Attempt Successfully',
						'is_correct' => false,
						'answer'     => AnswerViewModel::getSingleAnswerViewModel($answer, true),
						'remaining_time' => Helper::QuizAttemptRemainingTime($attempt->created_at, $quiz->duration)
					];
					return response()->json($response, 200);
				}
			}
			//question not have answer which are submitted
			$attempt->update(['marks' => 0, 'status' => AttemptStatus::ATTEMPTED]);
			$response = [
				'message' => 'Invalid Answers! Attempt Denied!',
				'remaining_time' => Helper::QuizAttemptRemainingTime($attempt->created_at, $quiz->duration),
			];
			return response()->json($response, 400);
		} else //question have no answers
		{
			$response = [
				'message' => 'Can not Attempt This Question! Attempt Denied!',
				'remaining_time' => Helper::QuizAttemptRemainingTime($attempt->created_at, $quiz->duration),
				'next' => true
			];
			return response()->json($response, 400);
		}
	}
	public function isCorrectAnswer($answer_id)
	{
		return Answer::find($answer_id)->is_correct == 1 ? true : false;
	}

	//LMS Quiz Attempts
	// public function lmsAttemptIndex(Quiz $quiz)
	// {
	// 	$questions = QuizViewModel::getSingleQuizViewModel($quiz, true,true);
	// 	return view('lms.attempts.index',compact('questions'));



	// }
	public function lmsQuizAttemptIndex(Topic $topic, Activity $activity)
	{
		$user = auth()->user();
		$quiz = $activity->content;

		if ($quiz) 
		{
			if ($user->attempts->count() == 0)
			{
				if(Helper::isBetweenTwoDates($quiz->start_date,$quiz->end_date))
				{
					foreach ($quiz->questions as $question) {
						$user->attempts()->create([
							'question_id' => $question->id,
							'type'        =>  SystemTypes::LMS,
							'quiz_id'     => $quiz->id,
							'total_marks' => $question->pivot->marks,
							'status'      => AttemptStatus::PENDING
						]);
					}
					$this->createFlashMessage('Quiz Attempt Started Successfully', 'alert-success');
					return view('lms.topics.attempts.index', compact('quiz','topic','activity'));
				}
				else
				{
					$this->createFlashMessage('Quiz Attempt Date Passed', 'alert-danger');
					return redirect()->route('lms.quiz.attempt.report',
										[
											'topic' => $topic,
											'activity'=> $activity,
											'quiz' => $quiz
										]);
				}
				

			} 
			else{
					$this->createFlashMessage('Quiz Already Attempted', 'alert-danger');
					return redirect()->route('lms.quiz.attempt.report',
										[
											'topic' => $topic,
											'activity'=> $activity,
											'quiz' => $quiz
										]);
				
			}
			
		}
		$this->createFlashMessage('There is No Quiz Exists', 'alert-danger');
		return redirect()->route('lms.activities.index', compact('topic'));
	}
	public function lmsQuizAttemptStore(QuizAttemptRequest $request)
	{
		$topic = Topic::find($request->topic_id);
		$quiz = Quiz::find($request->quiz_id);
		$activity = Activity::find($request->activity_id);
		if($activity->activity_id != $quiz->id)
		{
			$this->createFlashMessage('Unable to Find Topic','alert-danger');
			return redirect()->back();
		}
		$user = auth()->user();
		$answer_ids = $request->answer_ids;


		// $currentTime = now();
		$answers = Answer::find($answer_ids)->sortBy('id');
		$question_ids = $answers->pluck('question_id');
		$attempts = $user->attempts()
							->where('quiz_id',$quiz->id)
							->where('status',AttemptStatus::PENDING)
							->whereIn('question_id',$question_ids)
							->get()
							->sortBy('question_id');
		// dd($attempts);
		if (count($attempts) > 0) 
		{
			$quizHaveDuration = Helper::isBetweenTwoDatesWithDuration($attempts->first()->created_at,$quiz->duration);
			if($quizHaveDuration) 
			{
				$attempts->each(function($attempt,$key) use ($answers){
					$marks = $answers[$key]->is_correct == 1 ? $attempt->total_marks : 0;
					$attemptData = [
						'marks' => $marks ,
						'status' => AttemptStatus::ATTEMPTED
					];
					$attempt->update($attemptData);
				});
			
				// update other question marks to be 0 and attempted
				$remainingAttempts = $user->attempts()
							->where('quiz_id',$quiz->id)
							->where('status',AttemptStatus::PENDING)
							->get();
				$remainingAttempts->each(function($attempt){
					$attempt->update(['status' => AttemptStatus::ATTEMPTED]);
				});

				$this->createFlashMessage('Quiz Attempted Successfully','alert-succes');

				$report = $this->createAttemptView($quiz->id);
				return redirect()->route('lms.quiz.attempt.report',
									[
										'topic' => $topic,
										'activity'=> $activity,
										'quiz' => $quiz
									]);
				
			}
			else
			{
				$this->createFlashMessage('Quiz Time Exceed','alert-danger');
				return redirect()->route('lms.quiz.attempt.report',
							[
								'topic' => $topic,
								'activity'=> $activity,
								'quiz' => $quiz
							]);
			}
		}
		else
			$this->createFlashMessage('Unable To Attempt Quiz','alert-danger');

		$report = $this->createAttemptView($quiz->id);
		return redirect()->route('lms.quiz.attempt.report',
							[
								'topic' => $topic,
								'activity'=> $activity,
								'quiz' => $quiz
							]);
			

	}
	public function lmsQuizReport(Topic $topic, Activity $activity , Quiz $quiz)
	{
		if(auth()->user()->isAdmin)
		{
			dd('hi');
		}

		if($activity->topic_id != $topic->id)
		{
			$this->createFlashMessage('Unable to Find Topic','alert-danger');
			return redirect()->back();
		}

		$report = $this->createAttemptView($quiz->id);
		return view('lms.topics.attempts.report', compact('report'));
	}
	private function createAttemptView($quiz_id)
	{
		$result = AttemptView::where('user_id', auth()->id())
							->where('quiz_id', $quiz_id)
							->first();
		return  AttemptViewModel::getSingleAttemptDBViewModel($result);
		
	}
}
