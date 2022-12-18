<?php

namespace Database\Seeders;

use App\Utils\Common\StandardRoles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = [
            [
                'id'    => StandardRoles::SuperAdminRoleId,
                'name'  => StandardRoles::SuperAdminRole,
            ],
            [
                'id'    => StandardRoles::AdminRoleId,
                'name'  => StandardRoles::AdminRole,
            ],
            [
                'id'    => StandardRoles::AuthRoleId,
                'name'  => StandardRoles::AuthRole,
            ],
            [
                'id'    => StandardRoles::TraineeRoleId,
                'name'  => StandardRoles::TraineeRole,
            ],
            [
                'id'    => StandardRoles::TrainerRoleId,
                'name'  => StandardRoles::TrainerRole,
            ],
        ];

        foreach ($roles as $role) {

            $role_obj = Role::create($role);

            if ($role_obj->id == StandardRoles::AdminRoleId) {
                $permissions = Permission::pluck('id');
                $role_obj->givePermissionTo($permissions);
            }
        }
    }
}
