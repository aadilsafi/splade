<?php


namespace App\ViewModel\User\Role;


class RoleViewModel
{
    public $id;
    public $name;

    public static function getMultipleRolesViewModel($roles)
    {
        $rolesList = [];
        if($roles){
            foreach ($roles as $role){
                $rolesList[] = self::getSingleSingleRoleViewModel($role, false);
            }
        }

        return $rolesList;
    }

    public static function getSingleSingleRoleViewModel($role, $details = true)
    {
        $roleViewModel              = new RoleViewModel();
        $roleViewModel->id          = $role->id;
        $roleViewModel->name        = $role->name;
        return $roleViewModel;
    }
}
