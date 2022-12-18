<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use App\Utils\Common\StandardRoles;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Hash;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        $users = [
            [
                'username'       => 'superadmin',
                'email'          => 'superadmin@ctp.com',
                'role'           => StandardRoles::SuperAdminRole,
            ],
        	[
                'username'      => 'admin',
        		'email'         => 'admin@ctp.com',
                'role'          => StandardRoles::AdminRole,

            ],
        	[
                'username'      => 'john',
        		'email'         => 'john@ctp.com',
                'role'          => StandardRoles::TrainerRole,
                'profile'       => [
                    'first_name'     => 'John',
                    'last_name'      => 'Doe',
                    'date_of_birth'  => now()->subYears(20)
                ]
        	],
        	[
                'username'       => 'joe',
        		'email'          => 'joe@ctp.com',
                'role'           => StandardRoles::AuthRole,
                'profile'        => [
                    'first_name'        => 'Joe',
                    'last_name'         => 'West',
                    'date_of_birth'     => now()->subYears(35)
                ]
        	],
        	[
                'username'       => 'jini',
        		'email'          => 'jini@ctp.com',
                'role'           => StandardRoles::AuthRole,
                'profile'        => [
                    'first_name'     => 'Jini',
                    'last_name'      => 'Ambra',
                    'date_of_birth'  => now()->subYears(25)
                ]
        	],
        	[
                'username'       => 'grant',
        		'email'          => 'grant@ctp.com',
                'role'           => StandardRoles::AuthRole,
                'profile'        => [
                    'first_name'     => 'Grant',
                    'last_name'      => 'Gustin',
                    'date_of_birth'  => now()->subYears(22)
                ]
        	]
        ];

        foreach ($users as $key => $user) {
            $user['password']       = bcrypt("password");
            $role                   = $user['role'];
            $profile                = $user['profile'] ?? null;
            unset($user['role'], $user['profile']);
            $userObj = User::create($user);
            $userObj->save();
            if($profile)
            {
                $userObj->profile()->create($profile);
            }
            $userObj->assignRole($role);
        }
    }
}
