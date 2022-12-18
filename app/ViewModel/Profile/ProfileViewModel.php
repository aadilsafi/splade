<?php


namespace App\ViewModel\Profile;


use Illuminate\Support\Str;

class ProfileViewModel
{
    public $id;
    public $full_name;
    public $first_name;
    public $last_name;
    public $middle_name;
    public $score;
    public $date_of_birth;
    public $avatar;
    public $bio;
    public $secondary_email;
    public $contact_number;

    public static function getMultipleProfilesViewModel($profiles)
    {
        $profilesList = [];
        if($profiles){
            foreach ($profiles as $profile){
                $profilesList[] = self::getSingleSingleProfileViewModel($profile, false);
            }
        }

        return $profilesList;
    }

    public static function getSingleSingleProfileViewModel($profile, $details = true)
    {

        $name                               = $profile->first_name . ' ' . $profile->middle_name . ' ' . $profile->last_name;
        $avatar                             = $profile->avatar ? asset('storage/'.$profile->avatar) : "https://ui-avatars.com/api/?rounded=true&bold=true&format=svg&name=" . $name;

        $profileViewModel                   =  new ProfileViewModel();
        $profileViewModel->id               =  $profile->id;
        $profileViewModel->full_name        =  Str::title($profile->first_name . ' ' . $profile->middle_name . ' ' . $profile->last_name);
        $profileViewModel->first_name       =  $profile->first_name;
        $profileViewModel->last_name        =  $profile->last_name ?: null;
        $profileViewModel->middle_name      =  $profile->middle_name ?: null;
        $profileViewModel->score            =  $profile->score;
        $profileViewModel->date_of_birth    =  $profile->date_of_birth;
        $profileViewModel->avatar           =  $avatar;
        $profileViewModel->bio              =  $profile->bio ?: null;
        $profileViewModel->secondary_email  =  $profile->secondary_email ?: null;
        $profileViewModel->contact_number   =  $profile->contact_number ?: null;
        return $profileViewModel;
    }
}
