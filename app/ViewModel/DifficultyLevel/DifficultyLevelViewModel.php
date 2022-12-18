<?php


namespace App\ViewModel\DifficultyLevel;


class DifficultyLevelViewModel
{
    public $id;
    public $name;
    public $slug;
    public $weightage;

    public static function getMultipleDifficultyLevelsViewModel($difficultyLevels)
    {
        $difficultyLevelsList = [];
        foreach ($difficultyLevels as $difficultyLevel){
            $difficultyLevelsList[] = self::getSingleDifficultyLevelViewModel($difficultyLevel, false);
        }
        return $difficultyLevelsList;
    }

    public static function getSingleDifficultyLevelViewModel($difficultyLevel, $details = true)
    {
        $difficultyLevelViewModel                      = new DifficultyLevelViewModel();
        $difficultyLevelViewModel->id                  = $difficultyLevel->id;
        $difficultyLevelViewModel->name                = $difficultyLevel->name;
        $difficultyLevelViewModel->slug                = $difficultyLevel->slug;
        $difficultyLevelViewModel->weightage           = $difficultyLevel->weightage;
        return $difficultyLevelViewModel;
    }
}
