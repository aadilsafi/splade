<?php


namespace App\ViewModel\Category\Course\Topic\Activity\Content\Quiz\Question\Answer;

use App\Models\Question;
use App\ViewModel\Category\Course\Topic\Activity\Content\Quiz\Question\QuestionViewModel;

class AnswerViewModel
{
    public $id;
    public $name;
    public $question;
    public $is_correct;

    public static function getMultipleAnswersViewModel($answers, $details = false,$detailAnswers = false)
    {
        $answerList = [];
        foreach ($answers as $answer){
            $answerList[] = self::getSingleAnswerViewModel($answer, $details,$detailAnswers);
        }
        return $answerList;
    }

    public static function getSingleAnswerViewModel($answer, $details = false,$detailAnswers = false)
    {
        $questionModel                        = new Question();
        $answerViewModel                      = new AnswerViewModel();
        $answerViewModel->id                  = $answer->id;
        $answerViewModel->name                = $answer->name;
        $answerViewModel->is_correct          = $detailAnswers? $answer->is_correct : 0;
        if($details)
            $answerViewModel->question            = $answer->question;
        return $answerViewModel;
    }
}
