<?php

namespace Database\Seeders;

use App\Utils\Common\StandardPermissions;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            [
                'id'    => StandardPermissions::ViewReferenceListId,
                'name'  => StandardPermissions::ViewReferenceList,
            ],
            [
                'id'    => StandardPermissions::CreateReferenceListsId,
                'name'  => StandardPermissions::CreateReferenceLists,
            ],
            [
                'id'    => StandardPermissions::EditReferenceListsId,
                'name'  => StandardPermissions::EditReferenceLists,
            ],
            [
                'id'    => StandardPermissions::DeleteReferenceListsId,
                'name'  => StandardPermissions::DeleteReferenceLists,
            ],
            [
                'id'    => StandardPermissions::ViewUserId,
                'name'  => StandardPermissions::ViewUser
            ],
            [
                'id'    => StandardPermissions::CreateUserId,
                'name'  => StandardPermissions::CreateUser,
            ],
            [
                'id'    => StandardPermissions::EditUserId,
                'name'  => StandardPermissions::EditUser,
            ],
            [
                'id'    => StandardPermissions::DeleteUserId,
                'name'  => StandardPermissions::DeleteUser,
            ],
            [
                'id'    => StandardPermissions::ViewThreadId,
                'name'  => StandardPermissions::ViewThread
            ],
            [
                'id'    => StandardPermissions::CreateThreadId,
                'name'  => StandardPermissions::CreateThread,
            ],
            [
                'id'    => StandardPermissions::EditThreadId,
                'name'  => StandardPermissions::EditThread,
            ],
            [
                'id'    => StandardPermissions::DeleteThreadId,
                'name'  => StandardPermissions::DeleteThread,
            ],
            [
                'id'    => StandardPermissions::ViewThreadCommentId,
                'name'  => StandardPermissions::ViewThreadComment
            ],
            [
                'id'    => StandardPermissions::CreateThreadCommentId,
                'name'  => StandardPermissions::CreateThreadComment,
            ],
            [
                'id'    => StandardPermissions::EditThreadCommentId,
                'name'  => StandardPermissions::EditThreadComment,
            ],
            [
                'id'    => StandardPermissions::DeleteThreadCommentId,
                'name'  => StandardPermissions::DeleteThreadComment,
            ],
            [
                'id'    => StandardPermissions::ViewAllProfilesId,
                'name'  => StandardPermissions::ViewAllProfiles
            ],
            [
                'id'    => StandardPermissions::ViewSingleProfileId,
                'name'  => StandardPermissions::ViewSingleProfile,
            ],
            [
                'id'    => StandardPermissions::SendFriendRequestId,
                'name'  => StandardPermissions::SendFriendRequest,
            ],
            [
                'id'    => StandardPermissions::AcceptFriendRequestId,
                'name'  => StandardPermissions::AcceptFriendRequest,
            ],
            [
                'id'    => StandardPermissions::ReportProfileId,
                'name'  => StandardPermissions::ReportProfile,
            ],
            
        ];

        foreach ($permissions as $permission){
            $permission_obj = Permission::create($permission);
        }

    }
}
