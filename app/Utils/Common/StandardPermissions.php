<?php

namespace App\Utils\Common;


class StandardPermissions
{

    // Reference Item
    const ViewReferenceList         = 'view-referenceList';
    const ViewReferenceListId       = 1;

    const CreateReferenceLists      = 'create-reference-lists';
    const CreateReferenceListsId    = 2;

    const EditReferenceLists        = 'edit-reference-lists';
    const EditReferenceListsId      = 3;

    const DeleteReferenceLists      = 'delete-reference-lists';
    const DeleteReferenceListsId    = 4;

    // Users
    const ViewUser                  = 'view-user';
    const ViewUserId                = 5;

    const CreateUser                = 'create-user';
    const CreateUserId              = 6;

    const DeleteUser                = 'delete-user';
    const DeleteUserId              = 7;

    const EditUser                  = 'edit-user';
    const EditUserId                = 8;


    // Thread (Forum)
    const ViewThread                 = 'view-thread';
    const ViewThreadId               = 9;

    const CreateThread               = 'create-thread';
    const CreateThreadId             = 10;

    const DeleteThread               = 'delete-thread';
    const DeleteThreadId             = 11;

    const EditThread                 = 'edit-thread';
    const EditThreadId               = 12;

    // Thread Comments
    const ViewThreadComment          = 'view-thread-comment';
    const ViewThreadCommentId        = 13;

    const CreateThreadComment        = 'create-thread-comment';
    const CreateThreadCommentId      = 14;

    const DeleteThreadComment        = 'delete-thread-comment';
    const DeleteThreadCommentId      = 15;

    const EditThreadComment          = 'edit-thread-comment';
    const EditThreadCommentId        = 16;

    // Profile
    const ViewAllProfiles           = 'view-all-profiles';
    const ViewAllProfilesId         = 17;

    const ViewSingleProfile         = 'view-single-profile';
    const ViewSingleProfileId       = 18;

    const SendFriendRequest         = 'send-friend-request';
    const SendFriendRequestId       = 19;

    const AcceptFriendRequest       = 'accept-friend-request';
    const AcceptFriendRequestId     = 20;

    const ReportProfile             = 'report-profile';
    const ReportProfileId           = 21;
}
