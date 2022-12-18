<?php


namespace App\ViewModel\Category\Course\Topic\Activity\Content\Quiz;


use App\ViewModel\Category\Course\Topic\Activity\Content\Quiz\Question\QuestionViewModel;
use App\ViewModel\User\UserViewModel;
use App\Utils\Helper;
use Illuminate\Support\Str;

class QuizViewModel
{
    public $id;
    public $name;
    public $trainer;
    public $duration;
    public $start_date;
    public $end_date;
    public $total_marks;
    public $passing_marks;
    public $allowed_attempts;
    public $questions;
public static function getMultipleQuizViewModel($quizzes,$details = true)
    {

        $allQuizzes = [];
        if(count($quizzes) != 0)
        {
            foreach($quizzes as $quiz)
            {
                $allQuizzes[] = self::getSingleQuizViewModel($quiz, $details);
            }
        }
        return $allQuizzes;
    }
    public static function getSingleQuizViewModel($quiz, $details = false,$detailAnswers = false)
    {
        $quizViewModel                      = new QuizViewModel();
        $quizViewModel->id                  = $quiz->id;
        $quizViewModel->name                = Str::title($quiz->name);
        $quizViewModel->slug                = Str::title($quiz->slug);
        $quizViewModel->duration            = $quiz->duration;
        $quizViewModel->start_date          = $quiz->start_date;
        $quizViewModel->end_date            = $quiz->end_date;
        $quizViewModel->total_marks         = $quiz->total_marks;
        $quizViewModel->passing_marks       = $quiz->passing_marks;
        $quizViewModel->allowed_attempts    = $quiz->allowed_attempts;
        if($details)
            $quizViewModel->trainer             = $quiz->trainer? UserViewModel::getSingleUserViewModel($quiz->trainer) : null;
            $quizViewModel->questions           = $quiz->questions? QuestionViewModel::getMultipleQuestionsViewModel($quiz->questions, $details,$detailAnswers) : null;
        return $quizViewModel;
    }
}
