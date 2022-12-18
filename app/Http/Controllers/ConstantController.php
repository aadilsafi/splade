<?php

namespace App\Http\Controllers;

use App\Utils\Common\DifficultyLevel;
use App\Utils\Common\UserRoles;
use Illuminate\Http\Request;

class ConstantController extends Controller
{
    //
    public function getAllUserTypes()
    {
        $user_roles = [];
        foreach(UserRoles::ALL as $id => $value)
        {
            $data = [
                'id'    => $id,
                'name'  => $value
            ];
            $user_roles[] = $data;
        }
        return $this->sendResponse($user_roles,'All User Types');
    }
    public function getAllDifficultyLevel()
    {
        $difficulty_levels = [];
        foreach (DifficultyLevel::TYPES as $id => $value) {
            $data = [
                'id'    => $id,
                'name'  => $value
            ];
            $difficulty_levels[] = $data;
        }
        return $this->sendResponse($difficulty_levels,'All Difficulty Level');

    }
}
