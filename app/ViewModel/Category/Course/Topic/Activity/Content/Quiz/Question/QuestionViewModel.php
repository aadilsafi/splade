<?php


namespace App\ViewModel\Category\Course\Topic\Activity\Content\Quiz\Question;


use App\ViewModel\Category\Course\Topic\Activity\Content\Quiz\Question\Answer\AnswerViewModel;
use App\ViewModel\DifficultyLevel\DifficultyLevelViewModel;
use App\ViewModel\QuestionBank\QuestionBankViewModel;

class QuestionViewModel
{
    public $id;
    public $name;
    public $difficulty_level;
    public $question_bank;
    public $answers;

    public static function getMultipleQuestionsViewModel($questions, $details = false,$detailAnswers = false)
    {
        $questionList = [];
        foreach ($questions as $question){
            $questionList[] = self::getSingleQuestionViewModel($question, $details,$detailAnswers);
        }
        return $questionList;
    }

    public static function getSingleQuestionViewModel($question, $details = false, $detailAnswers = false)
    {
        if(!$question){
            return null;
        }
        $questionViewModel                      = new QuestionViewModel();
        $questionViewModel->id                  = $question->id;
        $questionViewModel->name                = $question->name;
        if($details)
            $questionViewModel->difficulty_level    = $question->difficultyLevel? DifficultyLevelViewModel::getSingleDifficultyLevelViewModel($question->difficultyLevel, false):false;
            $questionViewModel->question_bank       = $question->bank ? ($details? QuestionBankViewModel::getSingleQuestionBankViewModel($question->bank, false) : null) : null;
            $questionViewModel->answers             = $question->answers ? ($details? AnswerViewModel::getMultipleAnswersViewModel($question->answers, $details,$detailAnswers) : $question->answers()->count()):null;
        return $questionViewModel;
    }
}
