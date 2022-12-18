<?php


namespace App\Services\Interfaces;


interface UserServiceInterface
{
    public function createUser($user_data);
    public function createProfile($profile_data);

    public function registerNewUser($data);

}
