<?php


namespace App\ViewModel\Category\Course\Topic\Activity\Content\Quiz\Attempt;

use App\Utils\Common\AttemptViewStatus;
use App\ViewModel\User\UserViewModel;
use App\Utils\Helper;
use App\ViewModel\Category\Course\Topic\Activity\Content\Quiz\QuizViewModel;

class AttemptViewModel
{
    public $question;
    public $marks;
    
    //for view
    public $user;
    public $quiz;
    public $score;
    public $total_marks;
    public $passing_marks;
    public $status;
    public static function getMultipleAttemptViewModel($attempts)
    {
        $attemptList = [
            'questions' => [],
            'quiz'      => []
        ];
        if(count($attempts) != 0){
            foreach ($attempts as $attempt)
            {
                array_push($attemptList['questions'],self::getSingleAttemptViewModel($attempt));
            }
            $quiz = $attempts[0]->quiz->only('id','name','duration','start_date','end_date');
            $duration = Helper::QuizAttemptRemainingTime($attempts[0]->created_at,$quiz['duration']);
            $quiz['duration'] = $duration;
            $attemptList['quiz'] = $quiz;
            if($duration == 0)
            {
                $attemptList['questions'] = [];
            }
        }
        else
            $attemptList = [];
        
        // dd($attemptList);
        // dd($attemptList);
        return collect($attemptList);
    }
    public static function getSingleAttemptViewModel($attempt)
    {
        $attemptViewModel                      = new AttemptViewModel();
        $questionArray                         = collect([
                                                    'id'    => $attempt->question->id,
                                                    'name'  =>  $attempt->question->name,
                                                    'answers' =>$attempt->question->answers()->select('id','name')->get()->shuffle()->toArray(),
                                                 ]);
        $attemptViewModel->question           = $questionArray;
        // $attemptViewModel->quiz                = $attempt->quiz->only('id','name','duration','start_date','end_date');
        // $attemptViewModel->marks               = 0;


        return $attemptViewModel;
    }
    private static function cleanObject($attemptViewModel)
	{
		return (object) array_filter((array) $attemptViewModel, function ($value) {
			return ($value !== null && $value !== '' && $value !== []);
		});
	}
    
    public static function getSingleAttemptDBViewModel($attemptView)
    {
        // dd( $attemptView ? $attemptView->total_marks :0);
        $attemptViewModel                = new AttemptViewModel();
        $attemptViewModel->user          = $attemptView  ? UserViewModel::getSingleUserViewModel($attemptView->user) : auth()->user();
        $attemptViewModel->quiz          = $attemptView ? QuizViewModel::getSingleQuizViewModel($attemptView->quiz) : auth()->user()->quiz;
        $attemptViewModel->score         = $attemptView ? $attemptView->score : 0;
        $attemptViewModel->total_marks   = $attemptView ? $attemptView->total_marks :  0;
        $attemptViewModel->passing_marks = $attemptView ? $attemptView->passing_marks : 0;
        $attemptViewModel->status        = $attemptView ? $attemptView->score >= $attemptView->passing_marks ? AttemptViewStatus::All[AttemptViewStatus::PASS] : AttemptViewStatus::All[AttemptViewStatus::FAIL] : AttemptViewStatus::All[AttemptViewStatus::FAIL] ;
        return self::cleanObject($attemptViewModel);
        
    }
    
}
