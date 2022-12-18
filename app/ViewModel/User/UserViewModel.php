<?php


namespace App\ViewModel\User;

use App\ViewModel\Category\Course\CourseViewModel;
use App\ViewModel\Profile\ProfileViewModel;
use App\ViewModel\User\Role\RoleViewModel;
use Carbon\Carbon;

class UserViewModel
{
    public $id;
    public $username;
    public $email;
    public $roles;
    public $last_active_at;
    public $created_at;
    public $profile;

    public static function getMultipleUsersViewModel($users)
    {
        $usersList = [];
        if($users){
            foreach ($users as $user){
                $usersList[] = self::getSingleUserViewModel($user, false);
            }
        }

        return $usersList;
    }

    public static function getSingleUserViewModel($user, $details = true)
    {
        $userViewModel                      = new UserViewModel();
        $userViewModel->id                  = $user->id;
        $userViewModel->username            = $user->username;
        $userViewModel->email               = $user->email;
        $userViewModel->roles               = RoleViewModel::getMultipleRolesViewModel($user->roles);
        $userViewModel->last_active_at      = Carbon::parse($user->last_active_at)->format("M d, Y g:i a");
        $userViewModel->created_at          = $user->created_at->format("M d, Y g:i a");
        $userViewModel->profile             = $user->profile? ProfileViewModel::getSingleSingleProfileViewModel($user->profile) : null;
        $userViewModel->courses             = $details? CourseViewModel::getMultipleCoursesViewModel($user->courses,$details) : $user->courses()->count();
        $userViewModel->topics              = count($user->topic_progress);
        return $userViewModel;
    }
}
