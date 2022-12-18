<?php
namespace App\Utils\Common;

class StandardRoles
{
    const SuperAdminRole    = UserRoles::ALL[UserRoles::SUPER_ADMIN];
    const SuperAdminRoleId  = UserRoles::SUPER_ADMIN;

    const AdminRole         = UserRoles::ALL[UserRoles::ADMIN];
    const AdminRoleId       = UserRoles::ADMIN;

    const AuthRole          = UserRoles::ALL[UserRoles::AUTH_USER];
    const AuthRoleId        = UserRoles::AUTH_USER;

    const TraineeRole       = UserRoles::ALL[UserRoles::TRANIEE];
    const TraineeRoleId     = UserRoles::TRANIEE;

    const TrainerRole       = UserRoles::ALL[UserRoles::TRAINER];
    const TrainerRoleId     = UserRoles::TRAINER;


}
