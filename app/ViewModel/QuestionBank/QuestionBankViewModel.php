<?php


namespace App\ViewModel\QuestionBank;


use App\ViewModel\Category\Course\Topic\Activity\Content\Quiz\Question\QuestionViewModel;

class QuestionBankViewModel
{
    public $id;
    public $name;
    public $slug;
    public $questions;

    public static function getMultipleQuestionBanksViewModel($questionBanks,$details = false)
    {
        $questionBanksList = [];
        foreach ($questionBanks as $questionBank){
            $questionBanksList[] = self::getSingleQuestionBankViewModel($questionBank, $details);
        }
        return $questionBanksList;
    }

    public static function getSingleQuestionBankViewModel($questionBank, $details = true)
    {
        $questionBankViewModel                      = new QuestionBankViewModel();
        $questionBankViewModel->id                  = $questionBank->id;
        $questionBankViewModel->name                = $questionBank->name;
        $questionBankViewModel->slug                = $questionBank->slug;
        $questionBankViewModel->questions           = $details? QuestionViewModel::getMultipleQuestionsViewModel($questionBank->questions, true) : $questionBank->questions()->count();
        return $questionBankViewModel;
    }
}
